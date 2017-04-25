<?php
error_reporting(E_ALL);
set_time_limit(0);
date_default_timezone_set('Asia/shanghai');
class WS {
    const LOG_PATH = '/tmp/';
    const LISTEN_SOCKET_NUM = 9;
    /**
     * @var array $sockets
     *    [
     *      (int)$socket => [
     *                        info
     *                      ]
     *      ]
     */
    private $sockets = [];
    private $master;
    private $index_sockets = [];
    private $theone=0;
    private $iftouser = false;
    public function __construct($host, $port) {
        try {
            $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1);
            socket_bind($this->master, $host, $port);
            socket_listen($this->master, self::LISTEN_SOCKET_NUM);
        } catch (\Exception $e) {
            $err_code = socket_last_error();
            $err_msg = socket_strerror($err_code);
            $this->error([
                'error_init_server',
                $err_code,
                $err_msg
            ]);
        }
        $this->sockets[0] = ['resource' => $this->master];
        $pid = posix_getpid();
        $this->debug(["server: {$this->master} started,pid: {$pid}"]);
        while (true) {
            try {
                $this->doServer();
            } catch (\Exception $e) {
                $this->error([
                    'error_do_server',
                    $e->getCode(),
                    $e->getMessage()
                ]);
            }
        }
    }
    private function doServer() {
        $write = $except = NULL;
        $sockets = array_column($this->sockets, 'resource');
        $read_num = socket_select($sockets, $write, $except, NULL);
        if (false === $read_num) {
            $this->error([
                'error_select',
                $err_code = socket_last_error(),
                socket_strerror($err_code)
            ]);
            return;
        }
        foreach ($sockets as $socket) {
            if ($socket == $this->master) {
                $client = socket_accept($this->master);
                if (false === $client) {
                    $this->error([
                        'err_accept',
                        $err_code = socket_last_error(),
                        socket_strerror($err_code)
                    ]);
                    continue;
                } else {
                    
                    self::connect($client);
                    continue;
                }
            } else {
                $bytes = @socket_recv($socket, $buffer, 2048, 0);
                if ($bytes < 9) {
                    $recv_msg = $this->disconnect($socket);
                } else {
                    if (!$this->sockets[(int)$socket]['handshake']) {
                        self::handShake($socket, $buffer);
                        continue;
                    } else {
                        $recv_msg = self::parse($buffer);
                    }
                }
                array_unshift($recv_msg, 'receive_msg');
                $msg = self::dealMsg($socket, $recv_msg);
                $this->broadcast($msg);
            }
        }
    }
    /**
     *
     * @param $socket
     */
    public function connect($socket) {
        socket_getpeername($socket, $ip, $port);
        $socket_info = [
            'resource' => $socket,
            'uname_o'=>'',
            'uname' => '',
            'handshake' => false,
            'ip' => $ip,
            'port' => $port,
            'towho'=>'',
        ];
        $this->sockets[(int)$socket] = $socket_info;
        $this->debug(array_merge(['socket_connect'], $socket_info));
    }
    /**
     *
     * @param $socket
     *
     * @return array
     */
    private function disconnect($socket) {
        $recv_msg = [
            'type' => 'logout',
            'content' => $this->sockets[(int)$socket]['uname'],
        ];
        unset($this->sockets[(int)$socket]);
        return $recv_msg;
    }
    /**
     *
     * @param $socket
     * @param $buffer
     *
     * @return bool
     */
    public function handShake($socket, $buffer) {
        
        $line_with_key = substr($buffer, strpos($buffer, 'Sec-WebSocket-Key:') + 18);
        $key = trim(substr($line_with_key, 0, strpos($line_with_key, "\r\n")));
        $upgrade_key = base64_encode(sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true));// 升级key的算法
        $upgrade_message = "HTTP/1.1 101 Switching Protocols\r\n";
        $upgrade_message .= "Upgrade: websocket\r\n";
        $upgrade_message .= "Sec-WebSocket-Version: 13\r\n";
        $upgrade_message .= "Connection: Upgrade\r\n";
        $upgrade_message .= "Sec-WebSocket-Accept:" . $upgrade_key . "\r\n\r\n";
        socket_write($socket, $upgrade_message, strlen($upgrade_message));// 向socket里写入升级信息
        $this->sockets[(int)$socket]['handshake'] = true;
        socket_getpeername($socket, $ip, $port);
        $this->debug([
            'hand_shake',
            $socket,
            $ip,
            $port
        ]);
        // 
        $msg = [
            'type' => 'handshake',
            'content' => 'done',
        ];
        $msg = $this->build(json_encode($msg));
        socket_write($socket, $msg, strlen($msg));
        return true;
    }
    /**
     * 
     *
     * @param $buffer
     *
     * @return bool|string
     */
    private function parse($buffer) {
        $decoded = '';
        $len = ord($buffer[1]) & 127;
        if ($len === 126) {
            $masks = substr($buffer, 4, 4);
            $data = substr($buffer, 8);
        } else if ($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data = substr($buffer, 14);
        } else {
            $masks = substr($buffer, 2, 4);
            $data = substr($buffer, 6);
        }
        for ($index = 0; $index < strlen($data); $index++) {
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }
        return json_decode($decoded, true);
    }
    /**
     * 
     *
     * @param $msg
     *
     * @return string
     */
    private function build($msg) {
        $frame = [];
        $frame[0] = '81';
        $len = strlen($msg);
        if ($len < 126) {
            $frame[1] = $len < 16 ? '0' . dechex($len) : dechex($len);
        } else if ($len < 65025) {
            $s = dechex($len);
            $frame[1] = '7e' . str_repeat('0', 4 - strlen($s)) . $s;
        } else {
            $s = dechex($len);
            $frame[1] = '7f' . str_repeat('0', 16 - strlen($s)) . $s;
        }
        $data = '';
        $l = strlen($msg);
        for ($i = 0; $i < $l; $i++) {
            $data .= dechex(ord($msg{$i}));
        }
        $frame[2] = $data;
        $data = implode('', $frame);
        return pack("H*", $data);
    }
    /**
     * 
     *
     * @param $socket
     * @param $recv_msg
     *          [
     *          'type'=>user/login
     *          'content'=>content
     *          ]
     *
     * @return string
     */
     
     function cutuuid($string){
         $index1 = strpos($string,'%');
         $resultstring = substr($string,0,$index1);
         return $resultstring;
     }
    private function dealMsg($socket, $recv_msg) {
        $msg_type = $recv_msg['type'];
        $msg_content = $recv_msg['content'];
        $response = [];
        switch ($msg_type) {
            case 'switch':
                $msg_to = $recv_msg['to'];
                $msg_to_no = self::cutuuid($msg_to);
                $this->sockets[(int)$socket]['towho'] = $msg_to_no;
            case 'login':
                $this->iftouser =false;
                $this->sockets[(int)$socket]['uname_o'] = $msg_content;
                $response['to'] = $recv_msg['to'];
                $msg_content_no = self::cutuuid($msg_content);
                $msg_to = $recv_msg['to'];
                $msg_to_no = self::cutuuid($msg_to);
                $this->sockets[(int)$socket]['uname'] = $msg_content_no;
                $this->sockets[(int)$socket]['towho'] = $msg_to_no;
                $user_list = array_column($this->sockets, 'uname_o');
                $response['type'] = 'login';
                $response['content'] = $msg_content;
                $response['user_list'] = $user_list;
                break;
            case 'logout':
                $this->iftouser =false;
                $user_list = array_column($this->sockets, 'uname_o');
                $response['type'] = 'logout';
                $response['content'] = $msg_content;
                $response['user_list'] = $user_list;
                unset($this->index_sockets[$msg_content]);
                break;
            case 'user':
                $msg_to = $recv_msg['to'];
                $this->iftouser =true;
                $uname = $this->sockets[(int)$socket]['uname_o'];
                $this->theone=(int)$socket;
                
                echo $msg_to;
                if(!empty($msg_to)){
                    $tmp_list = array_column($this->sockets, 'uname');
                    echo self::cutuuid($msg_to) ;
                    if(in_array(self::cutuuid($msg_to),$tmp_list)){
                        print_r($tmp_list);
                        $response['to'] = $recv_msg['to'];
                        $response['type'] = 'user';
                        $response['from'] = $uname;
                        $response['content'] = $msg_content;
                
                        
                        $uname_no = self::cutuuid($uname);
                        $msg_to_no = self::cutuuid($msg_to); 
                        $this->sockets[(int)$socket]['towho'] = $msg_to_no;
                        
                        foreach ($this->sockets as $key=>$socket1){
                            if ( $socket1['towho'] and $socket1['towho'] != $uname_no and $socket1['uname'] === $msg_to_no ){
                                $this->sockets[$key]['towho'] = $uname_no;
                            }
                        }
                    }else{
                        $msg = [
                        'type' => 'system',
                        'content' => 'Sorry! The one you want to chat with do not want to chat with you. Offline',
                        ];
                        $msg = $this->build(json_encode($msg));
                        return $msg;
                    }
                }else{
                    $msg = [
                        'type' => 'system',
                        'content' => 'Sorry! Your message is sent to air?',
                    ];
                    $msg = $this->build(json_encode($msg));
                    return $msg;
                }
                
                break;
        }
        return $this->build(json_encode($response));
    }
    /**
     *
     * @param $data
     */
    private function broadcast($data) {
        if ($this->iftouser){
            
        $towho =$this->sockets[$this->theone]['towho'];
        print_r($this->sockets[$this->theone]);
     //   socket_write($this->sockets[$this->theone]['resource'], $data, strlen($data));
        foreach ($this->sockets as $socket) {
            if ($socket['uname'] == $towho) {
               socket_write($socket['resource'], $data, strlen($data));
            }
        }
        }else{
            foreach ($this->sockets as $socket) {
            if ($socket['resource'] == $this->master) {
                continue;
               
            }
            socket_write($socket['resource'], $data, strlen($data));
        }
        }
    }
    /**
     *
     * @param array $info
     */
    private function debug(array $info) {
        $time = date('Y-m-d H:i:s');
        array_unshift($info, $time);
        $info = array_map('json_encode', $info);
        file_put_contents(self::LOG_PATH . 'websocket_debug.log', implode(' | ', $info) . "\r\n", FILE_APPEND);
    }
    /**
     *
     * @param array $info
     */
    private function error(array $info) {
        $time = date('Y-m-d H:i:s');
        array_unshift($info, $time);
        $info = array_map('json_encode', $info);
        file_put_contents(self::LOG_PATH . 'websocket_error.log', implode(' | ', $info) . "\r\n", FILE_APPEND);
    }
}
$ws = new WS("192.17.90.133",1234);


?>
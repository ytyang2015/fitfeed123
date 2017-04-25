<?PHP
//$myfile = fopen("food.csv", "r") or die("Unable to open file!");
//Output one character until end-of-file
//$flavor = Array();
//$i=0;
//while(!feof($myfile)) {
//  if ($i!= 0 ){
//	$line = fgetcsv($myfile);
//	array_push($flavor,Array("sweet"=>$line[5],"salty"=>$line[3],"hot"=>$line[9],"sour"=>$line[7]));
//  }
//  $i=$i+1;
//}
//$m = Array();
//for ($i=0;$i<count($flavor);$i++){
//	array_push($m,Normalizate($flavor[$i]));
//}
//fclose($myfile);
//$m = array(array(1,2,3,4),array(2,3,4,1),array)
//$Cluster = dbscan($m,1.4,3);
//print_r($Cluster);
// input user calonis,chicken, beef, pork, cheese, sour, sweet, hot, sour 
// output dishname 
//**********************************************************
function Mean($m1){
	if (count($m1)>1){
		$mean = (array_sum($m1))/count($m1);
		return ($mean);
	}else{
		return (false);
	}
}
// standard diviation 
function MatrixLineSD($m1){
	$sum=0;
	$mean= Mean($m1);
	foreach($m1 as $x){
		$sum = $sum + ($x-Mean($m1))*($x-Mean($m1));
	}
	return(sqrt($sum/count($m1)));;
}
function Normalizate ($m1){
	$m2=array();
	$means = Mean($m1);
	$SD = MatrixLineSD($m1);
	if ($means == 0){
		return(array(0,0,0,0));
	}
	foreach ($m1 as $x){
		array_push($m2, ($x - $means)/$SD);
	}
	return ($m2);
}
function dbscan($m1,$eps,$MinPts){
	for($i=0;$i<count($m1);$i++){
		$m1[$i][5] = 0;
		$m1[$i][6] = 0;
	}
	$C = 0;
	for ($i=0;$i<count($m1);$i++){
		if ($m1[$i][5] != 0){
			continue;
		}
		$m1[$i][5]=1;
		$NeighborPts = regionQuery($i,$m1,$eps);
		if (count($NeighborPts)<$MinPts){
			$m1[$i][6]=-1;	
		}else{
			$C = $C + 1;
			expandCluster ($m1,$i, $NeighborPts, $C, $eps, $MinPts);
		}
	}
	$result =array();
	foreach ($m1 as $x){
	    $x[5]=$x[6];
	    array_push($result,array_slice($x,0,6));
	    
	}
	return($result);
}
function expandCluster(&$m1, $pIndex, $neighborPts,&$C, $eps, $Minpts){
	$m1[$pIndex][6] = $C;
	$tmp = array();
	$newNeighbor = array();
	for($i=0;$i<count($neighborPts);$i++){
		if ($m1[$neighborPts[$i][7]][5] ==0){
			$m1[$neighborPts[$i][7]][5] = 1;
			$neighborPts2 = regionQuery ($neighborPts[$i][7],$m1, $eps);
			if (count($neighborPts2) >= $Minpts){
				foreach ($neighborPts as $x){
					if (!(in_array($x[7],$tmp))){
						array_push($tmp,$x[7]);
						array_push($newNeighbor,$x);
					}
				}
				foreach ($neighborPts2 as $x){
					if(!(in_array($x[7],$tmp))){
						array_push($tmp,$x[7]);
						array_push($newNeighbor,$x);
					}
				}
				$neighborPts = $newNeighbor;
			}
		}
		if ($m1[$neighborPts[$i][7]][6] == 0){
			$m1[$neighborPts[$i][7]][6] = $C;
		}
	}	 

}
// find the points in regions
function regionQuery($pIndex,$m1,$eps){
	$pointsArray = Array();
	for ($i=0;$i <count($m1); $i++){
		if ($i != $pIndex){
			$distance = sqrt(pow(($m1[$pIndex][0]-$m1[$i][0]),2)+pow(($m1[$pIndex][1]-$m1[$i][1]),2)+pow(($m1[$pIndex][2]-$m1[$i][2]),2)+pow(($m1[$pIndex][3]-$m1[$i][3]),2));
			if ($distance < $eps){
				$tmp = $m1[$i];
				array_push($tmp,$i);
				array_push($pointsArray,$tmp);
			}
		}
	}
	return ($pointsArray);			
}
?>

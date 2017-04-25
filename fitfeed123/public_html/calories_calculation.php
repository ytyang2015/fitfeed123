<?php

	$rmrindex = array("1" => "1.2", "2" => "1.375", "3" => "1.55", "4" => "1.725", "5" => "1.9");
 

 	function bmi($height, $weight){
		$hsquare = ($height/100) * ($height/100);
		$bmiretval = $weight / $hsquare;
		echo "Your BMI is" .bmi($user_height, $user_weight);
  		return bmiretval;
	}

	function getintake($gender, $weight, $height, $age, $activitylevel) {
		$rmr = 0;

		if (1 == $gender) {							//gender = 1 is male
			$rmr = 9.99 * $weight + 6.25* $height - 4.92 * $age + 5;
		}
		else {										//else is female
			$rmr = 9.99 * $weight + 6.25 * $height - 4.92 * $age - 161;
		}

/*If you rarely exercise, multiply your BMR by 1.2
If you exercise on 1 to 3 days per week, multiply your BMR by 1.375
If you exercise on 3 to 5 days per week, multiply your BMR by 1.55
If you exercise 6 to 7 days per week, multiply your BMR by 1.725
If you exercise every day and have a physical job or if you often exercise twice a day, multiply your BMR by 1.9 
*/
		$rmr = $rmr * $rmrindex[$activitylevel];
		$intake = $rmr - 500;
		print "you daily intake should be $intake calories to lose weight at a rate of 1 pound per week. lao ge wen";

		return $intake;
	}

	function main($gender, $weight, $height, $age, $activitylevel) {
		$bmi = bmi($height, $weight);
		if ($bmi < 18.5) {
			$intake = getintake($gender, $weight, $height, $age, $activitylevel);
			$intake = $intake + 1000;
		//	print "you are too damn skinny, eat more bitch";

			//get food
		}elseif (($bmi > 18.5) and ($bmi < 24.9)) {
			$intake = getintake($gender, $weight, $height, $age, $activitylevel);
			$intake = $intake + 500;
			print "Your are pretty damn healthy now. just keep up the good work. you should intake $intake kcal/day";

			//get food
		}else {
			$intake = getintake($gender, $weight, $height, $age, $activitylevel);
			print "You are too fat!! You are a pig!!The generally accepted rate of weight loss is 1 to 1.5 pounds per week or approximately 6 pounds per month.   If you eliminate 500 kcal per day from your diet (or approximately 3500 kcal/week), you should be on track to meet this degree of weight loss. Note: there is approximately 3500 calories per one pound of fat (0.45 kg).";

			//get food
		}
	}


?>

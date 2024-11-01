<?php

function vsq_quiz_shortcode($atts){

	extract(shortcode_atts(array(
		'quiz' => 0
	), $atts));

	$helperobj = new Vsq_helper();
	//Get and process user submitted form
	//
		//print_r($_POST);



		if(isset($_POST['vsq_user_submitted_form'])){

			global $wpdb;
			$table_name = $wpdb->prefix . "vsq_results";

			$quiz_id = $_POST['_quizid'];

			isset($_POST['vsq_name']) ? $name = $_POST['vsq_name'] : $name=""  ;
			isset($_POST['vsq_business']) ? $business = $_POST['vsq_business'] : $business=""  ;

			isset($_POST['vsq_email']) ? $email = $_POST['vsq_email'] : $email=""  ;
			isset($_POST['vsq_phone']) ? $phone = $_POST['vsq_phone'] : $phone=""  ;


			

			$calcuate = $_POST['answer_option'];

			
			$point_score = 0;
			$point_score_b = 0;

		
			foreach ($calcuate as $temp)
			{
			    $tempnew = explode(",",$temp);

			    $point_score += $tempnew[0];
			    $point_score_b += $tempnew[1];
			}

			$currentdate = 	date("Y-m-d H:i:s");
			$insert = "INSERT INTO " . $table_name .
			"(result_id, quiz_id,name,business,email,phone,point_score,point_score_b,time_taken) " .
			"VALUES (NULL , 
				'".$quiz_id."', 
				'".$name."', 
				'".$business."',
				'".$email."',
				'".$phone."',
				'".$point_score."',
				'".$point_score_b."',
				'".$currentdate."'
				)";
			$results = $wpdb->query( $insert );

			if ($results != false){

				

				//showing data based on template varibalse set
				//SELECT * FROM `wp_vsq_results` WHERE `quiz_id` = 1 AND `point_score` > 0 AND `point_score` < 100 AND `point_score_b` > 0 AND `point_score_b` < 100 
				$table_name = $wpdb->prefix . "vsq_filter_results";
						$sql = "select * from $table_name where quiz_id = '$quiz_id'";

				$results = $wpdb->get_results($sql, OBJECT);
				
					
					
				
				foreach ($results as $result) {

			


					if((($point_score >= $result->score_a_greater_than) && ($point_score <= $result->score_a_less_than)) && (($point_score_b >= $result->score_b_greater_than) && ($point_score_b <= $result->score_b_less_than)) ){
						
						$templatevariables = $result->pagevariable;
						
						$templatevariables = str_replace("%QUIZ_NAME%", $helperobj->getQuizName($quiz_id) , $templatevariables);
						$templatevariables = str_replace("%POINT_SCORE_A%", $point_score , $templatevariables);
						$templatevariables = str_replace("%POINT_SCORE_B%", $point_score_b , $templatevariables);
						
						echo $templatevariables . '<br>';
						echo $result->customtext;

					}
				
				
				}

		





			}
				//echo "string";
			}else{

	//



	//echo $quiz;

	//variables
	global $wpdb;
	$quiz_id = intval($quiz);

	$sql = "SELECT * FROM " . $wpdb->prefix . "vsq_questions" . " WHERE quiz_id= '$quiz_id'";
	$results = $wpdb->get_results($sql);
	$srno = 1;
	$currentdate = date("F jS Y");
	$getquizname = $helperobj->getQuizName($quiz_id);
	$customMsgBeforeQuiz =  $helperobj->customtextbeforequiz($quiz_id);
	$customMsgBeforeQuiz = str_replace("%QUIZ_NAME%", $getquizname, $customMsgBeforeQuiz);
	$customMsgBeforeQuiz = str_replace("%CURRENT_DATE%", $currentdate, $customMsgBeforeQuiz);

	echo $customMsgBeforeQuiz;

	echo "<form name='quizForm' action='' method='post' class='vsq_quiz_form'>";

	echo "<input type='hidden' name='_quizid' value='".$quiz_id."' />";	

	echo 'Name: <input type="text" name="vsq_name" value=""> <br>';
	echo 'Business: <input type="text" name="vsq_business" value=""> <br>';
	echo 'Email: <input type="text" name="vsq_email" value=""> <br>';
	echo 'Phone: <input type="text" name="vsq_phone" value=""> <br>';

	foreach ($results as $result){
		
		echo "<p>$srno ".$result->question_name.'</p>';

		
		echo '<p>';
		//display answer options question_type
		//
		$ver_hor_display = $result->answerdisplaytype;


		echo add_form_option_box($srno,$result->question_type,$result->answer_one_points,$result->answer_one_points_b);
		echo $result->answer_one . display_HV_Helper($ver_hor_display);

		echo add_form_option_box($srno,$result->question_type,$result->answer_two_points,$result->answer_two_points_b);
		echo $result->answer_two  . display_HV_Helper($ver_hor_display);

		echo add_form_option_box($srno,$result->question_type,$result->answer_three_points,$result->answer_three_points_b);
		echo $result->answer_three . display_HV_Helper($ver_hor_display);

		echo add_form_option_box($srno,$result->question_type,$result->answer_four_points,$result->answer_four_points_b);
		echo $result->answer_four . display_HV_Helper($ver_hor_display);

		echo add_form_option_box($srno,$result->question_type,$result->answer_five_points,$result->answer_five_points_b);
		echo $result->answer_five . display_HV_Helper($ver_hor_display);

		echo '</p>';
		
		$srno++;
	}
		echo "<input type='hidden' name='vsq_user_submitted_form' value='confirmed' />";
		echo "<p><input type='submit' value='CALCOLA IL RISULTATO' /></p>";
	echo "</form>";
}
?>

<?php
}

function display_HV_Helper($ver_hor){

	if($ver_hor == 'vertical'){
		return "<br />";
	}else{

		return "&nbsp;";
	}

}

add_shortcode("vsq_quiz", "vsq_quiz_shortcode");

?>
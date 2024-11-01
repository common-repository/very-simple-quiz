<?php
function vsq_generate_quiz_options()
{
	$questionhelper = new Vsq_helper();
	global $wpdb;
	$table_name = $wpdb->prefix . "vsq_questions";
	$quiz_id = $_GET["quiz_id"];

	///Delete question
	if(isset($_GET['optionselected'])){
		$optionselected = $_GET['optionselected'];
		$questionid = $_GET['questionid'];

		if($optionselected == "delete"){
			$deletequestion = "DELETE FROM {$table_name} WHERE question_id = $questionid";
			$results = $wpdb->query( $deletequestion );

			if ($results != false){

			echo "<strong>Question Deleted</strong>";
			}
		}
	}





	//create new quizz name
	if ( isset( $_POST["add_question"] ) && $_POST["add_question"] == "confirmation" ){

		$question_name = $_POST['question_name'];

		$answer_one = $_POST['answer_one'];
		$answer_one_points = $_POST['answer_one_points'];
		$answer_one_points_b = $_POST['answer_one_points_b'];

		$answer_two = $_POST['answer_two'];
		$answer_two_points = $_POST['answer_two_points'];
		$answer_two_points_b = $_POST['answer_two_points_b'];

		$answer_three = $_POST['answer_three'];
		$answer_three_points = $_POST['answer_three_points'];
		$answer_three_points_b = $_POST['answer_three_points_b'];

		$answer_four = $_POST['answer_four'];
		$answer_four_points = $_POST['answer_four_points'];
		$answer_four_points_b = $_POST['answer_four_points_b'];

		$answer_five = $_POST['answer_five'];
		$answer_five_points = $_POST['answer_five_points'];
		$answer_five_points_b = $_POST['answer_five_points_b'];

		if(isset($_POST['correct_option'])){
			$correct_answers = $_POST['correct_option'];
			$correct_answers = implode(",", $correct_answers);
			
		
		}else{
		  	$correct_answers="";
		}

		//$correct_answers = $correct_anser_values[correct_option];
		
		$question_type = $_POST['question_type'];
		$answerdisplaytype = $_POST['answerdisplaytype'];

		$insert = "INSERT INTO {$table_name} 
		(question_id,quiz_id,question_name,
			answer_array,
			answer_one,answer_one_points,answer_one_points_b,
			answer_two,answer_two_points,answer_two_points_b,
			answer_three,answer_three_points,answer_three_points_b,
			answer_four,answer_four_points,answer_four_points_b,
			answer_five,answer_five_points,answer_five_points_b,
			question_type,answerdisplaytype
		)
		VALUES 
		(NULL,
			'".$quiz_id."',
			'".$question_name."',
			'".$correct_answers."',
			'".$answer_one."',
			'".$answer_one_points."',
			'".$answer_one_points_b."',
			'".$answer_two."',
			'".$answer_two_points."',
			'".$answer_two_points_b."',
			'".$answer_three."',
			'".$answer_three_points."',
			'".$answer_three_points_b."',
			'".$answer_four."',
			'".$answer_four_points."',
			'".$answer_four_points_b."',
			'".$answer_five."',
			'".$answer_five_points."',
			'".$answer_five_points_b."',
			'".$question_type."',
			'".$answerdisplaytype."'
			)";

		$results = $wpdb->query( $insert );

		if ($results != false){	echo "New Question Added";	}

	}

	if(isset($_POST['update_vsq_question'])){
		$updatequestionid = $_POST['vsq_question_id'];
		$postedvalues = $_POST;
		$questionhelper->updateQuestionRow($updatequestionid,$postedvalues);
		echo "update question";
	}



	$getquestions = $wpdb->get_results( "SELECT question_id, question_name FROM 
		{$table_name} WHERE quiz_id = {$quiz_id} ");
?>
	<h3>Questions</h3>
	<table border="1" width="100%" cellspacing="0" cellpadding="0">
<?php

	foreach($getquestions as $getquestion) {
		echo "<tr>";
		echo "<td>".$getquestion->question_id . "</td>";
		echo "<td>".$getquestion->question_name . "</td>";
		echo "<td><a href='admin.php?page=vsq_quiz_options&&quiz_id=$quiz_id&&questionid=$getquestion->question_id&&optioneditquestion=edit'>Edit</a></td>";
		echo "<td><a href='admin.php?page=vsq_quiz_options&&quiz_id=$quiz_id&&questionid=$getquestion->question_id&&optionselected=delete'>Delete</a></td>";
		echo "</tr>";
	}

	echo "</table>";

	
	

?>
	

<?php

	if(isset($_GET['optioneditquestion'])){

		$questionId = $_GET['questionid'];
		//echo $questionId;
		echo edit_question_form($questionId);

	}else{

		echo add_question_form();	
	}
}

?>
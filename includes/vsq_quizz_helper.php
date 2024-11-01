<?php

class Vsq_helper{

	function updateQuestionRow($questionid,$updatedValues){
		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_questions";

		$question_name = $updatedValues['question_name'];


	    $answer_one = $updatedValues['answer_one']; 
	    $answer_one_points   = $updatedValues['answer_one_points']; 
	    $answer_one_points_b   = $updatedValues['answer_one_points_b']; 
	    $answer_two   = $updatedValues['answer_two']; 
	    $answer_two_points   = $updatedValues['answer_two_points']; 
	    
	    if(isset($_POST['correct_option'])){
			$correct_answers = $_POST['correct_option'];
			$correct_answers = implode(",", $correct_answers);
			
		
		}else{
		  	$correct_answers="";
		}

	    $answer_two_points_b   = $updatedValues['answer_two_points_b']; 
	    $answer_three   = $updatedValues['answer_three']; 
	    $answer_three_points   = $updatedValues['answer_three_points']; 
	   	$answer_three_points_b   = $updatedValues['answer_three_points_b']; 
	    $answer_four   = $updatedValues['answer_four']; 
	   	$answer_four_points   = $updatedValues['answer_four_points']; 
	    $answer_four_points_b   = $updatedValues['answer_four_points_b']; 
	   	$answer_five   =  $updatedValues['answer_five']; 
	    $answer_five_points   = $updatedValues['answer_five_points'];
	    $answer_five_points_b   = $updatedValues['answer_five_points_b'];
	    $question_type   = $updatedValues['question_type']; 
	    $answerdisplaytype   = $updatedValues['answerdisplaytype']; 




		$sql = "
			UPDATE $table_name 
			SET 
			question_name = '$question_name',
			answer_array = '$correct_answers',
			answer_one 			= '$answer_one', 
		    answer_one_points   	= '$answer_one_points',
		    answer_one_points_b   	= '$answer_one_points_b',

		    answer_two   			= '$answer_two', 
		    answer_two_points   	= '$answer_two_points', 
		    answer_two_points_b   	= '$answer_two_points_b', 
		    answer_three   		= '$answer_three', 
		    answer_three_points   	= '$answer_three_points', 
		   	answer_three_points_b  = '$answer_three_points_b', 
		    answer_four   			= '$answer_four', 
		   	answer_four_points   	= '$answer_four_points', 
		    answer_four_points_b   = '$answer_four_points_b', 
		   	answer_five   			=  '$answer_five', 
		    answer_five_points   	= '$answer_five_points',
		    answer_five_points_b   = '$answer_five_points_b',
		    question_type   		= '$question_type', 
		    answerdisplaytype   	= '$answerdisplaytype'
	
			WHERE question_id = $questionid
		
		";

		$results = $wpdb->query( $sql );
	}
	function getQuesionRow($questionid){

		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_questions";

		$sql = "select * from $table_name where question_id = '$questionid' ";
		$questionset = $wpdb->get_var( $sql );

		foreach ($questionset as $questionvalue) {
			echo $questionvalue->question_name;
		}
	}

	function customtextbeforequiz($quizid){
		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_filter_results";

		$sql = "select customtextbeforequiz from $table_name where quiz_id = '$quizid' ";
		$customtextbeforequiz = $wpdb->get_var( $sql );
		return $customtextbeforequiz;
	}

	function getQuizName($id){
		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_quizzes";
		$sql = "select quiz_name from $table_name where quiz_id = '$id' ";

		$quizname = $wpdb->get_var( $sql );

		return  $quizname;
		
	}

	function displayIdAndName(){

		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_quizzes";
		$sql = "select * from $table_name";

		$results = $wpdb->get_results($sql, OBJECT);
		echo '<option value="">Select</option>';

		foreach ($results as $result) {
			echo '<option value="'.$result->quiz_id.'">'.$result->quiz_name . '</option>';
		}
		//echo '<option value="test">test</option>';

	}

	function displayallfilters(){
		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_filter_results";
		$sql = "select * from $table_name";

		$results = $wpdb->get_results($sql, OBJECT);
		
		$resultfilter = "";
		foreach ($results as $result) {

			$resultfilter .= "<tr>";
			$resultfilter .= "<td>$result->quiz_name</td>";
			$resultfilter .= "<td>$result->score_a_greater_than</td>";
			$resultfilter .= "<td>$result->score_a_less_than</td>";
			$resultfilter .= "<td>$result->score_b_greater_than</td>";
			$resultfilter .= "<td>$result->score_b_less_than</td>";
			$resultfilter .= "<td>$result->pagevariable</td>";
			$resultfilter .= "<td>$result->customtext</td>";
			$resultfilter .= "<td><a href='admin.php?page=vsq_filter_result&&filteredit=true&&filterid={$result->filter_result_id}'>Edit</a> | <a href='admin.php?page=vsq_filter_result&&filterdelete=true&&filterid={$result->filter_result_id}'>Delete</a></td>";
			$resultfilter .= "</tr>";
		}

		return $resultfilter;
	}

	function deleterowFilterResults($id){
		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_filter_results";
		$sql = "DELETE FROM $table_name WHERE filter_result_id= $id ";
		$results = $wpdb->query( $sql );
	}

	function deleterowResult($id){
		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_results";
		$sql = "DELETE FROM $table_name WHERE result_id= $id ";
		$results = $wpdb->query( $sql );
	}



	function hello(){
		echo "Hello Helper";
	}
}
?>
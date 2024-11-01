<?php

function vsq_quiz_activate(){

	global $wpdb;

	$table_name = $wpdb->prefix . "vsq_quizzes";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name){

		$sql = "CREATE TABLE " . $table_name . " (
			quiz_id mediumint(9) NOT NULL AUTO_INCREMENT,
			quiz_name TEXT NOT NULL,
			PRIMARY KEY  (quiz_id)
		)
		CHARACTER SET utf8";
		$results = $wpdb->query( $sql );
	}

	global $wpdb;

	$table_name = $wpdb->prefix . "vsq_questions";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) 

	{


		$sql = "CREATE TABLE {$table_name} (

			question_id mediumint(9) NOT NULL AUTO_INCREMENT,

			quiz_id INT NOT NULL,

			question_name TEXT NOT NULL,

			answer_array TEXT NOT NULL,

			answer_one TEXT NOT NULL,

			answer_one_points INT NOT NULL,
			answer_one_points_b INT NOT NULL,

			answer_two TEXT NOT NULL,

			answer_two_points INT NOT NULL,
			answer_two_points_b INT NOT NULL,

			answer_three TEXT NOT NULL,

			answer_three_points INT NOT NULL,
			answer_three_points_b INT NOT NULL,
			answer_four TEXT NOT NULL,

			answer_four_points INT NOT NULL,
			answer_four_points_b INT NOT NULL,

			answer_five TEXT NOT NULL,

			answer_five_points INT NOT NULL,
			answer_five_points_b INT NOT NULL,

			answer_six TEXT NOT NULL,

			answer_six_points INT NOT NULL,
			answer_six_points_b INT NOT NULL,

			correct_answer INT NOT NULL,

			question_answer_info TEXT NOT NULL,
			customtextbeforequiz TEXT NOT NULL,

			comments INT NOT NULL,


			hints TEXT NOT NULL,

			question_order INT NOT NULL,
			answerdisplaytype VARCHAR(15) NOT NULL,

			question_type VARCHAR(15) NOT NULL,

			deleted INT NOT NULL,

			PRIMARY KEY  (question_id)

		)";

		$results = $wpdb->query( $sql );
	}


	global $wpdb;

	$table_name = $wpdb->prefix . "vsq_results";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) 

	{
		$sql = "CREATE TABLE " . $table_name . " (

			result_id mediumint(9) NOT NULL AUTO_INCREMENT,

			quiz_id INT NOT NULL,

			quiz_name TEXT NOT NULL,

			quiz_system INT NOT NULL,

			point_score INT NOT NULL,
			point_score_b INT NOT NULL,

			correct_score INT NOT NULL,

			correct INT NOT NULL,

			total INT NOT NULL,

			name TEXT NOT NULL,

			business TEXT NOT NULL,

			email TEXT NOT NULL,

			phone TEXT NOT NULL,

			user INT NOT NULL,

			time_taken TEXT NOT NULL,

			time_taken_real DATETIME NOT NULL,

			quiz_results TEXT NOT NULL,

			deleted INT NOT NULL,

			PRIMARY KEY  (result_id)

		)

		CHARACTER SET utf8";

		$results = $wpdb->query( $sql );

	}


		global $wpdb;

	$table_name = $wpdb->prefix . "vsq_filter_results";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) 

	{
		$sql = "CREATE TABLE " . $table_name . " (

			filter_result_id mediumint(9) NOT NULL AUTO_INCREMENT,

			quiz_id INT NOT NULL,

			quiz_name TEXT NOT NULL,

			score_a_greater_than INT NOT NULL,

			score_a_less_than INT NOT NULL,

			score_b_greater_than INT NOT NULL,

			score_b_less_than INT NOT NULL,

			pagevariable TEXT NOT NULL,

			customtext TEXT NOT NULL,
			customtextbeforequiz TEXT NOT NULL,
			

			PRIMARY KEY  (filter_result_id)

		)

		CHARACTER SET utf8";

		$results = $wpdb->query( $sql );

	}


}
function vsq_quiz_deactivate(){

	global $wpdb;
	$table_name1 = $wpdb->prefix . "vsq_quizzes";
	$table_name2 = $wpdb->prefix . "vsq_questions";
	$table_name3 = $wpdb->prefix . "vsq_results";
	$table_name4 = $wpdb->prefix . "vsq_filter_results";

	$wpdb->query("DROP TABLE IF EXISTS $table_name1");
	$wpdb->query("DROP TABLE IF EXISTS $table_name2");
	$wpdb->query("DROP TABLE IF EXISTS $table_name3");
	$wpdb->query("DROP TABLE IF EXISTS $table_name4");

}
?>
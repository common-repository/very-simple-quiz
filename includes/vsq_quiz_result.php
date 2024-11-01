<?php

function vsq_generate_quiz_results(){
	$helperobj = new Vsq_helper;


	if(isset($_GET['deleteresult'])){
		$resultid = $_GET['resultid'];
		

		$helperobj->deleterowResult($resultid);
	}
?>
<div class="wrap">
<table class="wp-list-table widefat fixed users">
<thead>
	<tr>
		<th>Actions</th>
		<th>Quiz Name</th>
		<th>Score</th>
		<th>Score B</th>
		<th>Name</th>
		<th>Business</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Date Time</th>
	</tr>
</thead>

<tbody>
<?php

	global $wpdb;
	$table_name = $wpdb->prefix . "vsq_results";
	$resultsquery = "Select * from $table_name";
	$vsq_quiz_result = $wpdb->get_results($resultsquery);

	foreach ($vsq_quiz_result as $vsq_quiz_results) {
		//echo $vsq_quiz_results->quiz_id;
		$quizid = $vsq_quiz_results->quiz_id;
?>	
	<tr>
		<td><a href="admin.php?page=vsq_quiz_result&&deleteresult=yes&&resultid=<?php echo $vsq_quiz_results->result_id; ?>">Delete</a></td>
		<td><?php echo $helperobj->getQuizName($quizid); ; ?></td>
		<td><?php echo $vsq_quiz_results->point_score ; ?></td>
		<td><?php echo $vsq_quiz_results->point_score_b ; ?></td>
		<td><?php echo $vsq_quiz_results->name ; ?></td>
		<td><?php echo $vsq_quiz_results->business ; ?></td>
		<td><?php echo $vsq_quiz_results->email ; ?></td>
		<td><?php echo $vsq_quiz_results->phone ; ?></td>
		<td><?php echo $vsq_quiz_results->time_taken ; ?></td>
	</tr>
<?php	
}
?>
</tbody>
	
</table>


</div>
<?php



}
?>
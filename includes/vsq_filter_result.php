<?php
function vsq_generate_quiz_filter_results(){

	$getidandname = new Vsq_helper;
	$vsq_helper = new Vsq_helper;

	if(isset($_POST['templatevariable'])){

		if($_POST['vsq_quiz_id'] == null){echo "Please select quizzname";}

		if($_POST['vsq_quiz_id'] != null){

			global $wpdb;
			$table_name = $wpdb->prefix . "vsq_filter_results";

			$quiz_id = 				$_POST['vsq_quiz_id'];
			$score_a_greater_than = $_POST['score_a_greater_than'];
			$score_a_less_than = 	$_POST['score_a_less_than'];
			$score_b_greater_than = $_POST['score_b_greater_than'];
			$score_b_less_than =  	$_POST['score_b_less_than'];
			$pagevariable = 		$_POST['pagevariable'];
			$customtext = 			$_POST['customtext'];
			$customtextbeforequiz = $_POST['customtextbeforequiz'];

			$insert = "INSERT INTO " . $table_name .
			"(filter_result_id, quiz_id,quiz_name,score_a_greater_than,score_a_less_than,score_b_greater_than,
				score_b_less_than,pagevariable,customtext,customtextbeforequiz) " .
			"VALUES (NULL , 
				'".$quiz_id."', 
				'".$getidandname->getQuizName($quiz_id)."',
				'".$score_a_greater_than."', 
				'".$score_a_less_than."',
				'".$score_b_greater_than."',
				'".$score_b_less_than."',
				'".$pagevariable."',
				'".$customtext."',
				'".$customtextbeforequiz."'
				)";
			$results = $wpdb->query( $insert );

			if ($results != false){

			echo "Filter Saved Successfully";
			}

		}


	}

	if(isset($_GET['filterdelete'])){
		
		$getidandname->deleterowFilterResults($_GET['filterid']);
	}

//update
	if(isset($_POST['vsq_update'])){



		$filter_result_id = $_POST['filter_result_id'];
		$score_a_greater_than = $_POST['score_a_greater_than'];
		$score_a_less_than  = $_POST['score_a_less_than'];
		$score_b_greater_than  = $_POST['score_b_greater_than'];
		$score_b_less_than = $_POST['score_b_less_than'];
		$pagevariable = $_POST['pagevariable'];
		$customtext = $_POST['customtext'];
		$customtextbeforequiz = $_POST['customtextbeforequiz'];

		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_filter_results";

		$sql = "
			UPDATE $table_name 
			SET 
			score_a_greater_than = '$score_a_greater_than',
			score_a_less_than = '$score_a_less_than',

			score_b_greater_than = '$score_b_greater_than',
			score_b_less_than = '$score_b_less_than',
			pagevariable = '$pagevariable',
			customtext = '$customtext',
			customtextbeforequiz = '$customtextbeforequiz'

			WHERE filter_result_id = $filter_result_id 
		
		";

		$results = $wpdb->query( $sql );
	}

	

	
?>

<div class="wrap">

						
	
	<div style="width: 100%; background: none repeat scroll 0 0 white;margin-bottom: 10px;overflow: hidden;">
	<h2>Template Variables</h2>
		<div style="float:left; width: 48%;padding: 10px;">

			<p>%POINT_SCORE_A% - Score on Factor A</p>
			<p>%USER_NAME% - The name the user entered before the quiz</p>
			<p>%USER_PHONE% - The phone number the user entered before the quiz</p>
			<p>%QUIZ_NAME% - The name of the quiz</p>

		</div>
		<div style="float:left; width: 48%;padding: 10px;">
			<p>%POINT_SCORE_B% - Score on Factor B</p>
			<p>%USER_BUSINESS% - The business the user entered before the quiz</p>
			<p>%USER_EMAIL% - The email the user entered before the quiz</p>
			

		</div>
	
	</div>
	
	<div style="margin-bottom: 20px;">
		<h2>Existing Filters</h2>
	<table class="wp-list-table widefat fixed users">
		<thead>
			<tr>
				<th>Quiz Name</th>
				<th>Score A Greater Than Or Equal to</th>
				<th>Score A Less Than OR Equals to</th>
				<th>Score B Greater Than OR Equals to</th>
				<th>Score B Less Than  OR Equals to</th>
				<th>Results Page Shown</th>
				<th>Custome Text</th>
				<th>Action</th>

			</tr>	
		</thead>
		<tbody>
			
				<?php echo $getidandname->displayallfilters(); ?>
			
		</tbody>
	</table>
	</div>


<div style="margin-bottom: 20px;">
		<h2>Add New Filter</h2>
	<form action="" method="post">
	<table class="wp-list-table widefat fixed users">
		<thead>
			<tr>
				<th>Select Quiz</th>
				<th>Score A Greater Than</th>
				<th>Score A Less Than</th>
				<th>Score B Greater Than</th>
				<th>Score B Less Than</th>
				<th></th>
			</tr>	
		</thead>


<?php
	if(isset($_GET['filteredit'])){

		$filterid = $_GET['filterid'];
		
		

		global $wpdb;
		$table_name = $wpdb->prefix . "vsq_filter_results";
		$sql = "select * from $table_name where filter_result_id = $filterid ";

		$results = $wpdb->get_results($sql, OBJECT);
		

		foreach ($results as $result) {
			
		


		
		
	
?>
	<!-- Edit this -->
		<tbody>
			<tr>
				<td>
					<input type="hidden" name="vsq_quiz_id" value="<?php echo $result->quiz_id; ?>">
					<input type="hidden" name="vsq_update" value="<?php echo $result->quiz_id; ?>">
					<input type="hidden" name="filter_result_id" value="<?php echo $filterid ; ?>" />
					<?php echo $result->quiz_name; ?>
				</td>

				<td><input name="score_a_greater_than" type="text" size="3" value="<?php echo $result->score_a_greater_than; ?>" /></td>
				<td><input name="score_a_less_than" type="text" size="3" value="<?php echo $result->score_a_less_than; ?>" /></td>
				
				

				<td><input name="score_b_greater_than" type="text" size="3" value="<?php echo $result->score_b_greater_than; ?>" /></td>
				<td><input name="score_b_less_than" type="text" size="3" value="<?php echo $result->score_b_less_than; ?>" /></td>
				
			</tr>
			<tr>
				<td>
					<p>Results Page Shown</p>
					<p>User br tag to show varaible in next line e.g. %POINT_SCORE_A%</p>
					<p>You can also use custom message e.g. You score on Factor A is %POINT_SCORE_A%</p>
					<p>
						%POINT_SCORE_A% <br>
						%POINT_SCORE_B% <br>
					</p>
				</td>
				<td colspan="2"><textarea name="pagevariable" id="" cols="30" rows="10"><?php echo $result->pagevariable; ?></textarea></td>

				<td>Custom Text to show on result page</td>
				<td colspan="2"><textarea name="customtext" id="" cols="30" rows="10"><?php echo $result->customtext; ?></textarea></td>
				<td></td>
			</tr>

			<tr>
				<td colspan="2">
					<p>Custom Text Before Quiz</p>
					<p>The below given variables can be used any where in the message</p>
					<p>
						- %QUIZ_NAME% <br>
						- %CURRENT_DATE%
					</p>

				</td>
				<td colspan="3"><textarea name="customtextbeforequiz" id="" cols="30" rows="10"><?php echo $result->customtextbeforequiz; ?></textarea></td>
			</tr>

			<tr>
				<td colspan="4"><input type="submit" value="Save"></td>
			</tr>
		</tbody>
	<!-- edit this -->

<?php
	} //foreeach ends here
	} else {
?>	

	<!-- display for new post -->
		<tbody>
			<tr>
				<td>
					<select name="vsq_quiz_id" id="">

						<?php
							
							$getidandname->displayIdAndName();
						?>
					</select>
				</td>

				<td><input name="score_a_greater_than" type="text" size="3" value="0" /></td>
				<td><input name="score_a_less_than" type="text" size="3" value="100" /></td>
				
				

				<td><input name="score_b_greater_than" type="text" size="3" value="0" /></td>
				<td><input name="score_b_less_than" type="text" size="3" value="100" /></td>
				<td><input type="hidden" name="templatevariable" value="confirm" /></td>
			</tr>
			<tr>
				<td  colspan="2"><p>Results Page Shown</p>
					<p>User br tag to show varaible in next line e.g. %POINT_SCORE_A%</p>
					<p>You can also use custom message e.g. You score on Factor A is %POINT_SCORE_A%</p>
					<p>
						%POINT_SCORE_A% <br>
						%POINT_SCORE_B% <br>
					</p></td>
				<td colspan="2"><textarea name="pagevariable" id="" cols="30" rows="10">You have scored %POINT_SCORE_A% points</textarea></td>

				<td>Custom Text to show on result page</td>
				<td colspan="2"><textarea name="customtext" id="" cols="30" rows="10">Thank you for taking the quizz</textarea></td>
				<td></td>
			</tr>

			<tr>
				<td colspan="2">
					<p>Custom Text Before Quiz</p>
					<p>The below given variables can be used any where in the message</p>
					<p>
						- %QUIZ_NAME% <br>
						- %CURRENT_DATE%
					</p>

				</td>
				<td colspan="3"><textarea name="customtextbeforequiz" id="" cols="30" rows="10"><h1>Welcome to %QUIZ_NAME%</h1></textarea></td>
			</tr>

			<tr>
				<td colspan="4"><input type="submit" value="Save"></td>
			</tr>
		</tbody>
	<!-- display for new post -->

<?php } ?>



	</table>

	</form>
</div>
</div>


<?php
}
?>
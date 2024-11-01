<?php


function create_quizz_form(){
?>
	<div id="new_quiz_dialog" title="Create New Quiz" style="display:none;">
		<?php
		echo "<form action='' method='post'>";
		echo "<input type='hidden' name='create_quiz' value='confirmation' />";
		?>
		<table class="wide" style="text-align: left; white-space: nowrap;">
		<thead>

		<tr valign="top">
		<th scope="row">&nbsp;</th>
		<td></td>
		</tr>

		<tr valign="top">
		<th scope="row"><h3>Create New Quiz</h3></th>
		<td></td>
		</tr>
		<tr valign="top">
		<th scope="row">Quiz Name</th>
		<td>
		<input type="text" name="quiz_name" value="" style="border-color:#000000;
			color:#3300CC;
			cursor:hand;"/>
		</td>
		</tr>
		</thead>
		</table>
		<?php
		echo "<p class='submit'><input type='submit' class='button-primary' value='Create Quiz' /></p>";
		echo "</form>";
		?>
	</div>

<?php
}

function add_question_form(){
?>


	<div id="new_quiz_dialog" title="Create New Quiz" style="display:visible;margin-top: 31px;">

	<h2>Add new question using below form</h2>
		<?php
		echo "<form action='' method='post'>";
		echo "<input type='hidden' name='add_question' value='confirmation' />";
		?>

		<p>
			Question <input type="text" name="question_name" id="question_name" />


		</p>

		<table border="1" width="100%" cellspacing="0" cellpadding="0">
			<th></th>
			<tbody>
				<tr>
					<th>Sr</th>
					<th>Answers</th>
					<th>Points Worth Value A</th>
					<th>Correct</th>
					<th>Points Worth Value B</th>
				</tr>
				<tr>
					<td>1</td>
					<td align="center"><input type="text" name="answer_one" id="answer_one"></td>
					<td align="center"><input type="text" name="answer_one_points" id="answer_one_points" size="3"></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]"  value="1"></td>
					<td align="center"><input type="text" size="3" name="answer_one_points_b" id="answer_one_points_b" ></td>		
				</tr>
				<tr>
					<td>2</td>
					<td align="center"><input type="text" name="answer_two" id="answer_two"></td>
					<td align="center"><input type="text" name="answer_two_points" id="answer_two_points" size="3"></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]"  value="2"></td>
					<td align="center"><input type="text" size="3" name="answer_two_points_b" id="answer_two_points_b" ></td>		
				</tr>
				<tr>
					<td>3</td>
					<td align="center"><input type="text" name="answer_three" id="answer_three"></td>
					<td align="center"><input type="text" name="answer_three_points" id="answer_three_points" size="3"></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]"  value="3"></td>
					<td align="center"><input type="text" size="3" name="answer_three_points_b" id="answer_three_points_b" ></td>		
				</tr>
				<tr>
					<td>4</td>
					<td align="center"><input type="text" name="answer_four" id="answer_four"></td>
					<td align="center"><input type="text" name="answer_four_points" id="answer_four_points" size="3"></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]"  value="4"></td>
					<td align="center"><input type="text" size="3" name="answer_four_points_b" id="answer_four_points_b" ></td>		
				</tr>
				<tr>
					<td>5</td>
					<td align="center"><input type="text" name="answer_five" id="answer_five"></td>
					<td align="center"><input type="text" name="answer_five_points" id="answer_five_points" size="3"></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]"  value="5"></td>
					<td align="center"><input type="text" size="3" name="answer_five_points_b" id="answer_five_points_b" ></td>		
				</tr>
				<tr></tr>
				<tr>
					<td colspan="2">Question Display Option</td>
					<td colspan="2"><select name="question_type" id="question_type" >
						<option value="checkbox">Checkbox</option>
						<option value="radio" selected="selected" >Radio</option>




					</select></td>
				</tr>

				<tr>
					<td colspan="2">Display Option</td>
					<td colspan="2"><select name="answerdisplaytype" id="answerdisplaytype" >
						<option value="vertical">vertical</option>
						<option value="horizontal" selected="selected" >horizontal</option>




					</select></td>
				</tr>

			</tbody>

		</table>

		<?php
		echo "<p class='submit'><input type='submit' class='button-primary' value='Add Question' /></p>";
		echo "</form>";
		?>
	</div>


<?php
}


function edit_question_form($questionid){
	global $wpdb;
		$table_name = $wpdb->prefix . "vsq_questions";

		$sql = "select * from $table_name where question_id = '$questionid' ";
		$questionset = $wpdb->get_results( $sql );

		foreach ($questionset as $questionvalue) {
?>


	<div id="new_quiz_dialog" title="Create New Quiz" style="display:visible;margin-top: 31px;">

	<h2>Edit Question using below form</h2>
		<?php
		echo "<form action='' method='post'>";
		echo "<input type='hidden' name='update_vsq_question' value='EditQuestion' />";
		?>
		<p>
			Question 
			<input type="text" name="question_name" id="question_name" value="<?php echo $questionvalue->question_name; ?>" />
			<input type="hidden" name="vsq_question_id" value="<?php echo $questionid; ?>"/>
		</p>
		<?php 

			$correctAnsArray = explode(',',$questionvalue->answer_array); 
			
		?>
		<table border="1" width="100%" cellspacing="0" cellpadding="0">
			<th></th>
			<tbody>
				<tr>
					<th>Sr</th>
					<th>Answers</th>
					<th>Points Worth Value A</th>
					<th>Correct</th>
					<th>Points Worth Value B</th>
				</tr>
				<tr>
					<td>1</td>
					<td align="center"><input type="text" name="answer_one" id="answer_one" value="<?php echo $questionvalue->answer_one; ?>" /></td>
					<td align="center"><input type="text" name="answer_one_points" id="answer_one_points" size="3" value="<?php echo $questionvalue->answer_one_points; ?>"/></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]" <?php if(in_array(1, $correctAnsArray)){ echo 'checked="checked"'; } ?> value="1"></td>
					<td align="center"><input type="text" size="3" name="answer_one_points_b" id="answer_one_points_b" value="<?php echo $questionvalue->answer_one_points_b; ?>" /></td>		
				</tr>
				<tr>
					<td>2</td>
					<td align="center"><input type="text" name="answer_two" id="answer_two" value="<?php echo $questionvalue->answer_two; ?>" /></td>
					<td align="center"><input type="text" name="answer_two_points" id="answer_two_points" size="3" value="<?php echo $questionvalue->answer_two_points; ?>" /></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]" <?php if(in_array(2, $correctAnsArray)){ echo 'checked="checked"'; } ?> value="2"></td>
					<td align="center"><input type="text" size="3" name="answer_two_points_b" id="answer_two_points_b" value="<?php echo $questionvalue->answer_two_points_b; ?>" /></td>		
				</tr>
				<tr>
					<td>3</td>
					<td align="center"><input type="text" name="answer_three" id="answer_three" value="<?php echo $questionvalue->answer_three; ?>" /></td>
					<td align="center"><input type="text" name="answer_three_points" id="answer_three_points" size="3" value="<?php echo $questionvalue->answer_three_points; ?>" /></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]" <?php if(in_array(3, $correctAnsArray)){ echo 'checked="checked"'; } ?>  value="3"></td>
					<td align="center"><input type="text" size="3" name="answer_three_points_b" id="answer_three_points_b" value="<?php echo $questionvalue->answer_three_points_b; ?>" /></td>		
				</tr>
				<tr>
					<td>4</td>
					<td align="center"><input type="text" name="answer_four" id="answer_four" value="<?php echo $questionvalue->answer_four; ?>" /></td>
					<td align="center"><input type="text" name="answer_four_points" id="answer_four_points" size="3" value="<?php echo $questionvalue->answer_four_points; ?>" /></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]" <?php if(in_array(4, $correctAnsArray)){ echo 'checked="checked"'; } ?>  value="4"></td>
					<td align="center"><input type="text" size="3" name="answer_four_points_b" id="answer_four_points_b" value="<?php echo $questionvalue->answer_four_points_b; ?>" /></td>		
				</tr>
				<tr>
					<td>5</td>
					<td align="center"><input type="text" name="answer_five" id="answer_five" value="<?php echo $questionvalue->answer_five; ?>" /></td>
					<td align="center"><input type="text" name="answer_five_points" id="answer_five_points" size="3" value="<?php echo $questionvalue->answer_five_points; ?>" /></td>
					<td align="center"><input type="checkbox" name="correct_option[]" id="correct_option[]" <?php if(in_array(5, $correctAnsArray)){ echo 'checked="checked"'; } ?> value="5"></td>
					<td align="center"><input type="text" size="3" name="answer_five_points_b" id="answer_five_points_b" value="<?php echo $questionvalue->answer_five_points_b; ?>" /></td>		
				</tr>
				<tr></tr>
				<tr>
					<td colspan="2">Question Display Option</td>
					<td colspan="2"><select name="question_type" id="question_type" >
						<option <?php if($questionvalue->question_type == 'checkbox'){echo 'selected="selected"';} ?> value="checkbox">Checkbox</option>
						<option <?php if($questionvalue->question_type == 'radio'){echo 'selected="selected"';} ?> value="radio">Radio</option>




					</select></td>
				</tr>

				<tr>
					<td colspan="2">Display Option</td>
					<td colspan="2"><select name="answerdisplaytype" id="answerdisplaytype" >
						<option <?php if($questionvalue->answerdisplaytype == 'vertical'){echo 'selected="selected"';} ?> value="vertical">vertical</option>
						<option <?php if($questionvalue->answerdisplaytype == 'horizontal'){echo 'selected="selected"';} ?> value="horizontal">horizontal</option>




					</select>
					</td>
				</tr>

			</tbody>

		</table>

		<?php
		echo "<p class='submit'><input type='submit' class='button-primary' value='Update Question' /></p>";
		echo "</form>";
		?>
	</div>


<?php
	}//foreach ends
}

/**
 * [add_form_option_box description]
 * @param [type]  $optiontype [description]
 * @param integer $value      [description]
 */
function add_form_option_box($i,$optiontype,$valuea=0,$valueb=0){

	$value = $valuea . "," . $valueb;
	return "<input name='answer_option[$i]' type='$optiontype' value='$value' />";

}

?>
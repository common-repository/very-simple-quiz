<?php

function vsq_generate_quiz_admin(){

	global $wpdb;
	$table_name = $wpdb->prefix . "vsq_quizzes";

	//create new quizz name
	if ( isset( $_POST["create_quiz"] ) && $_POST["create_quiz"] == "confirmation" ){

		$quiz_name = htmlspecialchars($_POST["quiz_name"], ENT_QUOTES);

		$insert = "INSERT INTO " . $table_name .
			"(quiz_id, quiz_name) " .
			"VALUES (NULL , '".$quiz_name."' )";
		$results = $wpdb->query( $insert );

		if ($results != false){

		echo "Quizz created";
		}
	}

	//create new quizz name -- ends

	//Update Quizz name
	if(isset($_POST['update_quiz_name'])){
		$quizid = $_POST['edit_quiz_id'];
		$quiz_new_name =  $_POST['quiz_name'];

		$sql = "UPDATE $table_name SET quiz_name = '$quiz_new_name' WHERE quiz_id = $quizid ";
		$results = $wpdb->query( $sql );

	}


	//Delete Quizz

	if(isset($_GET['actiondelete'])){
		$quizid = $_GET['editquiz_id']; 
		
		$sql = "DELETE FROM $table_name WHERE quiz_id = $quizid ";
		$results = $wpdb->query( $sql );
	}
	

	
?>
<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ); ?>vsq.js"></script>

<div class="wrap">
	<h1>Very Simple Quizz</h1>
	<button id="new_quiz_button_two">Create</button>
	<?php echo create_quizz_form(); ?>
</div><!-- wrap -->

<?php

	///Retrieve list of quizzes.
	global $wpdb;
	$wpdb->get_var( "SELECT quiz_id, quiz_name FROM " . $wpdb->prefix . "vsq_quizzes" );
	$mlw_quiz_data = $wpdb->get_results("SELECT quiz_id, quiz_name FROM " . $wpdb->prefix . "vsq_quizzes");
	
	echo "<table  border=\"1\" width='100%'>";

	foreach($mlw_quiz_data as $mlw_quiz_info) {


		echo "<tr>";
		echo "<td>" . $mlw_quiz_info->quiz_id . "</td>";

		echo "<td>";
		echo esc_html($mlw_quiz_info->quiz_name) . '<br>';
		echo "<a href='admin.php?page=simple_quiz&&actiondetail=editname&&editquiz_id=".$mlw_quiz_info->quiz_id."&&edit_quiz_name=".esc_html($mlw_quiz_info->quiz_name)."'>Edit Name</a>";	
		echo "</td>";

		echo "<td>
		<div>
		<span style='color:green;font-size:12px;'>
			<a href='admin.php?page=vsq_quiz_options&&quiz_id=".$mlw_quiz_info->quiz_id."'>Add / Edit</a> | 
			<a href='admin.php?page=simple_quiz&&actiondelete=deletequiz&&editquiz_id=".$mlw_quiz_info->quiz_id."'>Delete</a> | 
			<a href='admin.php?page=vsq_quiz_result&&quiz_id=".$mlw_quiz_info->quiz_id."'>Results</a>
			
		</span>
		</div></td>";
		echo "<td><span style='font-size:16px;'>[vsq_quiz quiz=".$mlw_quiz_info->quiz_id."]</span></td>";


		echo "</tr>";

	}

	echo "</table>";



//Edit Quiz Name
	if(isset($_GET['actiondetail']) == 'editname'){

		echo $_GET['actiondetail'];

		echo $_GET['editquiz_id']; 

		//edit_quiz_name
		echo $_GET['edit_quiz_name']; 

?>

	<div id="new_quiz_dialog" title="Edit Quiz Name">
		
		<form action='' method='post'>
		<input type='hidden' name='update_quiz_name' value='confirmation' />
		
		<table class="wide" style="text-align: left; white-space: nowrap;">
		<thead>

		<tr valign="top">
		<th scope="row"><h3>Edit Quiz Name</h3></th>
		<td></td>
		</tr>
		<tr valign="top">
		<th scope="row">Quiz Name</th>
		<td>
		<input type="hidden" name="edit_quiz_id" value="<?php echo $_GET['editquiz_id'];  ?>" />
		<input type="text" name="quiz_name" value="<?php echo $_GET['edit_quiz_name']; ?>" style="border-color:#000000;
			color:#3300CC;
			cursor:hand;"/>
		</td>
		</tr>
		</thead>
		</table>
		<p class='submit'><input type='submit' class='button-primary' value='Update Quizz Name' /></p>
		</form>
		
	</div>

<?php		
		
	}


}

?>
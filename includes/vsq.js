var $j = jQuery.noConflict();

$j(document).ready(function($) {
	//alert('hello');
	//
	$('#new_quiz_button_two').click(function(e) {
		/* Act on the event */
		$('#new_quiz_dialog').show();
	});

	$('#add_question').click(function(e) {
		/* Act on the event */
		$('#add_question_form').show();
	});


});

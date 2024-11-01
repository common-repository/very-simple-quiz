<?php
/*
Plugin Name: Very Simple Quizz
Description: Use this plugin to add multiple quizzes and show different pages based on results.
Version: 1.0.0
Author: Brijesh Mishra
Author URI:https://profiles.wordpress.org/brijeshmkt/
Plugin URI: https://profiles.wordpress.org/brijeshmkt/
*/
include("includes/vsq_quizz_helper.php");
include("includes/vsq_quiz.php");
include("includes/quiz_dashboard.php");
include("includes/vsq_quiz_admin.php");
include("includes/vsq_template.php");
include("includes/vsq_quiz_install.php");
include("includes/vsq_quiz_options.php");
include("includes/vsq_quiz_result.php"); 
include("includes/vsq_filter_result.php");

///Activations

add_action('admin_menu','vsq_add_menu' );
register_activation_hook( __FILE__, 'vsq_quiz_activate');
register_deactivation_hook( __FILE__, 'vsq_quiz_deactivate');

function my_scripts_method() {
	wp_enqueue_script('vsq',plugins_url( 'vsq.js' , __FILE__ ));

}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );



///Create Admin Pages

function vsq_add_menu(){

	add_menu_page('Simple Quiz','Quiz Dashboard', 'manage_options', __FILE__, 'vsq_generate_quiz_dashboard', '',75);
	add_submenu_page(__FILE__, 'Quizzes', 'Quizzes', 'manage_options', 'simple_quiz', 'vsq_generate_quiz_admin');
	
	
	add_submenu_page(__FILE__, 'Quizz Result', 'Quizz Result', 'manage_options', 'vsq_quiz_result', 'vsq_generate_quiz_results');
	add_submenu_page(__FILE__, 'Filter Result', 'Filter Result', 'manage_options', 'vsq_filter_result', 'vsq_generate_quiz_filter_results');
	add_submenu_page(__FILE__, '', '', 'manage_options', 'vsq_quiz_options', 'vsq_generate_quiz_options');

}
?>
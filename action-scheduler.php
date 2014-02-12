<?php
/*
Plugin Name: Action Scheduler
Plugin URI: https://github.com/flightless/delayed-job
Description: A robust action scheduler for WordPress
Author: Flightless
Author URI: http://flightless.us/
Version: 1.0-dev
*/

if ( !function_exists('action_scheduler_register_1_dot_0_dev') ) {

	if ( !class_exists( 'ActionScheduler_Versions' ) ) {
		require_once('classes/ActionScheduler_Versions.php');
		add_action( 'plugins_loaded', array( 'ActionScheduler_Versions', 'initialize_latest_version' ), 1, 0 );
	}

	add_action( 'plugins_loaded', 'action_scheduler_register_1_dot_0_dev', 0, 0 );

	function action_scheduler_register_1_dot_0_dev() {
		$versions = ActionScheduler_Versions::instance();
		$versions->register( '1.0-dev', 'action_scheduler_initialize_1_dot_0_dev' );
	}

	function action_scheduler_initialize_1_dot_0_dev() {
		require_once('classes/ActionScheduler.php');
		ActionScheduler::init( __FILE__ );
	}

}
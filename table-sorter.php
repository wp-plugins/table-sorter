<?php
/**
 * Plugin Name: Table Sorter
 * Plugin URI: http://tablesorter.oregasoft.com
 * Description: This plugin makes your standard HTML tables sortable. For more details, visit plugin's setting page
 * Version: 1.1
 * Author: Farhan Noor
 * Author URI: http://linkedin.com/in/thenoors
 * License: Commercial
 */

function tablesorter_enque_scripts(){
	wp_register_script('table-sorter',plugins_url('table-sorter/jquery.tablesorter.min.js','table-sorter'),array('jquery'));
	wp_enqueue_script('table-sorter-metadata',plugins_url('table-sorter/jquery.metadata.js','table-sorter'),array('table-sorter'));
	wp_enqueue_script('table-sorter-custom-js',plugins_url('table-sorter/wp-script.js','table-sorter'));
	wp_enqueue_style('table-sorter-custom-css',plugins_url('table-sorter/wp-style.css'));
}
add_action( 'wp_enqueue_scripts', 'tablesorter_enque_scripts' );


function my_plugin_menu(){
	add_options_page( 'Table Sorter', 'Table Sorter', 'manage_options', 'table-sorter', 'tablesorter_callback');
}
add_action('admin_menu', 'my_plugin_menu');
function tablesorter_callback(){
	require_once('wp-admin-page.php');
}

function my_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'table-sorter.php' ) !== false ) {
		$new_links = array('<a href="' . admin_url( 'options-general.php?page=table-sorter' ) . '">Settings</a>');
		$links = array_merge( $links, $new_links );
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'my_plugin_row_meta', 10, 2 );

function add_action_links ( $links ) {
	$mylinks = array('<a href="' . admin_url( 'options-general.php?page=table-sorter' ) . '">Settings</a>');
	return array_merge( $links, $mylinks );
}
add_filter( 'plugin_action_links_table-sorter/table-sorter.php', 'add_action_links' );
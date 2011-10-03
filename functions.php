<?php

/*
 * functions.php for wp-torrent *
 */


# make it clean
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
if(function_exists( 'show_admin_bar' )) {
	add_action( 'show_admin_bar', '__return_false' );
}

require_once(TEMPLATEPATH . 'functions/shortcode.php'); // load the master shortcode file
require_once(TEMPLATEPATH . 'functions/widgets.php'); // load the master widgets file
require_once(TEMPLATEPATH . 'functions/menus.php'); // load the menu file

# end

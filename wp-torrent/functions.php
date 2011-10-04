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

require_once(TEMPLATEPATH . '/functions/shortcode.php'); // load the master shortcode file
require_once(TEMPLATEPATH . '/functions/widgets.php'); // load the master widgets file
require_once(TEMPLATEPATH . '/functions/menus.php'); // load the menu file

# add torrent post type

add_action('init', 'create_torrent_post_type');
 
function create_torrent_post_type() {
 
	$labels = array(
		'name' => __('Torrents', 'wp-torrent'), 'post type general name',
		'singular_name' => __('Torrent', 'wp-torrent'), 'post type singular name',
		'add_new' => __('Add new', 'wp-torrent'), 'torrent item',
		'add_new_item' => __('Add new torrent', 'wp-torrent'),
		'edit_item' => __('Edit torrent', 'wp-torrent'),
		'new_item' => __('New torrent', 'wp-torrent'),
		'view_item' => __('View torrent', 'wp-torrent'),
		'search_items' => __('Search torrent', 'wp-torrent'),
		'not_found' =>  __('Nothing found', 'wp-torrent'),
		'not_found_in_trash' => __('Nothing found in Trash', 'wp-torrent'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'torrent', 'with_front' => false ),
		'capability_type' => 'post',
		'hierarchical' => true,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'page-attributes', 'thumbnail', 'comments')
	  ); 
 
	register_post_type( 'torrent' , $args );
}

$category_labels = array(
	'name' => __( 'Torrent category', 'wp-torrent' ),
	'singular_name' => __( 'Torrent category', 'wp-torrent'),
	'search_items' =>  __( 'Search category', 'wp-torrent' ),
	'popular_items' => __( 'Popular categories', 'wp-torrent' ),
	'all_items' => __( 'All categories', 'wp-torrent' ),
	'edit_item' => __( 'Edit category', 'wp-torrent' ), 
	'update_item' => __( 'Update category', 'wp-torrent' ),
	'add_new_item' => __( 'Add new category', 'wp-torrent' ),
	'new_item_name' => __( 'New category name', 'wp-torrent' ),
	'add_or_remove_items' => __( 'Add or remove category', 'wp-torrent' ),
	'choose_from_most_used' => __( 'Choose from the most used categories', 'wp-torrent' ),
	'menu_name' => __( 'Torrent Categories', 'wp-torrent' ),
);

register_taxonomy( 'torrent-categories', array("torrent"), array("hierarchical" => true, "labels" => $category_labels, "rewrite" => true ) );

# change role names

function change_role_name() {
	global $wp_roles;

	if ( ! isset( $wp_roles ) )
		$wp_roles = new WP_Roles();
	# administrator
	$wp_roles->roles['administrator']['name'] = 'Owner';
	$wp_roles->role_names['administrator'] = 'Owner';
	# editor
	$wp_roles->roles['editor']['name'] = 'Moderator';
	$wp_roles->role_names['editor'] = 'Moderator';
	# author
	$wp_roles->roles['author']['name'] = 'Uploader';
	$wp_roles->role_names['author'] = 'Uploader';
	# contributor
	$wp_roles->roles['contributor']['name'] = 'VIP';
	$wp_roles->role_names['contributor'] = 'VIP';
	# subscriber
	$wp_roles->roles['subscriber']['name'] = 'Member';
	$wp_roles->role_names['subscriber'] = 'Member';
	

}
add_action('init', 'change_role_name');

# end 

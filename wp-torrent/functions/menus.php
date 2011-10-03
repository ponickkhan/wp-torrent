<?php


add_theme_support( 'nav-menus' );
function register_menus() {
	if ( function_exists( 'wp_nav_menu' ) )
		register_nav_menus(
			array(
				'main-navigation' => __( 'Main Navigation', 'wp-torrent' ),
				'footer-navigation' => __( 'Footer Navigation', 'wp-torrent' )
			)
		);
}
add_action( 'init', 'register_menus' );


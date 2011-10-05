<?php

function wptorrent_footer_sidebar_class() { // from twentyeleven
	$count = 0;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

function wptorrent_widgets_init() {

	#register_widget( 'torrent-latest' );

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'wp-torrent' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>\n",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>' . "\n",
	) );
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'wp-torrent' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'wp-torrent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'wp-torrent' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'wp-torrent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'wp-torrent' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'wp-torrent' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'wptorrent_widgets_init' );

require_once('widgets/torrent-latest.php'); // Widget: Latest Torrents

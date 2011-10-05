<?php

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
}
add_action( 'widgets_init', 'wptorrent_widgets_init' );

require_once('widgets/torrent-latest.php'); // Widget: Latest Torrents

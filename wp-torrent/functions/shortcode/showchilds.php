<?php

function showchilds_func( $atts ) { 
	global $post;
	$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
	if ($children) { ?>
	<ul>
	<?php echo $children; ?>
	</ul>
	<?php }
}

add_shortcode( 'showchilds', 'showchilds_func' );

/* function showchilds_sum_func( $atts ) { 
	global $post;
	$children = wp_list_pages('title_li=&child_of='.$post->ID.'&echo=0');
	if ($children) { ?>
	<ul>
	<?php echo $children; ?>
	</ul>
	<?php }
}

add_shortcode( 'showchilds_sum', 'showchilds_sum_func' ); */
<?php

class users_latest extends WP_Widget {
	/** constructor */
	function __construct() {
		parent::WP_Widget( 'user-latest', 'Latest users', array( 'description' => 'Display the latest users' ) );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
		global $wpdb;
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$number = intval(apply_filters( 'widget_number', $instance['number'] ));
		$usernames = $wpdb->get_results("SELECT user_nicename, user_url FROM $wpdb->users ORDER BY ID DESC LIMIT " . $number);
		
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title; ?>
		<ul>
		<?php foreach ($usernames as $username) {
			echo '<li><a href="'.$username->user_url.'">'.$username->user_nicename."</a></li>";
		} ?>
		</ul>
		<?php echo $after_widget;
	}

	/** @see WP_Widget::update */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$number = esc_attr( $instance[ 'number' ] );
		}
		else {
			$title = __( 'Latest users', 'wp-torrent' );
			$number = 5;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of users:'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
		</p>
		<?php 
	}

} // class Foo_Widget

add_action( 'widgets_init', create_function( '', 'register_widget("users_latest");' ) );

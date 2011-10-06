<?php
/*
Template Name: User Profile
*/

auth_redirect_login(); // if not logged in, redirect to login page
nocache_headers();

global $userdata, $errmsg;
get_currentuserinfo(); // grabs the user info and puts into vars


// check to see if the form has been posted. If so, validate the fields
if ( !empty($_POST['submit']) ) {

	if ( defined('ABSPATH') ) {
		require_once(ABSPATH . 'wp-admin/includes/user.php');
	} else {
		require_once('../wp-admin/includes/user.php');
	}

	require_once( ABSPATH . WPINC . '/registration.php' );

	check_admin_referer( 'update-profile_' . $user_ID );

	$errors = edit_user( $user_ID );

	if ( is_wp_error( $errors ) ) {
		foreach ( $errors->get_error_messages() as $message )
			$errmsg = "$message";
			//exit;
	}


	// if there are no errors, then process the profile updates
	if ( $errmsg == '' ) {
		// update the user fields
		do_action( 'personal_options_update', $user_ID );

		wp_redirect( './?updated=true' );

	} else {

		$errmsg = '<div class="box-red"><strong>**  ' . $errmsg . ' **</strong></div>';
		$errcolor = 'style="background-color:#FFEBE8;border:1px solid #CC0000;"';
	}

}	

?>

<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

		<div class="entry-content">
		<?php if ( isset($_GET['updated']) ) { ?>
				<div class="box-yellow"><strong><?php _e('Your profile has been updated.','wp-torrent')?></strong><br /></div>
				<br />
		<?php  } ?>


		<?php echo $errmsg; ?>


		<form name="profile" id="your-profile" action="" method="post">
		<?php wp_nonce_field( 'update-profile_' . $user_ID ); ?>
		
		<input type="hidden" name="from" value="profile" />
		<input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />


		<table class="form-table">
			<tr>
				<th><label for="user_login"><?php _e('Username:','wp-torrent'); ?></label></th>
				<td><input type="text" name="user_login" class="regular-text" id="user_login" value="<?php esc_attr_e( $userdata->user_login ); ?>" maxlength="100" disabled /></td>
			</tr>
			<tr>
				<th><label for="first_name"><?php _e('First Name:','wp-torrent') ?></label></th>
				<td><input type="text" name="first_name" class="regular-text required" id="first_name" value="<?php esc_attr_e( $userdata->first_name ); ?>" maxlength="100" /></td>
			</tr>
			<tr>
				<th><label for="last_name"><?php _e('Last Name:','wp-torrent') ?></label></th>
				<td><input type="text" name="last_name" class="regular-text required" id="last_name" value="<?php esc_attr_e( $userdata->last_name ); ?>" maxlength="100" /></td>
			</tr>
			<tr>
				<th><label for="nickname"><?php _e('Nickname:','wp-torrent') ?></label></th>
				<td><input type="text" name="nickname" class="regular-text" id="nickname" value="<?php esc_attr_e( $userdata->nickname ); ?>" maxlength="100" /></td>
			</tr>
			<tr>
				<th><label for="display_name"><?php _e('Display Name:','wp-torrent') ?></label></th>
				<td>
					<select name="display_name" class="regular-dropdown" id="display_name">
					<?php
						$public_display = array();
						$public_display['display_displayname'] = esc_attr($userdata->display_name);
						$public_display['display_nickname'] = esc_attr($userdata->nickname);
						$public_display['display_username'] = esc_attr($userdata->user_login);
						$public_display['display_firstname'] = esc_attr($userdata->first_name);
						$public_display['display_firstlast'] = esc_attr($userdata->first_name) . '&nbsp;' . esc_attr($userdata->last_name);
						$public_display['display_lastfirst'] = esc_attr($userdata->last_name) . '&nbsp;' . esc_attr($userdata->first_name);
						$public_display = array_unique(array_filter(array_map('trim', $public_display)));
						foreach($public_display as $id => $item) {
					?>
						<option id="<?php echo $id; ?>" value="<?php echo esc_attr($item); ?>"><?php esc_attr_e($item); ?></option>
					<?php
						}
					?>
					</select>
				</td>
			</tr>

		<tr>
			<th><label for="email"><?php _e('Email:','wp-torrent') ?></label></th>
			<td><input type="text" name="email" class="regular-text" id="email" value="<?php esc_attr_e($userdata->user_email); ?>" maxlength="100" /></td>
		</tr>


		<tr>
			<th><label for="url"><?php _e('Website:','wp-torrent') ?></label></th>
			<td><input type="text" name="url" class="regular-text" id="url" value="<?php echo esc_url($userdata->user_url); ?>" maxlength="100" /></td>
		</tr>


		<tr>
			<th><label for="description"><?php _e('About Me:','wp-torrent'); ?></label></th>
			<td><textarea name="description" class="regular-text" id="description" rows="10" cols="50"><?php echo esc_textarea($userdata->description); ?></textarea></td>
		</tr>

		<?php
		$show_password_fields = apply_filters('show_password_fields', true);
		if ( $show_password_fields ) :
		?>

		<tr>
			<th><label for="pass1"><?php _e('New Password:','wp-torrent'); ?></label></th>
			<td>
				<input type="password" name="pass1" class="regular-text" id="pass1" maxlength="50" value="" /><br/>
				<span class="description"><?php _e('Leave this field blank unless you would like to change your password.','wp-torrent'); ?></span>
			</td>
		</tr>
		<tr>
		<th><label for="pass1"><?php _e('Password Again:','wp-torrent'); ?></label></th>
			<td>
				<input type="password" name="pass2" class="regular-text" id="pass2" maxlength="50" value="" /><br/>
				<span class="description"><?php _e('Type your new password again.','wp-torrent'); ?></span>
			</td>
		</tr>
		<tr>
		<th><label for="pass1">&nbsp;</label></th>
			<td>
				<span class="description"><?php _e('Your password should be at least seven characters long.','wp-torrent'); ?></span>
			</td>
		</tr>

		<?php endif; ?>

		</table>


		<?php
		do_action('profile_personal_options', $userdata);
		do_action('show_user_profile', $userdata);
		?>	
		<p class="submit center">
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_ID; ?>" />
			<input type="hidden" name="admin_color" value="<?php esc_attr_e( $userdata->admin_color ); ?>" />
			<input type="hidden" name="rich_editing" value="<?php esc_attr_e( $userdata->rich_editing ); ?>" />
			<input type="hidden" name="comment_shortcuts" value="<?php esc_attr_e( $userdata->comment_shortcuts ); ?>" />
			
			<?php if ( !empty($userdata->admin_bar_front) ) { ?>
				<input type="hidden" name="admin_bar_front" value="<?php esc_attr_e( $userdata->admin_bar_front ); ?>" />
			<?php } ?>
			
			<?php if ( !empty($userdata->admin_bar_admin) ) { ?>
				<input type="hidden" name="admin_bar_admin" value="<?php esc_attr_e( $userdata->admin_bar_admin ); ?>" />
			<?php } ?>
			
			<input type="submit" id="cpsubmit" value="<?php _e('Update Profile &raquo;', 'wp-torrent')?>" name="submit" />
		 </p>
		</form>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->

			</div><!-- #content -->
		</div><!-- #primary -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>

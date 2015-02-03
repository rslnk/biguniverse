<?php

/* CUSTOM ADMIN LOGIN HEADER LOGO
   function my_custom_login_logo() {
    echo '<style type="text/css"> h1 a { background-image:url('.get_bloginfo('template_directory').'/images/your-logo-image.png) !important; } </style>';
   }
   add_action('login_head', 'my_custom_login_logo');

//CUSTOM ADMIN LOGIN HEADER LINK & ALT TEXT
   function change_wp_login_url() {
   echo bloginfo('url');  // OR ECHO YOUR OWN URL
   }
   function change_wp_login_title() {
    echo get_option('blogname'); // OR ECHO YOUR OWN ALT TEXT
   }
   add_filter('login_headerurl', 'change_wp_login_url');
   add_filter('login_headertitle', 'change_wp_login_title');
 */ 

// CUSTOM ADMIN MENU LINK FOR ALL SETTINGS
   function all_settings_link() {
    add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');
   }
   add_action('admin_menu', 'all_settings_link');

// REMOVE THE WORDPRESS UPDATE NOTIFICATION FOR ALL USERS EXCEPT SYSADMIN
       global $user_login;
       get_currentuserinfo();
       if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins 
        add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
        add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
       }

/**
 * Rights and permitions (based on admins, editors, contributors roles)
 *
 * Editing links
 * Media upload by contributer (allowed)
 * 
 */

// Allow administrator and editor to see editing links on post items
function editingLink() {
	$editlink = get_edit_post_link();
	if (current_user_can('administrator')) {
			print '<a href="' . $editlink .'" class="edit"><i class="icon-circle-arrow-right"></i></a>';
	}
	elseif (current_user_can('editor')) {
			print '<a href="' . $editlink .'" class="edit"><i class="icon-circle-arrow-right"></i></a>';
	}
}
// Allow contributor to upload media
if ( current_user_can('contributor') && !current_user_can('upload_files') )
	add_action('admin_init', 'allow_contributor_uploads');
 
function allow_contributor_uploads() {
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
}

/**
* Setting up admin environment
*
* Disabling some default meta boxes
* Unregistering default widgets
*/


// Убираем ненужные виджеты из «Консоли»

function remove_dashboard_widgets() {
 	//remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // right now
 	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // recent comments
 	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // incoming links
 	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // plugins
 	remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');  // quick press
 	//remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');  // recent drafts
 	//remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // wordpress blog
 	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // other wordpress news
}
add_action('admin_init', 'remove_dashboard_widgets');

//Переименовываем мета бокс «Цитата» в «Преамбула» и удаляем текстовое описание
function my_post_excerpt_meta_box( $post ) {
	?>
	  <label class="screen-reader-text" for="excerpt"><?php _e( 'Excerpt' ) ?></label>
	  <textarea rows="1" cols="40" name="excerpt" tabindex="6" id="excerpt"><?php echo $post->post_excerpt; // textarea_escaped ?></textarea>
	<?php
	}

	function customize_metaboxes( $post_type, $post ) {
	  global $wp_meta_boxes;

	  $wp_meta_boxes[ 'post' ][ 'normal' ][ 'core' ][ 'postexcerpt' ][ 'title' ]    = 'Преамбула';
	  $wp_meta_boxes[ 'post' ][ 'normal' ][ 'core' ][ 'postexcerpt' ][ 'id' ]       = 'postexcerpt';
	  $wp_meta_boxes[ 'post' ][ 'normal' ][ 'core' ][ 'postexcerpt' ][ 'callback' ] = 'my_post_excerpt_meta_box';
}
add_action( 'add_meta_boxes', 'customize_metaboxes', 10, 2 );

// Disabling some meta boxes in post admin
add_action('admin_menu', 'dbt_remove_boxes');

function dbt_remove_boxes(){
  remove_meta_box('slugdiv', 'post', 'normal');
	remove_meta_box('postcustom', 'post', 'normal');
	remove_meta_box('commentstatusdiv', 'post', 'normal');
	remove_meta_box('commentsdiv', 'post', 'normal');
	remove_meta_box('revisionsdiv', 'post', 'normal');
}
// unregister all default WP Widgets
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);
?>
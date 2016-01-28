<?php
/*
  Theme Name: CONTAINER YARD MANAGER
  Theme URI: http://webnerdtz.com
  Description: A theme that provides yard management application
  Author: Benjamin Kisaki
  Author URI: http://webnerdtz.com
  Version: 0.1
*/
?>
<?php 
//handy contstant
define('TEMPL_PATH', get_bloginfo('template_directory'));

function register_scripts_and_styles(){
  wp_enqueue_style( 'pagination', TEMPL_PATH. '/pagination.css');
  wp_enqueue_style( 'pagination_styles', TEMPL_PATH. '/pagination_grey.css');
  wp_enqueue_style( 'kendo_common_style', TEMPL_PATH. '/kendo/styles/kendo.common.min.css' );
  wp_enqueue_style( 'kendo_theme_style', TEMPL_PATH . '/kendo/styles/kendo.blueopal.min.css' );

  //wp_enqueue_script('jquery');
  //wp_enqueue_script('kendo_scripts', TEMPL_PATH . '/kendo/js/kendo.web.min.js');
  //wp_enqueue_script('angular_scripts', TEMPL_PATH . '/js/angular.min.js');
}

add_action('wp_enqueue_scripts', 'register_scripts_and_styles');

add_filter('show_admin_bar', '__return_false');

// remove links in the admin menu

function remove_links_menu(){
	remove_menu_page('index.php'); // Dashboard
	remove_menu_page('edit.php'); // Posts
	remove_menu_page('upload.php'); // Media
	remove_menu_page('link-manager.php'); // Links
	remove_menu_page('edit.php?post_type=page'); // Pages
	remove_menu_page('edit-comments.php'); // Comments
	remove_menu_page('themes.php'); // Appearance
	remove_menu_page('plugins.php'); // Plugins
        if(!current_user_can('edit_posts')){
            remove_menu_page('users.php'); // Users
            remove_menu_page('options-general.php'); // Settings
        }
	remove_menu_page('tools.php'); // Tools
}
//add_action('admin_menu', 'remove_links_menu');

function admin_default_page() {
  return home_url().'/';
}

add_filter('login_redirect', 'admin_default_page');

function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: none;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

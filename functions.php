<?php
/*
Author: Antonio Castiglione
URL: https://minervawebdevelopment.com

*/

// LOAD pbl CORE (if you remove this, the theme will break)
require_once('library/pbl.php');

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
require_once('library/admin.php');

/*********************
LAUNCH pbl
Let's get everything up and running.
 *********************/

function pbl_ahoy()
{
  //Allow editor style.
  add_editor_style(get_stylesheet_directory_uri() . '/library/css/editor-style.css');

  // launching operation cleanup
  add_action('init', 'pbl_head_cleanup');
  // A better title
  add_filter('wp_title', 'rw_title', 10, 3);
  // remove WP version from RSS
  add_filter('the_generator', 'pbl_rss_version');
  // remove pesky injected css for recent comments widget
  add_filter('wp_head', 'pbl_remove_wp_widget_recent_comments_style', 1);
  // clean up comment styles in the head
  add_action('wp_head', 'pbl_remove_recent_comments_style', 1);
  // clean up gallery output in wp
  add_filter('gallery_style', 'pbl_gallery_style');

  // enqueue base scripts and styles
  add_action('wp_enqueue_scripts', 'pbl_scripts_and_styles', 999);

  // launching this stuff after theme setup
  pbl_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action('widgets_init', 'pbl_register_sidebars');

  // cleaning up random code around images
  add_filter('the_content', 'pbl_filter_ptags_on_images');
  // cleaning up excerpt
  add_filter('excerpt_more', 'pbl_excerpt_more');

  // Adding full-width blocks in editor support
  add_theme_support('align-wide');

  // Removing bloat for emojis and such
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
} /* end pbl ahoy */

// let's get this party started
add_action('after_setup_theme', 'pbl_ahoy');

/************* LOGIN PAGE STYLES  *************/

function my_admin_theme_style()
{
  wp_enqueue_style('my-admin-theme', get_stylesheet_directory_uri() . '/library/css/login.css');
}
add_action('admin_enqueue_scripts', 'my_admin_theme_style');
add_action('login_enqueue_scripts', 'my_admin_theme_style');

function minerva_url($url)
{
  return 'https://minervawebdevelopment.com';
}
add_filter('login_headerurl', 'minerva_url');

/************* OEMBED SIZE OPTIONS *************/

if (!isset($content_width)) {
  $content_width = 680;
}

/************* THEME CUSTOMIZE *********************/

function pbl_theme_customizer($wp_customize)
{
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  $wp_customize->remove_section('title_tagline');
  $wp_customize->remove_section('colors');
  $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');

  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action('customize_register', 'pbl_theme_customizer');

//sepreated customizer options by panels into thier own files
require('library/customizer/panels/external-libraries.php');

/************* ACTIVE SIDEBARS ********************/
require 'theme/sidebars.php';

/************* COMMENT LAYOUT *********************/
require 'theme/comments.php';

/************* UTILITIES/HELPERS *********************/
require get_template_directory() . '/theme/utils.php';

/************* CALL CUSTOM POST TYPES *********************/
// Call custom post types here

/************* CALL CUSTOM TAXONOMIES *********************/
// Call taxonomies here

/************* ACF REGISTRATION *********************/
// Activate ACF blocks
require get_template_directory() . '/theme/acf-blocks.php';
// Optional - Block Logic Files
require get_template_directory() . '/theme/block-logic/admin-ajax.php';
// Activate ACF settings page
require get_template_directory() . '/theme/acf-options-page.php';
// Activate ACF json import/export
require get_template_directory() . '/theme/acf-saves.php';

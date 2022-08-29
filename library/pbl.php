<?php

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
 *********************/

function pbl_head_cleanup()
{
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action('wp_head', 'rsd_link');
	// windows live writer
	remove_action('wp_head', 'wlwmanifest_link');
	// previous link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	// start link
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	// links for adjacent posts
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	// WP version
	remove_action('wp_head', 'wp_generator');
	// remove WP version from css
	// add_filter( 'style_loader_src', 'pbl_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	// add_filter( 'script_loader_src', 'pbl_remove_wp_ver_css_js', 9999 );

} /* end pbl head cleanup */

function rw_title($title, $sep, $seplocation)
{
	global $page, $paged;

	// Don't affect in feeds.
	if (is_feed()) return $title;

	// Add the blog's name
	if ('right' == $seplocation) {
		$title .= get_bloginfo('name');
	} else {
		$title = get_bloginfo('name') . $title;
	}

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');

	if ($site_description && (is_home() || is_front_page())) {
		$title .= " {$sep} {$site_description}";
	}

	// Add a page number if necessary:
	if ($paged >= 2 || $page >= 2) {
		$title .= " {$sep} " . sprintf(__('Page %s', 'dbt'), max($paged, $page));
	}

	return $title;
} // end better title

// remove WP version from RSS
function pbl_rss_version()
{
	return '';
}

// remove WP version from scripts
function pbl_remove_wp_ver_css_js($src)
{
	if (strpos($src, 'ver='))
		$src = remove_query_arg('ver', $src);
	return $src;
}

// remove injected CSS for recent comments widget
function pbl_remove_wp_widget_recent_comments_style()
{
	if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
		remove_filter('wp_head', 'wp_widget_recent_comments_style');
	}
}

// remove injected CSS from recent comments widget
function pbl_remove_recent_comments_style()
{
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
}

// remove injected CSS from gallery
function pbl_gallery_style($css)
{
	return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


/*********************
SCRIPTS & ENQUEUEING
 *********************/

// loading modernizr and jquery, and reply script
function pbl_scripts_and_styles()
{

	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

	if (!is_admin()) {

		// register main stylesheet
		wp_register_style('mwd-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all');

		// External stylesheets
		wp_register_style('bs-grid', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/css/bootstrap-grid.min.css', ['mwd-stylesheet'], false);
		wp_register_style('bs-utils', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta3/css/bootstrap-utilities.min.css', ['mwd-stylesheet'], false);

		//adding scripts file in the footer
		wp_register_script('mwd-js', get_stylesheet_directory_uri() . '/library/js/dist/scripts.min.js', array('jquery'), '', true);


		// enqueue styles and scripts
		wp_enqueue_style('mwd-stylesheet');
		wp_enqueue_style('pbl-ie-only');
		wp_enqueue_style('bs-grid');
		wp_enqueue_style('bs-utils');

		wp_enqueue_script('jquery');
		wp_enqueue_script('mwd-js');
	}
}

/*********************
THEME SUPPORT
 *********************/

// Adding WP 3+ Functions & Theme Support
function pbl_theme_support()
{

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support(
		'custom-background',
		array(
			'default-image' => '',    // background image default
			'default-color' => '',    // background color default (dont add the #)
			'wp-head-callback' => '_custom_background_cb',
			'admin-head-callback' => '',
			'admin-preview-callback' => ''
		)
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support(
		'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support('menus');

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __('The Main Menu', 'pbltheme'),   // main nav in header
			'footer-links' => __('Footer Links', 'pbltheme') // secondary nav in footer
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support('html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	));

	// Gutenberg Theme Support
	add_theme_support('align-wide');
} /* end pbl theme support */


/*********************
PAGE NAVI
 *********************/

// Numeric Page Navi (built into the theme by default)
function pbl_page_navi()
{
	global $wp_query;
	$bignum = 999999999;
	if ($wp_query->max_num_pages <= 1)
		return;
	echo '<nav class="pagination">';
	echo paginate_links(array(
		'base'         => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
		'format'       => '',
		'current'      => max(1, get_query_var('paged')),
		'total'        => $wp_query->max_num_pages,
		'prev_text'    => '&larr;',
		'next_text'    => '&rarr;',
		'type'         => 'list',
		'end_size'     => 3,
		'mid_size'     => 3
	));
	echo '</nav>';
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
 *********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function pbl_filter_ptags_on_images($content)
{
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function pbl_excerpt_more($more)
{
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="' . get_permalink($post->ID) . '" title="' . __('Read ', 'pbltheme') . esc_attr(get_the_title($post->ID)) . '">' . __('Read more &raquo;', 'pbltheme') . '</a>';
}

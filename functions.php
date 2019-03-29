<?php
add_action( 'wp_enqueue_scripts', 'wagw_2017_enqueue_styles' );
function wagw_2017_enqueue_styles() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'wagw_2017_google_fonts', 'https://fonts.googleapis.com/css?family=Raleway' );
}

add_action( 'wp_print_styles', 'wagw_remove_styles', 100 );
function wagw_remove_styles() {
	wp_dequeue_style( 'twentyseventeen-fonts' );
}

/**
 * change the recommended header image size to 600px high
**/

function wagw_2017_twentyseventeen_custom_header_args( $args ) {
	$args['height'] = 600;
	return $args;
}
add_filter( 'twentyseventeen_custom_header_args', 'wagw_2017_twentyseventeen_custom_header_args' );

/**
 * override the special featured image to be 600 high instead of 1200
**/
function wagw_2017_overide_featured_image() {
	add_image_size( 'twentyseventeen-featured-image', 2000, 600, true );
}
add_action( 'after_setup_theme', 'wagw_2017_overide_featured_image', 11 );

/* override the content width */
$content_width = 1200;
add_filter( 'jetpack_content_width', 'set_jp_cw' );
function set_jp_cw( $width ) {
	if ( ! $width ) {
		$width = 2000;
	}
	return $width;
}

/********* slider *****************/
function wagw_slider_scripts() {
	if ( is_page_template( 'slider-page.php' ) ) {
		wp_enqueue_style( 'flexslider-css', get_stylesheet_directory_uri() . '/flexslider/flexslider.css' );
	}

}
add_action( 'wp_enqueue_scripts', 'wagw_slider_scripts' );
// if using the slider-page template, enqueue flexsider
function wagw_flexslider_gallery_scripts() {
	if ( is_page_template( 'slider-page.php' ) ) {
		wp_enqueue_script( 'jquery' );
		wp_register_script( 'flexslider', get_stylesheet_directory_uri() . '/flexslider/jquery.flexslider-min.js', array( 'jquery' ), false, false );
		wp_register_script( 'load_flex', get_stylesheet_directory_uri() . '/js/load-flex.js', array( 'jquery', 'flexslider' ), false, false );

		$speed          = get_field( 'slideshow_speed' );
		$animation      = get_field( 'animation_speed' );
		$animation_type = get_field( 'animation_type' );
		$easing         = get_field( 'easing_method' );
		$controlNav     = $directionNav = false;
		if ( get_field( 'nextprev_arrows' ) ) {
			$directionNav = true;
		}
		if ( get_field( 'navigation_dots' ) ) {
			$controlNav = true;
		}
		if ( get_field( 'slider_carousel' ) ) {
			$controlNav = 'thumbnails';
		}

		// get the settings for this post

		$args = array(
			'animation'      => $animation_type,
			'animationSpeed' => $animation,
			'slideshowSpeed' => $speed,
			'controlNav'     => $controlNav,
			'directionNav'   => $directionNav,
			'easing'         => $easing,

		);
		wp_enqueue_script( 'flexslider' );
		wp_localize_script( 'load_flex', 'wagw', $args );
		wp_enqueue_script( 'load_flex' );
	}
}
add_action( 'wp_enqueue_scripts', 'wagw_flexslider_gallery_scripts' );

function shortcode_wagw_cols( $atts, $content ) {
	/*
	* left, right, and center are for divs on three column pages
	*/

	//move wpautop filter to AFTER shortcode is processed
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop', 99 );
	add_filter( 'the_content', 'shortcode_unautop', 100 );
	$a = shortcode_atts(
		array(
			'type' => 'center',
		),
		$atts
	);
	return '<div class="wagw_col wagw_col_' . sanitize_text_field( $a['type'] ) . '">' . $content . '</div>';
}
add_shortcode( 'wagw_col', 'shortcode_wagw_cols' );
function wagw_clear() {
	return '<div style="clear: both;"></div>';
}
add_shortcode( 'clear', 'wagw_clear' );

add_filter( 'wp_nav_menu_items', 'wpsites_add_logo_nav_menu', 10, 2 );

function wpsites_add_logo_nav_menu( $menu, stdClass $args ) {

	if ( 'top' != $args->theme_location ) {
		return $menu;
	}

	$menu      = '<span class="nav-image">' . get_custom_logo() . '</span>' .  '<span class="tagline">' . get_bloginfo( 'description' ) . '</span>' . $menu;

	return $menu;
}

// Move Yoast to bottom
function yoasttobottom() {
				return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom' );

/*
 * disable automatic jetpack share placement and move it
 * to just above the footer (see footer.php)
 */

function jptweak_remove_share() {
		remove_filter( 'the_content', 'sharing_display', 19 );
		remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}

add_action( 'loop_start', 'jptweak_remove_share' );

// Register Custom Post Type
function webdesign_portolio() {

	$labels = array(
		'name'                  => _x( 'Web Designs', 'Post Type General Name', 'wagw' ),
		'singular_name'         => _x( 'Web Design', 'Post Type Singular Name', 'wagw' ),
		'menu_name'             => __( 'Web Portfolio Items', 'wagw' ),
		'name_admin_bar'        => __( 'Web Design', 'wagw' ),
		'archives'              => __( 'Web Design Archives', 'wagw' ),
		'attributes'            => __( 'Web Design Attributes', 'wagw' ),
		'parent_item_colon'     => __( 'Parent Item:', 'wagw' ),
		'all_items'             => __( 'All Web Designs', 'wagw' ),
		'add_new_item'          => __( 'Add New Web Design', 'wagw' ),
		'add_new'               => __( 'Add New', 'wagw' ),
		'new_item'              => __( 'New Web Design', 'wagw' ),
		'edit_item'             => __( 'Edit Web Design', 'wagw' ),
		'update_item'           => __( 'Update Web Design', 'wagw' ),
		'view_item'             => __( 'View Web Design', 'wagw' ),
		'view_items'            => __( 'View Web Designs', 'wagw' ),
		'search_items'          => __( 'Search Web Designs', 'wagw' ),
		'not_found'             => __( 'Not found', 'wagw' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wagw' ),
		'featured_image'        => __( 'Featured Image', 'wagw' ),
		'set_featured_image'    => __( 'Set featured image', 'wagw' ),
		'remove_featured_image' => __( 'Remove featured image', 'wagw' ),
		'use_featured_image'    => __( 'Use as featured image', 'wagw' ),
		'insert_into_item'      => __( 'Insert into item', 'wagw' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Web Design', 'wagw' ),
		'items_list'            => __( 'Web Designs list', 'wagw' ),
		'items_list_navigation' => __( 'Web Designs list navigation', 'wagw' ),
		'filter_items_list'     => __( 'Filter Web Designs list', 'wagw' ),
	);
	$args = array(
		'label'                 => __( 'Web Design', 'wagw' ),
		'description'           => __( 'Web Design Portfolio entries', 'wagw' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'revisions' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-desktop',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
		'rewrite'		=> array( 'with_front' => false ),
	);
	register_post_type( 'web_design', $args );

}
add_action( 'init', 'webdesign_portolio', 0 );

/*
 * remove has-sidebar class from web portfolio CPTs
 */

add_filter( 'body_class', 'wagw_remove_has_sidebar', 11 );
function wagw_remove_has_sidebar( $classes ) {
   $pt = get_post_type();
   if ( 'web_design' == $pt ) {
     $array_without = array_diff($classes, array('has_sidebar'));
     $array_without[] = 'full_width';
     return $array_without;
    } else {
     return $classes;
    }
}

add_filter( 'the_content', 'wagw_return_to_portfolio' );
function wagw_return_to_portfolio( $content ) {
   $pt = get_post_type();
   if ( 'web_design' == $pt && is_single() ) {
      $content .= '<p class="return_to_portfolio"><a href="/web_design/">Return to Portfolio</a></p>';
   }
   return $content;
}

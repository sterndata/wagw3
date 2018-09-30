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
$content_width = 1000;
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


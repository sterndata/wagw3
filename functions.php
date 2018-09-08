<?php
add_action( 'wp_enqueue_scripts', 'wagw_2017_enqueue_styles' );
function wagw_2017_enqueue_styles() {

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'wagw_2017_google_fonts', 'https://fonts.googleapis.com/css?family=Bitter' );

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
function set_jp_cw( $width ){
   if ( ! $width ){
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

		$speed = get_field( 'slideshow_speed' );
		$animation = get_field( 'animation_speed' );
		$animation_type = get_field( 'animation_type' );
		$easing = get_field( 'easing_method' );
		$controlNav = $directionNav = false;
		if ( get_field( 'nextprev_arrows' ) ) { $directionNav = true;
		}
		if ( get_field( 'navigation_dots' ) ) { $controlNav = true;
		}
		if ( get_field( 'slider_carousel' ) ) { $controlNav = 'thumbnails';
		}

		// get the settings for this post

		$args = array(
		'animation'       => $animation_type,
		'animationSpeed'  => $animation,
		'slideshowSpeed'  => $speed,
		'controlNav'      => $controlNav,
		'directionNav'    => $directionNav,
		'easing'          => $easing,

		 );
		wp_enqueue_script( 'flexslider' );
		wp_localize_script( 'load_flex', 'wagw', $args );
		wp_enqueue_script( 'load_flex' );
	}
}
add_action( 'wp_enqueue_scripts', 'wagw_flexslider_gallery_scripts' );

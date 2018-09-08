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

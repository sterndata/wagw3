<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_sticky() && is_home() ) :
		echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>

	<?php
	$img = get_field( 'portfolio_image' );
	$src_set = ' srcset ="' . wp_get_attachment_image_srcset( $img['id'] ) . '" ';
	?>
	<div class="port_wrapper">
		<div class="navarrow navarrow-left">
		<?php if( $link = get_previous_post_link() ) {
			previous_post_link( '%link', '<span class="dashicons dashicons-arrow-left-alt2"></span>' );
			}
			?></div>
		<div class="portfolio_image">
		<?php echo '<img src="' . $img['url'] . '" ' . $src_set . '/>'; ?>
        	</div>
		<div class="navarrow navarrow-right">
		<?php if( $link = get_next_post_link() ) {
                        next_post_link( '%link', '<span class="dashicons dashicons-arrow-right-alt2"></span>' );
                        }
                        ?></div>

		</div>
	</div>

	<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>

	</header><!-- .entry-header -->
 

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content(
				sprintf(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
					get_the_title()
				)
			);

		?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ) : ?>
		<?php  twentyseventeen_entry_footer(); ?>
	<?php endif; ?>

</article><!-- #post-## -->

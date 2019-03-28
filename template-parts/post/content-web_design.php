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
	echo '<div class="portfolio_image">';
	echo '<img src="' . $img['url'] . '" ' . $src_set . '/>';
        echo '</div>'
	?>

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

			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				)
			);
		?>
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', '_sds' ), __( '1 Comment', '_sds' ), __( '% Comments', '_sds' ) ); ?></span>
<?php } ?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ) : ?>
		<?php twentyseventeen_entry_footer(); ?>
	<?php endif; ?>

</article><!-- #post-## -->

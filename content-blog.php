<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package What A Great Website
 *
 * This is for the blog template
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( ! is_front_page() ) { ?>
<?php
if (has_post_thumbnail() ) {
        echo '<div class="inner-post-thumbnail">';
        the_post_thumbnail();
        echo '</div>';
}
?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php
	the_content();

		?>

<?php } ?>
	<div class="entry-content">
		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'wagw' ),
					'after'  => '</div>',
				)
			);
			?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'wagw' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package What A Great Website
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( ! is_front_page() ) { ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php
	the_content();

	if ( have_rows( 'slides' ) ) {
		?>

<div id="grid" class="grid">

		<?php
		while ( have_rows( 'slides' ) ) {
			the_row();
			$image         = get_sub_field( 'slide_image' );
			$slide_caption = get_sub_field( 'slide_caption' );
			$slide_content = get_sub_field( 'slide_content' );
			$src_set = ' srcset ="' . wp_get_attachment_image_srcset( $image['id'] ) . '" ';
			?>
<div class="box services">
<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" <?php echo $src_set; ?> />
			<?php
			echo '<span class="services_caption">' . $slide_caption . '</span>';
			echo '<span class="services_content">' . $slide_content . '</span>';
			?>

		</div><!-- box -->
			<?php } // while have rows ?>
</div><!-- grid -->
		<?php
	} // images

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

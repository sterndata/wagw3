<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package What A Great Website
 */
?>

<?php add_thickbox(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( ! is_front_page() ) { ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php
}
if ( have_rows( 'slides' ) ) {
	?>

<div id="grid" class="grid">

<?php

$content_id = 0;

while ( have_rows( 'slides' ) ) {
	the_row();
	$image         = get_sub_field( 'slide_image' );
	$slide_caption = get_sub_field( 'slide_caption' );
	$slide_tag     = get_sub_field( 'slide_tag' );
	/*
	* slide target is a the same image, full size, shown in the thickbox
	*/
	$srcset = ' srcset ="' . wp_get_attachment_image_srcset( $image['id'] ) . '" ';
	?>
	<div id="<?php echo 'my-content-id-' . $content_id; ?>" style="display:none;">
		<p>
		<?php echo '<span class="slide_caption_wrapper"><span class="slide_caption">' . $slide_caption . '</span><span class="slide_tag">' . $slide_tag . '</span></span>'; ?>
		<img src="<?php echo $image['url']; ?>" <?php echo $srcset; ?> class="aligncenter" >
		</p>
	</div>

	<?php
	$href = '<a href="#TB_inline?width=800&inlineId=my-content-id-' . $content_id++ . '" class="thickbox thickbox-size">';
	?>

<div class="box">
	<?php
		echo $href;
	?>
	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" <?php echo $srcset; ?> />
	<?php
	if ( get_field( 'show_image_captions' ) ) {
		if ( $slide_caption ) {
			echo '<span class="slide_caption_wrapper"><span class="slide_caption">' . $slide_caption . '</span><span class="slide_tag">' . $slide_tag . '</span></span>';
		}
	} // captions
	?>
	</a>

		</div><!-- box -->
	<?php } // while have rows                           ?>
</div><!-- grid -->
<?php
} // images

?>
	<div class="entry-content">
		<?php the_content(); ?>
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

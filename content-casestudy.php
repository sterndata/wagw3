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

	if ( have_rows( 'case' ) ) {
		$use_srcset = false;
		if ( function_exists( 'wp_get_attachment_image_srcset' ) ) { $use_srcset = true; }
		/// ?>

<div id="grid" class="grid">

<?php
while ( have_rows( 'case' ) ) {
	the_row();
	$title = get_sub_field( 'title' );
	$before_image = get_sub_field( 'before_image' );
	$after_image = get_sub_field( 'after_image' );
	$before_title = get_sub_field( 'before_title' );
	$after_title = get_sub_field( 'after_title' );
	$challenge = get_sub_field( 'challenge' );
	$fix = get_sub_field( 'fix' );
	$result = get_sub_field( 'result' );
	$src_set_before = ' srcset ="' . wp_get_attachment_image_srcset( $before_image['id'] ) . '" ';
	$src_set_after = ' srcset ="' . wp_get_attachment_image_srcset( $after_image['id'] ) . '" ';
	?>
<div class="case_study">
<h2 class="case-study-title"><?php echo $title; ?></h2>
  <div class="image-row">
	<img src="<?php echo $before_image['url']; ?>" alt="<?php echo $before_image['alt']; ?>" <?php echo $src_set_before; ?> />
	<?php echo $before_title; ?>
	<img src="<?php echo $after_image['url']; ?>" alt="<?php echo $after_image['alt']; ?>" <?php echo $src_set_after; ?> />
	<?php echo $after_title; ?>
</div><!--image-row-->
<div class="text-row">
	<div class="challenge">
		<h3>Challenge</h3>
		<?php echo $challenge; ?>
	</div>
	<div class="fix">
		<h3>Fix</h3>
		<?php echo $fix; ?>
	</div>
	<div class="result">
		<h3>Result</h3>
		<?php echo $result; ?>
	</div>
</div><!--text-row>

	<?php
	?>
</div><!-- case-study -->
	<?php } // while have_rows ?>
</div><!-- grid -->
<?php
} // if have_rows

?>
<?php } ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'wagw' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'wagw' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

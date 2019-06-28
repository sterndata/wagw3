<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package What A Great Website
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

	if ( have_rows( 'slides' ) ) {
		?>

<div id="grid" class="grid">

		<?php
		while ( have_rows( 'slides' ) ) {
			the_row();
			$slide_content = get_sub_field( 'slide_content' );
			$name          = get_sub_field( 'name' );
			$title         = get_sub_field( 'title' );
			$website       = get_sub_field( 'website' );
			$website_link  = get_sub_field( 'website_link' );
			?>
<div class="box kudos">
			<?php
				echo '<span class="kudos_content">' . $slide_content . '</span>';
				echo '<span class="kudos_name">' . $name;
			if ( $title ) {
					echo ', ' . $title;
			}
				echo '</span>';
				echo '<span class="kudos_website">';
			if ( $website_link && $website ) {
				echo '<a href="' . $website_link . '" target=_blank >';
			}
			if ( $website ) {
				echo $website;
			}
			if ( $website_link && $website ) {
				echo '</a>';
			}

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

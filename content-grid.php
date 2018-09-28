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

	if ( have_rows( 'slides' ) ) {
		$use_srcset = false;
		if ( function_exists( 'wp_get_attachment_image_srcset' ) ) { $use_srcset = true; }
		/// ?>

<div id="slider" class="flexslider slider-save-space">
<ul class="slides">
<?php
$carousel = ''; // in case there's a carousel
while ( have_rows( 'slides' ) ) { the_row();
	$image = get_sub_field( 'slide_image' );
	$slide_title = get_sub_field( 'slide_title' );
	$slide_caption = get_sub_field( 'slide_caption' );
	$slide_target = get_sub_field( 'slide_target' );
	if ( $slide_target ) {
		$href = '<a href="' . $slide_target . '"';
		if ( get_sub_field( 'new_window' ) ) {
			if ( ! wp_is_mobile() ) {
				$href .= ' target=_blank';
			}
		}
		$href .= '>';
	}
	if ( $use_srcset ) {
		$src_set = ' srcset ="' . wp_get_attachment_image_srcset( $image['id'] ) . '" ';
	} else {
		$src_set = '';
	}
?>
<li><?php if ( $slide_target ) { echo $href; } ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" <?php echo $src_set; ?> /><?php if ( $slide_target ) { echo '</a>'; } ?>
	<?php if ( get_field( 'show_image_captions' ) ) { ?>
		<div class="flex-caption">
	<?php if ( $slide_title ) { ?> <span class="caption_title"><?php echo $slide_title; }?>
	<?php if ( $slide_caption ) { ?></span><?php echo $slide_caption; } ?></div>
	<?php } // captions ?>
		</li>
	<?php
	/* if a carousel is set, build  the carousel here and display later */
	if ( get_field( 'slider_carousel' ) ) {
		$carousel .= '<li><img src="' . $image['url'] . '" ' . $src_set . "/></li>\n";
	}
	?>
	<?php } // while have rows ?>
</ul>
</div>
<?php if ( get_field( 'slider_carousel' ) ) { ?>
<div id="carousel" class="flexslider">
	<ul class="slides">
		<?php echo $carousel; ?>
	</ul>
</div>

<?php	} // carousel
	} // images

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

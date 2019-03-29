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

<div id="grid" class="grid">

<?php
	$image = get_field( 'grid_image' );
	$slide_caption = get_field( 'caption' );
	$slide_tag = get_ield( '_tag' );
	$slide_target = get_field( 'target' );
	if ( $slide_target ) {
		$href = '<a href="' . $slide_target . '" >';
	}
	if ( $use_srcset ) {
		$src_set = ' srcset ="' . wp_get_attachment_image_srcset( $image['id'] ) . '" ';
	} else {
		$src_set = '';
	}
?>
<div class="box"><?php if ( $slide_target ) { echo $href; } ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" <?php echo $src_set; ?> />
	<?php
	if ( $slide_caption ) {
			echo '<span class="slide_caption">'. $slide_caption . '</span><span class="slide_tag">' . $slide_tag . '</span>';
		}
	echo '</span>';
 ?>
<?php if ( $slide_target ) { echo '</a>'; } ?>

		</div><!-- box -->
	<?php } // while have rows ?>
</div><!-- grid -->
<?php
	} // images

?>
<?php } ?>
	<div class="entry-content">
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

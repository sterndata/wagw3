<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">

<header class="page-header">
			<h1 class="page-title">Website Portfolio</h1>
		</header><!-- .page-header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<p>We design websites across a wide range of industries. Nonprofits, small businesses, service providers, healthcare providers, retailers, manufacturers, musicians, galleries, restaurants, speakers, writers, lawyers and artists. Here’s a sampling of some of our work.</p>
				<div id="grid" class="grid">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				?>

				<?php
					$image         = get_field( 'grid_image' );
					$slide_caption = get_field( 'caption' );
					$slide_tag     = get_field( 'tag' );
					$slide_target  = get_the_permalink();
				if ( $slide_target ) {
					$href = '<a href="' . $slide_target . '" >';
				}
				$src_set = ' srcset ="' . wp_get_attachment_image_srcset( $image['id'] ) . '" ';
				?>

				<div class="box">
				<?php
				if ( $slide_target ) {
					echo $href; }
				?>
				<img src="<?php echo $image['url']; ?>" alt="
				<?php
				echo
				$image['alt'];
				?>
			 " <?php echo $src_set; ?> />
					<?php
						echo '<span class="slide_caption_wrapper">';
						echo '<span class="slide_caption">' . $slide_caption . '</span><span class="slide_tag">' . $slide_tag . '</span>';
					echo '</span>';
					?>
				<?php
				if ( $slide_target ) {
					echo '</a>'; }
				?>

						</div><!-- box -->

				<?php
			} // while have_posts

		} // if have_posts
		?>
				</div><!-- grid -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();

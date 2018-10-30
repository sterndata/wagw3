<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package What A Great Website
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="entry-header">
<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
</header><!-- .entry-header -->

<div class="pre-case-content">
			<?php the_content(); ?>
</div>

<?php
if ( have_rows( 'case' ) ) {
	while ( have_rows( 'case' ) ) {
		the_row();
		$case_title     = get_sub_field( 'title' );
		$before_image   = get_sub_field( 'before_image' );
		$after_image    = get_sub_field( 'after_image' );
		$before_title   = get_sub_field( 'before_title' );
		$after_title    = get_sub_field( 'after_title' );
		$challenge      = get_sub_field( 'challenge' );
		$fix            = get_sub_field( 'fix' );
		$result         = get_sub_field( 'result' );
		$src_set_before = ' srcset ="' . wp_get_attachment_image_srcset( $before_image['id'] ) . '" ';
		$src_set_after  = ' srcset ="' . wp_get_attachment_image_srcset( $after_image['id'] ) . '" ';
		?>

		<div class="case-study">
			<div class="sds-anchor" id="<?php echo sanitize_title_with_dashes( $case_title ); ?>"></div>
			<h2 class="title"><?php echo esc_html( $case_title ); ?></h2>
			<div class="image-row">
				<span class="title-before"><?php echo esc_html( $before_title ); ?></span>
									<span class="title-after"><?php echo esc_html( $after_title ); ?></span>
								</div>
			<div class="image-row">

				<div class="before">
					<img src="<?php echo $before_image['url']; ?>" alt="<?php echo $before_image['alt']; ?>" <?php echo $src_set_before; ?> />
				</div>

			<div class="after">

				<img src="<?php echo $after_image['url']; ?>" alt="<?php echo $after_image['alt']; ?>" <?php echo $src_set_after; ?> />
			</div>
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
		</div><!--text-row-->

	</div><!-- case-study -->
	<?php
	} // while have_rows
} // if have_rows

?>
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

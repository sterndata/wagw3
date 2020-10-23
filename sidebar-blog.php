<?php
/**
 * 
 * Sidebar for the blog template
 */
?>
<aside id="secondary" class="widget-area" role="complementary" aria-label="Blog Sidebar">
<?php $postid = get_the_ID();?>
	<div id="sidebar">
		<p>
		<?php //echo date("Y"); ?> <?php dynamic_sidebar( 'Sidebar_Marketing_Morsels' ); ?>
		</p>
	</div>	
</aside>
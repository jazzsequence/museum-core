<?php
/*
	This is the 404 error template
*/
get_header();
tha_content_before();
$ap_core_content = ap_core_get_which_content(); ?>
<div class="content col-md-9 <?php echo esc_attr( $ap_core_content ) ?>">
	<?php tha_content_top(); ?>
	<article class="post">

		<h2 class="the_title"><?php _e('Whoops! I couldn\'t find the page you were looking for.','museum-core'); ?> <span frown>:(</span></h2>

		<p><?php _e('Try a search or one of the links below.','museum-core'); ?></p>
		<p><?php get_search_form(); ?>

		<div class="spacer-10"></div>

		<nav class="col-md-6" id="month">
			<h2><?php _e('Archives by Month','museum-core'); ?></h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</nav>

		<nav class="col-md-6" id="categories">
			<h2><?php _e('Archives by Subject','museum-core'); ?></h2>
			<ul>
				 <?php wp_list_categories( 'title_li=' ); ?>
			</ul>
		</nav>

	</article>
	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
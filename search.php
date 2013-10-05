<?php
/*
	This is the search results template
*/
get_header();
tha_content_before();
include( AP_CORE_OPTIONS ); ?>
<div class="content col-md-9<?php echo $right; ?>">
	<?php tha_content_top(); ?>

	<?php get_template_part('parts/post','search'); ?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
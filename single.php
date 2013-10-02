<?php
/*
	This is the single post template
*/
get_header();
tha_content_before(); ?>
include( AP_CORE_OPTIONS ); ?>
<div class="content single col-md-9<?php echo $right; ?>">
	<?php tha_content_top(); ?>

	<?php get_template_part('parts/post','single'); ?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
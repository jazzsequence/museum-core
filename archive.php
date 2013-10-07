<?php
/*
	This is the archives template
*/
get_header();
tha_content_before();
$content = ap_core_get_which_content(); ?>
<div class="content col-md-9 col-lg-9 <?php echo $content; ?>">
	<?php tha_content_top(); ?>

	<?php get_template_part('parts/post','archive'); ?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
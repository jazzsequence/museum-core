<?php
/*
	Template Name: Page with no sidebar
*/
?>
<?php get_header(); ?>
<?php tha_content_before(); ?>
<div class="content col-md-12 col-lg-12">
	<?php tha_content_top(); ?>

	<?php get_template_part('parts/post', 'page'); ?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_footer(); ?>
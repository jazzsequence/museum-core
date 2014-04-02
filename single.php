<?php
/*
	This is the single post template
*/
get_header();
tha_content_before();
$ap_core_content = ap_core_get_which_content(); ?>
<div class="content single col-md-9 <?php echo esc_attr( $ap_core_content ) ?>">
	<?php tha_content_top(); ?>

	<?php get_template_part('parts/content','single'); ?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
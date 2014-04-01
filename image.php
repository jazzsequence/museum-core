<?php
/*
	This is the attachment image template
*/
get_header();
tha_content_before();
$ap_core_content = ap_core_get_which_content(); ?>
<div class="content image col-md-12 <?php echo $ap_core_content; ?>">
	<?php tha_content_top(); ?>

	<?php get_template_part('parts/content','image'); ?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_footer(); ?>
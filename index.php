<?php
/*
	This is the main index template
*/
get_header();
tha_content_before();
$ap_core_content = ap_core_get_which_content(); ?>
<div class="content col-md-9 <?php echo esc_attr( $ap_core_content ) ?>">
	<?php tha_content_top(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post();
		$ap_core_post_format = get_post_format();
		get_template_part('parts/post', $ap_core_post_format);
		endwhile; ?>

		<?php get_template_part( 'parts/part', 'navigation' ); ?>

	<?php endif; ?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
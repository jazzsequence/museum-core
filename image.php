<?php
/*
	This is the attachment image template
*/
global $content_width;
get_header();
tha_content_before();
// deal with image size stuff
$imagesize = getimagesize( wp_get_attachment_url( $post->ID, 'full' ) );

if ( $imagesize < 698 || $imagesize[0] > 698 && $imagesize[0] < 1140 ) {
	// if the image is small, or if it's bigger than $content_width but still smaller than the full width, use whatever the width of the image is
	$content_width = $imagesize[0];
} else {
	// if the image is bigger than the content width, set the width to 1140
	$content_width = 1140;
}
$ap_core_content = ap_core_get_which_content(); ?>
<div class="content image col-md-12 <?php echo esc_attr( $ap_core_content ) ?>">
	<?php tha_content_top(); ?>

	<?php get_template_part('parts/content','image'); ?>
	<?php the_content(); ?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_footer(); ?>
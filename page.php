<?php
/*
	This is the default page template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content col-md-9<?php echo $right; ?>">

	<?php get_template_part('parts/post', 'page'); ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
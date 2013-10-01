<?php
/*
	This is the search results template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content col-md-9<?php echo $right; ?>">

	<?php get_template_part('parts/post','search'); ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
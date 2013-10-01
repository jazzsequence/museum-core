<?php
/*
	This is the single post template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content single col-md-9<?php echo $right; ?>">

	<?php get_template_part('parts/post','single'); ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
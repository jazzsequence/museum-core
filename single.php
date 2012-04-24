<?php
/*
	This is the single post template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content single span-9<?php echo $right; ?>">

	<?php get_template_part('post','single'); ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
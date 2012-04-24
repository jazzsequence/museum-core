<?php
/*
	This is the search results template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content span-9<?php echo $right; ?>">

	<?php get_template_part('post','search'); ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
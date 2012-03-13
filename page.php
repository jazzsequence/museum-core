<?php
/*
	This is the default page template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content ninecol<?php echo $right; ?>">

	<?php get_template_part('post', 'page'); ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
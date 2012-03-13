<?php
/*
	This is the archives template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content ninecol<?php echo $right; ?>">

	<?php get_template_part('post','archive'); ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
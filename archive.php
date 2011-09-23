<?php 
/*
	This is the archives template
*/
?>
<?php get_header(); ?>
<div class="content">

	<?php get_template_part('post','archive'); ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
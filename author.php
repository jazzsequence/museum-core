<?php 
/*
	This is the author page template
*/
?>
<?php get_header(); ?>
<div class="content">

	<?php get_template_part('post', 'author'); ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
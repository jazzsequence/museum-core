<?php 
/*
	This is the main index template
*/
?>
<?php get_header(); ?>
<div class="content">

	<?php get_template_part('post', get_post_format()); ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
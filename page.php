<?php 
/*
	This is the default page template
*/
?>
<?php get_header(); ?>
<div class="content">

	<?php get_template_part('post', 'page'); ?>

</div>	
<?php get_sidebar(); ?>      
<div class="clear"></div>
<?php get_footer(); ?>
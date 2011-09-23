<?php 
/*
	This is the single post template
*/
?>
<?php get_header(); ?>
<div class="content single">

	<?php get_template_part('post','single'); ?>

</div>	
<?php get_sidebar(); ?>                  
<div class="clear"></div>
<?php get_footer(); ?>
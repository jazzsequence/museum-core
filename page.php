<?php 
/*
	This is the default page template
*/
?>
<?php get_header(); ?>
<div class="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
			<h2 class="the_title"><?php the_title(); ?></h2>
            <div class="clear"></div>
			<section class="entry">
					<?php the_content('Read more &raquo;'); ?>
			</section>
			<section class="postmeta">
				<p><?php edit_post_link('Edit this entry','','.'); ?></p>
			</section>
    	<div class="clear"></div>
		</article>
		
	<?php endwhile; endif; ?>
</div>	
<?php get_sidebar(); ?>      
<div class="clear"></div>
<?php get_footer(); ?>
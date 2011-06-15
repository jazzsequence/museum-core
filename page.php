<?php 
/*
	This is the default page template
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>      
<div class="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 				<div class="post" id="post-<?php the_ID(); ?>">				

				<h2 class="the_title"><?php the_title(); ?></h2>
                <div class="clear"></div>
				<div class="entry">
					<?php the_content('Read more &raquo;'); ?>
				</div>
    <div class="singlemeta">
    <p><?php edit_post_link('Edit this entry','','.'); ?></p></div>
    </div>
    	<div class="clear"></div>
	</div>

        <?php endwhile; endif; ?>
    
<div class="clear"></div>
<?php get_footer(); ?>
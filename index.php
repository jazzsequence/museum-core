<?php 
/*
	This is the main index template
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="content">
	
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
	<article>
		<div class="post" id="post-<?php the_ID(); ?>">				
			<div class="the_date"><h3><?php the_time('j F Y') ?></h3></div>
			<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <div class="clear"></div>
			<div class="entry">
				<?php the_content('Read more &raquo;'); ?>
			</div>
			<div class="postmetadata">
                Posted in <?php the_category(',&nbsp;'); ?> <?php the_tags('| Tags: ',', ',''); ?><br />
                <?php comments_popup_link('No Comments &#187;', 'One Comment &#187;', '% Comments &#187;'); ?>       
            </div>
		</div>
	</article>
    <div class="clear"></div>

	<?php endwhile; ?>

	<div class="navigation">
		<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
	</div>
	<?php endif; ?>

</div>
<div class="clear"></div>
<?php get_footer(); ?>
<?php 
/*
	This is the single post template
*/
?>
<?php get_header(); ?>
<div class="content single">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
       
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>				
                
		<section class="entry">
			<?php the_content('Read more &raquo;'); ?>
		</section>         
        <div class="clear"></div>
		<section class="postmetadata">
			Posted in <?php the_category(',&nbsp;'); ?> on <time datetime=<?php the_time('Y-m-d'); ?>><?php the_time('j F Y') ?></time><?php the_tags(', and tagged ',', ',''); ?><br />
			<?php comments_popup_link('No Comments &#187;', 'One Comment &#187;', '% Comments &#187;'); ?>       
			<p><?php edit_post_link('Edit this entry','','.'); ?></p>			
        </section>

    	<div class="clear"></div>
		<nav class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</nav>
        <div class="spacer-10"></div>        
        <div class="spacer-10"></div>                
    	<section id="comments">
			<?php comments_template(); ?>
        </section>
	</article>
    <div class="spacer-10"></div>        
</div>
		
        <?php endwhile; endif; ?>
<?php get_sidebar(); ?>                  
<div class="clear"></div>
<?php get_footer(); ?>
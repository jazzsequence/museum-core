<?php 
/*
	This is the single post template
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>      
<div class="content single">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
				<div class="post" id="post-<?php the_ID(); ?>">				

				<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <div class="clear"></div>				
                
				<div class="entry">
					<?php the_content('Read more &raquo;'); ?>
				</div>
                Posted in <?php the_category(',&nbsp;'); ?> on <?php the_time('j F Y') ?><?php the_tags(', and tagged ',', ',''); ?><br />
                <div class="clear"></div>
				<p class="postmetadata">
                <?php comments_popup_link('No Comments &#187;', 'One Comment &#187;', '% Comments &#187;'); ?>       
                </p>
    <p><?php edit_post_link('Edit this entry','','.'); ?></p>

    	<div class="clear"></div>
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
        <div class="spacer-10"></div>        
        <div class="spacer-10"></div>                
    	<div id="comments">
		<?php comments_template(); ?>
        </div>
				</div>
        <div class="spacer-10"></div>        
	</div>

		
        <?php endwhile; endif; ?>
            
<div class="clear"></div>
<?php get_footer(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
		<h3 class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time('j F Y') ?></time></h3>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
		<section class="entry">
			<?php the_content('Read more &raquo;'); ?>
			<?php wp_link_pages(); ?>			
		</section>
		<section class="postmetadata">
            Posted in <?php the_category(',&nbsp;'); ?> <?php the_tags('| Tags: ',', ',''); ?><br />
            <?php comments_popup_link('No Comments &#187;', 'One Comment &#187;', '% Comments &#187;'); ?>       
         </section>
	</article>
    <div class="clear"></div>
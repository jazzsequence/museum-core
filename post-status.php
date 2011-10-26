	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
		<section class="entry">
			<?php the_content('Read more &raquo;'); ?>
			<?php wp_link_pages(); ?>			
		</section>
		<section class="postmetadata">
			<time datetime=<?php the_time('Y-m-d'); ?>><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></time>
         </section>
	</article>
    <div class="clear"></div>
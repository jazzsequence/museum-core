	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
		<section class="entry">
			<?php the_content('Read more &raquo;'); ?>
			<?php wp_link_pages(); ?>			
		</section>
	</article>
    <div class="clear"></div>
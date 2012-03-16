	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<time datetime=<?php the_time('Y-m-d'); ?>></time>
			<h2 class="the_title"><?php the_title(); ?></h2>
            <div class="clear"></div>
			<section class="entry">
				<?php the_content('Read more &raquo;'); ?>
				<div class="clear"></div>
				<?php wp_link_pages(); ?>
			</section>
			<section class="postmeta">
				<p><?php edit_post_link('Edit this entry','','.'); ?></p>
			</section>
    	<div class="clear"></div>
		</article>

	<?php endwhile; endif; ?>
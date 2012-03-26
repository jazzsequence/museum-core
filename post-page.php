	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<time datetime=<?php the_time('Y-m-d'); ?>></time>
			<h2 class="the_title"><?php the_title(); ?></h2>
            <div class="clear"></div>
			<section class="entry">
				<?php the_content(__('Read more &raquo;','museum-core')); ?>
				<div class="clear"></div>
				<?php wp_link_pages(); ?>
			</section>
			<section class="postmetadata">
				<p><?php edit_post_link(__('Edit this entry','museum-core'),'','.'); ?></p>
				<?php comments_popup_link(__('No Comments &#187;','museum-core'), __('One Comment &#187;','museum-core'), __('% Comments &#187;','museum-core')); ?>
			</section>
    	<div class="clear"></div>
		</article>

	<?php endwhile; endif; ?>
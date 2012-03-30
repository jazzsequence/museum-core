	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<section class="entry">
			<?php the_content(__('Read more &raquo;','museum-core')); ?>
			<div class="clear"></div>
			<?php wp_link_pages(); ?>
		</section>
		<section class="postmetadata">
			<time class="human-time-diff" datetime=<?php the_time('Y-m-d'); ?>><?php echo sprintf(__('%1$s ago','museum-core'), human_time_diff( get_the_time('U'), current_time('timestamp') )); ?></time>
         </section>
	</article>
    <div class="clear"></div>
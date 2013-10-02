<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<time datetime=<?php the_time('Y-m-d'); ?>></time>
		<h1 class="the_title"><?php the_title(); ?></h1>

		<?php tha_entry_before(); ?>
		<section class="entry">
			<?php tha_entry_top(); ?>

			<?php the_content(__('Read more &raquo;','museum-core')); ?>
			<?php wp_link_pages(); ?>

			<?php tha_entry_bottom(); ?>
		</section>
		<?php tha_entry_after(); ?>

		<section class="postmetadata">
			<p><?php edit_post_link(__('Edit this entry','museum-core'),'','.'); ?></p>
		</section>

		<?php tha_comments_before(); ?>
		<section id="comments">
			<?php comments_template(); ?>
        </section>
        <?php tha_comments_after(); ?>

	</article>

<?php endwhile; endif; ?>
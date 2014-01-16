<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<h1 class="the_title"><?php the_title(); ?></h1>

		<?php tha_entry_before(); ?>
		<section class="entry">
			<?php tha_entry_top(); ?>

			<?php the_content(__('Read more &raquo;','museum-core')); ?>
			<?php get_template_part( 'parts/part', 'link-pages' ); ?>

			<?php tha_entry_bottom(); ?>
		</section>
		<?php tha_entry_after(); ?>

		<?php get_template_part( 'parts/part', 'postmetadata' ); ?>

		<?php get_template_part( 'parts/part', 'navigation' ); ?>

        <?php tha_comments_before(); ?>
    	<section id="comments">
			<?php comments_template(); ?>
        </section>
        <?php tha_comments_after(); ?>

	</article>

<?php endwhile; endif; ?>
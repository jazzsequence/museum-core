<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php $is_title_set = get_the_title();
		if ( !empty( $is_title_set ) ) { ?>
			<h1 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %s','museum-core'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h1>
		<?php } ?>

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

        <div class="spacer-10"></div>
        <div class="spacer-10"></div>

        <?php tha_comments_before(); ?>
    	<section id="comments">
			<?php comments_template(); ?>
        </section>
        <?php tha_comments_after(); ?>

	</article>

<?php endwhile; endif; ?>
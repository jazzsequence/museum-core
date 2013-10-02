<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php $is_title_set = get_the_title();
		if ( !empty( $is_title_set ) ) { ?>
		<h1 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %s','museum-core'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h1>
		<?php } ?>

		<section class="entry">
			<?php the_content(__('Read more &raquo;','museum-core')); ?>
			<div class="clear"></div>
			<?php wp_link_pages(); ?>
		</section>

		<?php get_template_part( 'parts/part', 'postmetadata' ); ?>


		<?php get_template_part( 'parts/part', 'navigation' ); ?>

        <div class="spacer-10"></div>
        <div class="spacer-10"></div>
    	<section id="comments">
			<?php comments_template(); ?>
        </section>
	</article>

<?php endwhile; endif; ?>
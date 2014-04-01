<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php get_template_part( 'parts/part', 'title' ); ?>

		<?php tha_entry_before(); ?>
		<section class="entry media">
			<?php tha_entry_top(); ?>

			<?php
			if ( ap_core_blog_excerpts() == false ) {
				the_content(__('Read more &raquo;','museum-core'));
			} else {
				if(has_post_thumbnail()) { ?>
					<div class="pull-left"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-thumbnail media-object' ) ); ?></a></div>
				<?php } ?>
				<div class="media-body">
					<?php the_excerpt(); ?>
				</div>
			<?php } ?>

			<div class="icon icon-user pull-left" title="<?php esc_attr_e( 'Author', 'museum-core' ); ?>"></div><?php get_template_part( 'parts/part', 'postmetadata' ); ?>

			<?php tha_entry_bottom(); ?>
		</section>
	</article>
	<?php tha_entry_after(); ?>

	<?php
	endwhile;
	get_template_part( 'parts/part', 'navigation' );
endif; ?>
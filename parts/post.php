<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php get_template_part( 'parts/part', 'title' ); ?>

	<?php tha_entry_before(); ?>
	<section class="entry media">
		<?php tha_entry_top(); ?>

		<?php
		if ( function_exists( 'ap_core_blog_excerpts' ) && ap_core_blog_excerpts() == false ) {
			the_content(__('Read more &raquo;','museum-core'));
		} else {
			if(has_post_thumbnail()) { ?>
				<div class="pull-left"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-thumbnail media-object' ) ); ?></a></div>
			<?php } ?>
			<div class="media-body">
				<?php the_excerpt(); ?>
			</div>
		<?php } ?>
		<?php get_template_part( 'parts/part', 'link-pages' ); ?>

		<?php tha_entry_bottom(); ?>
	</section>
	<?php tha_entry_after(); ?>

	<div class="icon icon-post pull-left"></div><?php get_template_part( 'parts/part', 'postmetadata' ); ?>

</article>
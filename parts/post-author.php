<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php get_template_part( 'parts/part', 'title' ); ?>

		<section class="entry media">
			<?php include( AP_CORE_OPTIONS );
			if ( $show_excerpt == false ) {
				the_content(__('Read more &raquo;','museum-core'));
			} else {
				if(has_post_thumbnail()) { ?>
					<div class="pull-left"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-thumbnail media-object' ) ); ?></a></div>
				<?php } ?>
				<div class="media-body">
					<?php the_excerpt(); ?>
				</div>
			<?php } ?>

			<?php get_template_part( 'parts/part', 'postmetadata' ); ?>

	</article>

	<?php
	endwhile;
	get_template_part( 'parts/part', 'navigation' );
	endif; ?>
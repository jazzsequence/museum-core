<?php if ( have_posts() ) : ?>

	<?php /* If this is a category archive */
	if ( is_category() ) {
		$category = single_cat_title( '', false ); ?>
	    <h2 class="the_title"><?php echo esc_attr( sprintf( __( 'Posts filed under %s','museum-core'), $category ) ); ?></h2>

	<?php /* If this is a tag archive */
	} elseif( is_tag() ) {
		$tags = get_the_tags();
		$tag_name = array();
		foreach ( $tags as $tag ) {
			$tag_name = $tag->name; // only one should get pulled
		} ?>
		<h2 class="the_title"><?php echo esc_attr( sprintf( __('Posts filed under %s','museum-core'), $tag_name ) ); ?></h2>

	<?php /* If this is a daily archive */
	} elseif ( is_day() ) { ?>
		<h2 class="the_title"><?php echo esc_attr( sprintf( __('Archive for %1$s','museum-core'), get_the_time('j F Y') ) ); ?></h2>

	<?php /* If this is a monthly archive */
	} elseif ( is_month() ) { ?>
		<h2 class="the_title"><?php echo esc_attr( sprintf( __('Archive for %1$s','museum-core'), get_the_time('F Y') ) ); ?></h2>

	<?php /* If this is a yearly archive */
	} elseif ( is_year() ) { ?>
		<h2 class="the_title"><?php echo esc_attr( sprintf( __('Archive for %1$s','museum-core'), get_the_time('Y') ) ); ?></h2>

	<?php /* If this is an author archive */
	} elseif ( is_author() ) { ?>
		<h2 class="the_title"><?php _e('Author Archive','museum-core'); ?></h2>

	<?php /* All other archives */
	} else { ?>
		<h2 class="the_title"><?php _e('Blog Archives','museum-core'); ?></h2>
	<?php } ?>

	<?php while ( have_posts() ) : the_post();

		$ap_core_post_format = get_post_format();
		if ( $ap_core_post_format ) {
			get_template_part('parts/post', $ap_core_post_format);
		} else { ?>

		    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<?php get_template_part( 'parts/part', 'title' ); ?>

				<?php tha_entry_before(); ?>
				<section class="entry media">
					<?php tha_entry_top(); ?>

					<?php
					if ( ap_core_archive_excerpts() == false ) {
						the_content(__('Read more &raquo;','museum-core'));
					} else {
						if ( has_post_thumbnail() ) { ?>

							<div class="pull-left"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-thumbnail media-object' ) ); ?></a></div>

						<?php } ?>

						<div class="media-body">
							<?php the_excerpt(); ?>
						</div>

					<?php } ?>

					<?php tha_entry_bottom(); ?>
				</section>
				<?php tha_entry_after(); ?>

				<div class="icon icon-archive pull-left" title="<?php esc_attr_e( 'Archive', 'museum-core' ); ?>"></div><?php get_template_part( 'parts/part', 'postmetadata' ); ?>

		    </article>

		    <div class="spacer-10"></div>

		<?php }
	endwhile;
	get_template_part( 'parts/part', 'navigation' );
	endif; ?>
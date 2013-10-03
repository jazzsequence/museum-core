<?php if ( have_posts() ) : ?>

	<?php /* If this is a category archive */
	if ( is_category() ) { ?>
	    <h1 class="the_title"><?php single_cat_title( __('Posts filed under ','museum-core') ); ?></h1>

	<?php /* If this is a tag archive */
	} elseif( is_tag() ) { ?>
		<h1 class="the_title"><?php single_tag_title( __('Posts filed under ','museum-core') ); ?></h1>

	<?php /* If this is a daily archive */
	} elseif ( is_day() ) { ?>
		<h1 class="the_title"><?php echo sprintf( __('Archive for %1$s','museum-core'), get_the_time('j F Y') ); ?></h1>

	<?php /* If this is a monthly archive */
	} elseif ( is_month() ) { ?>
		<h1 class="the_title"><?php echo sprintf( __('Archive for %1$s','museum-core'), get_the_time('F Y') ); ?></h1>

	<?php /* If this is a yearly archive */
	} elseif ( is_year() ) { ?>
		<h1 class="the_title"><?php echo sprintf( __('Archive for %1$s','museum-core'), get_the_time('Y') ); ?></h1>

	<?php /* If this is an author archive */
	} elseif ( is_author() ) { ?>
		<h1 class="the_title"><?php _e('Author Archive','museum-core'); ?></h1>

	<?php /* All other archives */
	} else { ?>
		<h1 class="the_title"><?php _e('Blog Archives','museum-core'); ?></h1>
	<?php } ?>

	<?php while ( have_posts() ) : the_post(); ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php get_template_part( 'parts/part', 'title' ); ?>

		<?php tha_entry_before(); ?>
		<section class="entry media">
			<?php tha_entry_top(); ?>

			<?php include( AP_CORE_OPTIONS );
			$format = get_post_format();
			$no_excerpt_formats = array( 'aside', 'chat', 'link', 'quote', 'status', 'video', 'audio' );
			if ( $archive_excerpt == false || in_array( $format, $no_excerpt_formats ) ) {
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

		<div class="icon icon-archive pull-left" title="<?php _e( 'Archive', 'museum-core' ); ?>"></div><?php get_template_part( 'parts/part', 'postmetadata' ); ?>

    </article>

    <div class="spacer-10"></div>

	<?php
	endwhile;
	get_template_part( 'parts/part', 'navigation' );
	endif; ?>
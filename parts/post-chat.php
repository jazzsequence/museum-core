	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<time datetime=<?php the_time('Y-m-d'); ?>></time>
		<?php $is_title_set = get_the_title();
		if ( empty( $is_title_set ) ) { ?>
			<h1 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %s','museum-core'), the_title_attribute( 'echo=0' ) ); ?>"><?php _e('(no title)', 'museum-core'); ?></a></h1>
		<?php } ?>
		<h1 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %s','museum-core'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h1>
        <div class="clear"></div>
        <div class="span-1"></div>
		<section class="entry span-6 alt">
			<?php the_content(__('Read more &raquo;','museum-core')); ?>
			<div class="clear"></div>
			<?php wp_link_pages(); ?>
		</section>
		<div class="span-1 last"></div>
		<div class="clear"></div>
		<section class="postmetadata">
			<span class="human-time-diff alt"><?php echo sprintf(__('%1$s ago','museum-core'), human_time_diff( get_the_time('U'), current_time('timestamp') )); ?></span><br />
			<?php
				$options = get_option( 'ap_core_theme_options' );
				$categories = get_the_category_list( __(', ', 'museum-core') );
				$tags = get_the_tag_list( __('and tagged ', 'museum-core'),', ' );
				$author_name = get_the_author_meta('display_name');
				$author_ID = get_the_author_meta('ID');
				$author_link = '<a href="' . get_author_posts_url($author_ID) . '">' . $author_name . '</a>';
				$author = '- posted by ' . $author_link;
				if ( $options['post-author'] ) {
					$postmeta = __('Filed under %1$s %2$s %3$s', 'museum-core');
				} else {
					$postmeta = __('Filed under %1$s %2$s', 'museum-core');
				}
				printf( $postmeta, $categories, $tags, $author );
			?>
			<br />
            <?php comments_popup_link(__('No Comments &#187;','museum-core'), __('One Comment &#187;','museum-core'), __('% Comments &#187;','museum-core')); ?>
         </section>
	</article>
    <div class="clear"></div>
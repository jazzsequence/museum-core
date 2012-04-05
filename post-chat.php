	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<time datetime=<?php the_time('Y-m-d'); ?>></time>
		<?php $is_title_set = get_the_title();
		if ( empty( $is_title_set ) ) { ?>
			<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %1$s','museum-core'), the_title_attribute() ); ?>"><?php _e('(no title)', 'museum-core'); ?></a></h2>
		<?php } ?>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %1$s','museum-core'), the_title_attribute() ); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
        <div class="onecol"></div>
		<section class="entry sixcol alt">
			<?php the_content(__('Read more &raquo;','museum-core')); ?>
			<div class="clear"></div>
			<?php wp_link_pages(); ?>
		</section>
		<div class="onecol last"></div>
		<div class="clear"></div>
		<section class="postmetadata">
			<span class="human-time-diff alt"><?php echo sprintf(__('%1$s ago','museum-core'), human_time_diff( get_the_time('U'), current_time('timestamp') )); ?></span><br />
			<?php
				$categories = get_the_category_list( __(', ', 'museum-core') );
				$tags = get_the_tag_list( __('and tagged ', 'museum-core'),', ' );
				$postmeta = __('Filed under %1$s %2$s', 'museum-core');
				printf( $postmeta, $categories, $tags );
			?>
			<br />
            <?php comments_popup_link(__('No Comments &#187;','museum-core'), __('One Comment &#187;','museum-core'), __('% Comments &#187;','museum-core')); ?>
         </section>
	</article>
    <div class="clear"></div>
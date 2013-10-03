<section class="postmetadata clearfix">
	<?php
		$options = get_option( 'ap_core_theme_options' );

		if ( 'gallery' == get_post_format() || 'image' == get_post_format() ) { ?>
			<span class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time(get_option('date_format')) ?></time></span><br />
			<?php if ( 'gallery' == get_post_format() ) { ?>
				<div class="icon icon-picture pull-left" title="<?php _e( 'Gallery', 'museum-core' ); ?>"></div>
			<?php } else { ?>
				<div class="icon icon-camera pull-left" title="<?php _e( 'Image', 'museum-core' ); ?>"></div>
			<?php }
		}
		$time = '<time datetime=' . get_the_time('Y-m-d') . '>' . get_the_time('j F Y') . '</time>';
    	$categories = get_the_category_list( __(', ', 'museum-core') );
		$tags = get_the_tag_list( __('and tagged ', 'museum-core'),', ' );
		$author_name = get_the_author_meta('display_name');
		$author_ID = get_the_author_meta('ID');
		$author_link = '<a href="' . get_author_posts_url($author_ID) . '">' . $author_name . '</a>';
		$author = sprintf( __( 'by %s', 'museum-core' ), $author_link );
		if ( $options['post-author'] ) {
			if ( is_singular() ) {
				$postmeta = __('Posted in %1$s on %2$s %3$s %4$s', 'museum-core');
			} elseif ( 'chat' == get_post_format() ) {
				$postmeta = _x( 'Filed under %1$s %2$s %3$s', '1: comma-separated category list, 2: "and tagged" tag list, 3: by (author)', 'museum-core' );
			} elseif ( 'gallery' == get_post_format() || 'image' == get_post_format() ) {
				$postmeta = _x( 'Displayed in %1$s %2$s %3$s', '1: comma-separated category list, 2: "and tagged" tag list, 3: by (author)', 'museum-core' );
			} else {
				$postmeta = _x('Posted in %1$s %2$s %3$s', '1: comma-separated category list, 2: "and tagged" tag list, 3: by (author)', 'museum-core');
			}
		} else {
			if ( is_singular() ) {
				$postmeta = __('Posted in %1$s on %2$s %3$s', 'museum-core');
			} elseif ( 'chat' == get_post_format() ) {
				$postmeta = _x( 'Filed under %1$s %2$s', '1: comma-separated category list, 2: "and tagged" tag list', 'museum-core' );
			} elseif ( 'gallery' == get_post_format() || 'image' == get_post_format() ) {
				$postmeta = _x( 'Displayed in %1$s %2$s', '1: comma-separated category list, 2: "and tagged" tag list', 'museum-core' );
			} else {
				$postmeta = _x('Posted in %1$s %2$s', '1: comma-separated category list, 2: "and tagged" tag list', 'museum-core');
			}
		}
		if ( is_singular() ) {
			printf( $postmeta, $categories, $time, $tags, $author );
		} else {
			printf( $postmeta, $categories, $tags, $author );
		}
	?>
	<br />
    <?php comments_popup_link(__('No Comments &#187;','museum-core'), __('One Comment &#187;','museum-core'), __('% Comments &#187;','museum-core')); ?>
    <?php if ( is_singular() ) { ?>
    	<p><?php edit_post_link(__('Edit this entry','museum-core'),'','.'); ?></p>
	<?php } ?>
</section>
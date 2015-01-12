<section class="postmetadata clearfix">
	<?php
		if ( !is_page() && !is_attachment() ) {
			$options = get_option( 'ap_core_theme_options' );

			$time = '<time datetime=' . get_the_time('Y-m-d') . '>' . get_the_time('j F Y') . '</time>';
	    	$categories = get_the_category_list( __(', ', 'museum-core') );
			$tags = get_the_tag_list( __('and tagged ', 'museum-core'),', ' );
			$author_name = get_the_author_meta('display_name');
			$author_ID = get_the_author_meta('ID');
			$author_link = '<a href="' . get_author_posts_url($author_ID) . '">' . $author_name . '</a>';
			$author = sprintf( __( 'by %s', 'museum-core' ), $author_link );
			if ( isset( $options['post-author'] ) && $options['post-author'] ) {
				if ( is_singular() ) {
					$postmeta = __('Posted in %1$s on %2$s %3$s %4$s', 'museum-core');
				} elseif ( 'chat' == get_post_format() ) {
					$postmeta = __( 'Filed under %1$s %2$s %3$s', 'museum-core' );
				} elseif ( 'gallery' == get_post_format() || 'image' == get_post_format() ) {
					$postmeta = __( 'Displayed in %1$s %2$s %3$s', 'museum-core' );
				} else {
					$postmeta = __('Posted in %1$s %2$s %3$s', 'museum-core');
				}
			} else {
				if ( is_singular() ) {
					$postmeta = __('Posted in %1$s on %2$s %3$s', 'museum-core');
				} elseif ( 'chat' == get_post_format() ) {
					$postmeta = __( 'Filed under %1$s %2$s', 'museum-core' );
				} elseif ( 'gallery' == get_post_format() || 'image' == get_post_format() ) {
					$postmeta = __( 'Displayed in %1$s %2$s', 'museum-core' );
				} else {
					$postmeta = __('Posted in %1$s %2$s', 'museum-core');
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
    <?php } elseif ( is_attachment() ) {
    	$imagemeta = wp_get_attachment_metadata();
    	$time = '<time datetime=' . get_the_time('Y-m-d') . '>' . get_the_time('j F Y') . '</time>';
    	$image_url = wp_get_attachment_url();
    	$parent_title = get_the_title( $post->post_parent );
    	$parent_link = '<a href="' . get_permalink( $post->post_parent ) . '" title="' . sprintf( __( 'Permalink to %s', 'museum-core' ), esc_attr( $parent_title ) ) . '">' . esc_attr( $parent_title ) . '</a>';
    	printf( __( 'Attached to %1$s which was posted on %2$s.' , 'museum-core' ), $parent_link, $time );
    	echo '<br />';
    	echo '<a href="' . esc_url_raw( $image_url ) . '" title="' . __( 'Link to full-size image.', 'museum-core' ) . '">';
    	_e( 'View full image.', 'museum-core' );
    	echo '</a>';
    }
    if ( is_singular() || is_page() ) { ?>
    	<p><?php edit_post_link(__('Edit this entry','museum-core'),'','.'); ?></p>
	<?php } ?>
</section>
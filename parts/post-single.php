<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php $is_title_set = get_the_title();
		if ( !empty( $is_title_set ) ) { ?>
		<h1 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %1$s','museum-core'), the_title_attribute() ); ?>"><?php the_title(); ?></a></h1>
		<?php } ?>
        <div class="clear"></div>

		<section class="entry">
			<?php the_content(__('Read more &raquo;','museum-core')); ?>
			<div class="clear"></div>
			<?php wp_link_pages(); ?>
		</section>

		<section class="postmetadata">
			<?php
				$options = get_option( 'ap_core_theme_options' );
				$time = '<time datetime=' . get_the_time('Y-m-d') . '>' . get_the_time('j F Y') . '</time>';
				$categories = get_the_category_list( __(', ', 'museum-core') );
				$tags = get_the_tag_list( __('and tagged ', 'museum-core'),', ' );
				$author_name = get_the_author_meta('display_name');
				$author_ID = get_the_author_meta('ID');
				$author_link = '<a href="' . get_author_posts_url($author_ID) . '">' . $author_name . '</a>';
				$author = 'by ' . $author_link;
				if ( $options['post-author'] ) {
					$postmeta = __('Posted in %1$s on %2$s %3$s %4$s', 'museum-core');
				} else {
					$postmeta = __('Posted in %1$s on %2$s %3$s', 'museum-core');
				}
				printf( $postmeta, $categories, $time, $tags, $author );
			?>
			<br />
			<?php comments_popup_link(__('No Comments &#187;','museum-core'), __('One Comment &#187;','museum-core'), __('% Comments &#187;','museum-core')); ?>
			<p><?php edit_post_link(__('Edit this entry','museum-core'),'','.'); ?></p>
        </section>

    	<div class="clear"></div>
		<nav class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</nav>
        <div class="spacer-10"></div>
        <div class="spacer-10"></div>
    	<section id="comments">
			<?php comments_template(); ?>
        </section>
	</article>

<?php endwhile; endif; ?>
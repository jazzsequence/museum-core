<?php
    global $query_string;
    $query_args = explode("&", $query_string);
    $search_query = array();

    foreach($query_args as $key => $string) {
        $query_split = explode("=", $string);
        $search_query[$query_split[0]] = $query_split[1];
    } // foreach

    $search = new WP_Query($search_query);

    global $wp_query;
    $total_results = $wp_query->found_posts;
?>
	<h2 class="searchresults the_title"><?php $results = sprintf( __( 'We found %d results for ', 'museum-core' ), $total_results ); echo $results ?>&ldquo;<?php echo get_search_query(); ?>&rdquo;</h2>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h3 class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time(get_option('date_format')) ?></time></h3>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','museum-core'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
		<section class="entry">
			<?php if(has_post_thumbnail()) { ?>
				<div class="alignleft twocol"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php } ?>
			<?php the_excerpt(); ?>
		</section>
		<section class="postmetadata">
            <?php _e('Posted in ','museum-core'); the_category(', '); ?> <?php the_tags(__('and tagged ','museum-core'),', ',''); ?><br />
            <?php comments_popup_link(__('No Comments &#187;','museum-core'), __('One Comment &#187;','museum-core'), __('% Comments &#187;','museum-core')); ?>
        </section>
	</article>
    <div class="clear"></div>

	<?php endwhile; ?>

	<nav class="navigation">
		<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','museum-core')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','museum-core')) ?></div>
		<?php } ?>
	</nav>
	<?php endif; ?>

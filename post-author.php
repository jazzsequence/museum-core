<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h3 class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time(get_option('date_format')) ?></time></h3>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','ap_core'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
		<section class="entry">
			<?php include( AP_CORE_OPTIONS );
			if ( $show_excerpt == 'false' ) {
				the_content(__('Read more &raquo;','ap_core'));
			} else {
				if(has_post_thumbnail()) { ?>
					<div class="alignleft twocol"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php }
				the_excerpt();
			}
			?>
		<section class="postmetadata">
            <?php _e('Posted in ','ap_core'); the_category(', '); ?> <?php the_tags(__('and tagged ','ap_core'),', ',''); ?><br />
            <?php comments_popup_link(__('No Comments &#187;','ap_core'), __('One Comment &#187;','ap_core'), __('% Comments &#187;','ap_core')); ?>
         </section>
	</article>
    <div class="clear"></div>

	<?php endwhile; ?>

	<nav class="navigation">
		<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','ap_core')); ?></div>
		<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','ap_core')); ?></div>
		<?php } ?>
	</nav>
	<?php endif; ?>
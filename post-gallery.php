	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','ap_core'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
		<section class="entry">
			<?php the_content(__('Read more &raquo;','ap_core')); ?>
			<div class="clear"></div>
			<?php wp_link_pages(); ?>
		</section>
		<section class="postmetadata">
			<span class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time(get_option('date_format')) ?></time></span><br />
            <?php _e('Displayed in ','ap_core'); the_category(', '); ?> <?php the_tags(__('and tagged ','ap_core'),', ',''); ?><br />
            <?php comments_popup_link(__('No Comments &#187;','ap_core'), __('One Comment &#187;','ap_core'), __('% Comments &#187;','ap_core')); ?>
         </section>
	</article>
    <div class="clear"></div>
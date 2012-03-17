	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<time datetime=<?php the_time('Y-m-d'); ?>></time>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to','ap_core'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
        <div class="onecol"></div>
		<section class="entry sixcol alt">
			<?php the_content(__('Read more &raquo;','ap_core')); ?>
			<div class="clear"></div>
			<?php wp_link_pages(); ?>
		</section>
		<div class="onecol last"></div>
		<div class="clear"></div>
		<section class="postmetadata">
			<span class="human-time-diff alt"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago','ap_core'); ?></span><br />
            <?php _e('Filed under ','ap_core'); the_category(',&nbsp;'); the_tags(__(' and tagged ','ap_core'),', ',''); ?><br />
            <?php comments_popup_link(__('No Comments &#187;','ap_core'), __('One Comment &#187;','ap_core'), __('% Comments &#187;','ap_core')); ?>
         </section>
	</article>
    <div class="clear"></div>
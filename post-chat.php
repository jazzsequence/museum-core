	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<time datetime=<?php the_time('Y-m-d'); ?>></time>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
        <div class="onecol"></div>
		<section class="entry sixcol alt">
			<?php the_content('Read more &raquo;'); ?>
			<div class="clear"></div>
			<?php wp_link_pages(); ?>
		</section>
		<div class="onecol last"></div>
		<div class="clear"></div>
		<section class="postmetadata">
			<span class="human-time-diff alt"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></span><br />
            Filed under <?php the_category(',&nbsp;'); ?> <?php the_tags('and tagged ',', ',''); ?><br />
            <?php comments_popup_link('No Comments &#187;', 'One Comment &#187;', '% Comments &#187;'); ?>
         </section>
	</article>
    <div class="clear"></div>
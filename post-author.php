<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php /*
	This theme supports post formats.  In the future, I'll probably need to add some kind of conditional that fetches the post format of the current post and outputs a different HTML5 tag appropriate to that post format (e.g. <audio>, <video>, <aside>, etc).  For now, we're just going to spit out <article>
*/ ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
		<h3 class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time(get_option('date_format')) ?></time></h3>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
		<section class="entry">
			<?php the_content('Read more &raquo;'); ?>			
		</section>
		<section class="postmetadata">
            Posted in <?php the_category(',&nbsp;'); ?> <?php the_tags('| Tags: ',', ',''); ?><br />
            <?php comments_popup_link('No Comments &#187;', 'One Comment &#187;', '% Comments &#187;'); ?>       
         </section>
	</article>
    <div class="clear"></div>

	<?php endwhile; ?>

	<nav class="navigation">
		<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		<?php } ?>
	</nav>
	<?php endif; ?>
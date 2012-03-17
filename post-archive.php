	<?php if (have_posts()) :
		$post = $posts[0]; // Hack. Set $post so that the_date() works.
		/* If this is a category archive */ if (is_category()) { ?>
		    <h2 class="the_title"><?php _e('Posts filed under','ap_core'); ?> <?php single_cat_title(); ?></h2>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2 class="the_title"><?php _e('Posts filed under','ap_core'); ?> <?php single_tag_title(); ?></h2>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2 class="the_title"><?php _e('Archive for','ap_core'); ?> <?php the_time('j F Y'); ?></h2>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2 class="the_title"><?php _e('Archive for','ap_core'); ?> <?php the_time('F Y'); ?></h2>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2 class="the_title"><?php _e('Archive for','ap_core'); ?> <?php the_time('Y'); ?></h2>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2 class="the_title"><?php _e('Author Archive','ap_core'); ?></h2>
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2 class="the_title"><?php _e('Blog Archives','ap_core'); ?></h2>
		<?php } ?>
	<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    	<h3 class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time(get_option('date_format')) ?></time></h3>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to ','ap_core'); the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<section class="entry">
			<?php if(has_post_thumbnail()) { ?>
				<div class="alignleft twocol"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php } ?>
			<?php the_excerpt(); ?>
		</section>
		<section class="postmetadata">
            <?php _e('Posted in','ap_core'); ?> <?php the_category(', '); ?> <?php the_tags(__('and tagged ','ap_core'),', ',''); ?><br />
            <?php comments_popup_link(__('No Comments &#187;','ap_core'), __('One Comment &#187;','ap_core'), __('% Comments &#187;','ap_core')); ?>
        </section>
    </article>
    <div class="spacer-10"></div>
	<?php endwhile; ?>

	<nav class="navigation clearfix">
		<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','ap_core')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','ap_core')) ?></div>
		<?php } ?>
	</nav>
	<?php endif; ?>
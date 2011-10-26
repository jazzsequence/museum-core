	<?php if (have_posts()) : 
		$post = $posts[0]; // Hack. Set $post so that the_date() works. 
		/* If this is a category archive */ if (is_category()) { ?>
		    <h2 class="the_title">Posts filed under <?php single_cat_title(); ?></h2>
			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			<h2 class="the_title">Posts filed under <?php single_tag_title(); ?></h2>
			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			<h2 class="the_title">Archive for <?php the_time('j F Y'); ?></h2>
			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			<h2 class="the_title">Archive for <?php the_time('F Y'); ?></h2>
			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			<h2 class="the_title">Archive for <?php the_time('Y'); ?></h2>
			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
			<h2 class="the_title">Author Archive</h2>                                  
			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<h2 class="the_title">Blog Archives</h2>                                  
		<?php } ?>
	<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<span class="postmeta">Posted on <time datetime=<?php the_time('Y-m-d'); ?>><?php the_time(get_option('date_format')) ?></time></span>
		<div class="alignleft"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a></div>
		<?php the_excerpt(); ?>
    </article>
    <div class="spacer-10"></div>
	<?php endwhile; ?>

	<nav class="navigation clearfix">
		<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		<?php } ?>
	</nav>
				
	<?php endif; ?>
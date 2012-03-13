<?php
/*
	This is the main index template
*/
get_header();
include( get_template_directory() . '/inc/load-options.php' ); ?>
<div class="content ninecol<?php echo $right; ?>">

	<?php if (have_posts()) : while (have_posts()) : the_post();
		$post_format = get_post_format();
		get_template_part('post',$post_format);
		endwhile; ?>
	<nav class="navigation">
		<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		<?php } ?>
	</nav>
	<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
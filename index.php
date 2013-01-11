<?php
/*
	This is the main index template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content span-9<?php echo $right; ?>">

	<?php if (have_posts()) : while (have_posts()) : the_post();
		$post_format = get_post_format();
		get_template_part('parts/post', $post_format);
		endwhile; ?>
	<nav class="navigation">
		<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','museum-core')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','museum-core')) ?></div>
		<?php } ?>
	</nav>
	<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
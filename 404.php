<?php
/*
	This is the 404 error template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content ninecol<?php echo $right; ?>">
	<article class="post">
	<h2 class="the_title"><?php _e('The page you were looking for could not be found.','museum-core'); ?> <span frown>:(</span></h2>
	<p><?php _e('The page you were looking for is missing or doesn\'t exist.  Here are some links to help you back on your way.','museum-core'); ?></p>

	<div class="spacer-10"></div>

	<nav class="threecolumn" id="month">
		<h2><?php _e('Archives by Month','museum-core'); ?></h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</nav>

	<nav class="threecolumn" id="categories">
		<h2><?php _e('Archives by Subject','museum-core'); ?></h2>
		<ul>
			 <?php wp_list_categories( 'title_li=' ); ?>
		</ul>
	</nav>

	<nav class="threecolumn last" id="links">
		<h2><?php _e('Links','museum-core'); ?></h2>
		<ul>
			<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
		</ul>
	</nav>

	<div class="clear"></div>
	</article>
</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
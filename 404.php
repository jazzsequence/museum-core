<?php 
/*
	This is the 404 error template
*/
?>
<?php get_header(); ?>
<div class="content">
	<article class="post">
	<h2 class="the_title">The page you were looking for could not be found <span frown>:(</span></h2>
	<p>The page you were looking for is missing or doesn't exist.  Here are some links to help you back on your way.</p>

	<div class="spacer-10"></div>

	<nav class="threecolumn" id="month">
		<h2>Archives by Month</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	</nav>
					
	<nav class="threecolumn" id="categories">
		<h2>Archives by Subject</h2>
		<ul>
			 <?php wp_list_categories( 'title_li=' ); ?>
		</ul>
	</nav>            
		
	<nav class="threecolumn last" id="links">
		<h2>Links</h2>
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
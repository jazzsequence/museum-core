<?php 
/*
	This is the 404 error template
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="content">
<div class="post">

<h2 class="the_title">The page you were looking for could not be found</h2>
<p>The page you were looking for is missing or doesn't exist.  Here are some links to help you back on your way.</p>

<div class="spacer-10"></div>
<div class="notfound">

	<div class="threecolumn">
        <h2>Archives by Month</h2>
            <ul>
                <?php wp_get_archives('type=monthly'); ?>
            </ul>
	</div>
                
    <div class="threecolumn">    
        <h2>Archives by Subject</h2>
            <ul>
                 <?php wp_list_categories( 'title_li=' ); ?>
            </ul>
	</div>            
	
    <div class="threecolumn last">            
        <h2>Links</h2>
            <ul>
                <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
            </ul>
	</div>            

</div>
	<div class="clear"></div>
</div>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
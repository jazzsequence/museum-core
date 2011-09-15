<?php 
/*
	This is the search results template
*/
?>
<?php get_header(); ?>
<div class="content">
<?php
    global $query_string;
    $query_args = explode("&", $query_string);
    $search_query = array();
   
    foreach($query_args as $key => $string) {
        $query_split = explode("=", $string);
        $search_query[$query_split[0]] = $query_split[1];
    } // foreach
    
    $search = new WP_Query($search_query);
 
    global $wp_query;
    $total_results = $wp_query->found_posts;
?>
	<h2 class="searchresults">We found <?php echo $total_results; ?> results for &ldquo;<?php echo get_search_query(); ?>&rdquo;</h2>
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
		<h3 class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time('j F Y') ?></time></h3>
		<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="clear"></div>
		<section class="entry">
			<?php the_excerpt(); ?>
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

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
<?php 
/*
	This is the search results template
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
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
    ?>
		<?php
        global $wp_query;
        $total_results = $wp_query->found_posts;
		
        ?>
			<h2 class="searchresults">We found <?php echo $total_results; ?> results for &ldquo;<?php echo get_search_query(); ?>&rdquo;</h2>
	
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">				
				<div class="the_date"><h3><?php the_time('j F Y') ?></h3></div>
				<h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <div class="clear"></div>
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>
				<div class="postmetadata">
                Posted in <?php the_category(',&nbsp;'); ?> <?php the_tags('| Tags: ',', ',''); ?><br />
                <?php comments_popup_link('No Comments &#187;', 'One Comment &#187;', '% Comments &#187;'); ?>       
                </div>
				</div>
                <div class="clear"></div>

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php endif; ?>

</div>

<div class="clear"></div>
<?php get_footer(); ?>
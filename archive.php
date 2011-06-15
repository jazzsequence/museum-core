<?php 
/*
	This is the archives template
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="content">

				<?php if (have_posts()) : ?>

								 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
								  <?php /* If this is a category archive */ if (is_category()) { ?>
					                <h2 class="category_title">Posts filed under <?php single_cat_title(); ?></h2>
								  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					                <h2 class="category_title">Posts filed under <?php single_tag_title(); ?></h2>
								  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					                <h2 class="category_title">Archive for <?php the_time('j F Y'); ?></h2>
								  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					                <h2 class="category_title">Archive for <?php the_time('F Y'); ?></h2>
								  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					                <h2 class="category_title">Archive for <?php the_time('Y'); ?></h2>
								  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
					                <h2 class="category_title">Author Archive</h2>                                  
								  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					                <h2 class="category_title">Blog Archives</h2>                                  
								  <?php } ?>

					<?php while (have_posts()) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" class="the_single_post post">                    
              
    <h2 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
    <span class="postmeta">Posted on <?php the_time( 'l j F Y' ) ?></span>
		<?php the_excerpt(); ?>
    </div>
    <div class="spacer-10"></div>                    
                    
                    
					<?php endwhile; ?>

						<div class="navigation clearfix">
							<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
							<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
						</div>
				
				<?php
					 else : 
				?>
				
				
	
				<?php
					endif;
				?>
	</div>


<div class="clear"></div>
<?php get_footer(); ?>
<?php
global $wp_query;
$total_results = $wp_query->found_posts;
?>

<h1 class="searchresults the_title"><?php echo wp_kses_post( sprintf( __( 'We found %1$s results for <q>%2$s</q>', 'museum-core' ), $total_results, get_search_query() ) ); ?></h1>

<section class="searchform">
	<h3 class="alt"><?php _e( 'Not what you were looking for?  Enter your search terms to try again.', 'museum-core' ); ?></h3>
	<?php get_search_form(); ?>
</section>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php get_template_part( 'parts/part', 'title' ); ?>

	<?php tha_entry_before(); ?>
	<section class="entry media">
		<?php tha_entry_top(); ?>

		<?php if( has_post_thumbnail() ) { ?>
			<div class="pull-left"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-thumbnail media-object' ) ); ?></a></div>
		<?php } ?>

		<div class="media-body">
			<?php the_excerpt(); ?>
		</div>

		<?php tha_entry_bottom(); ?>
	</section>
	<?php tha_entry_after(); ?>

	<div class="icon icon-search pull-left" title="<?php esc_attr_e( 'Search', 'museum-core' ); ?>"></div><?php get_template_part( 'parts/part', 'postmetadata' ); ?>

</article>

<?php endwhile; ?>
<?php get_template_part( 'parts/part', 'navigation' ); ?>
<?php endif; ?>
<?php
/*
	This is the author page template
*/
get_header();
include( AP_CORE_OPTIONS ); ?>
<div class="content span-9<?php echo $right; ?>">

	<?php if ( have_posts() ) the_post();
		$description = get_the_author_meta('description');
		$url = get_the_author_meta('user_url');
	?>
	<section class="author">
		<div class="alignleft span-2"><?php echo get_avatar( get_the_author_meta('ID'), $size = '96' ); ?></div>
		<div class="span-10 last">
			<h2 class="the_title"><?php the_author_meta('display_name') ?></h2>
			<p>
				<?php if (isset($description)) {
					echo $description; ?><br />
				<?php }
				if (isset($url)) { ?>
					<a href="<?php echo $url; ?>" rel="me"><?php _e('Website','museum-core'); ?></a>
				<?php } ?>
			</p>
		</div>
		<h3 class="alt"><?php echo sprintf( __( 'All posts by %1$s', 'museum-core' ), get_the_author_meta('display_name') ); ?></h3>
	</section>
	<div class="spacer-10"></div>
	<?php
		rewind_posts();
		get_template_part('post', 'author');
	?>

</div>
<?php get_sidebar(); ?>
<div class="clear"></div>
<?php get_footer(); ?>
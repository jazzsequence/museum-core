<?php
/*
	This is the author page template
*/
get_header();
tha_content_before();
$ap_core_content = ap_core_get_which_content();
$ap_core_description = null;
$ap_core_url = null;
?>
<div class="content col-md-9 <?php echo esc_attr( $ap_core_content ) ?>">
	<?php tha_content_top(); ?>

	<?php if ( have_posts() ) the_post();
		$ap_core_description = esc_attr( get_the_author_meta('description') );
		$ap_core_url = get_the_author_meta('user_url');
	?>
	<section class="author media">
		<div class="pull-left media-object"><?php echo get_avatar( get_the_author_meta('ID'), $size = '96' ); ?></div>
		<div class="media-body">
			<h2 class="the_title media-heading"><?php the_author_meta('display_name') ?></h2>
			<p>
				<?php if ( $ap_core_description ) {
					echo wp_kses_post( $ap_core_description ); ?><br />
				<?php }
				if ( $ap_core_url ) { ?>
					<a href="<?php echo esc_url($ap_core_url); ?>" rel="me"><?php _e('Website','museum-core'); ?></a>
				<?php } ?>
			</p>
		</div>
	</section>
	<div class="spacer-10"></div>
	<h3 class="alt"><?php echo esc_attr( sprintf( __( 'All posts by %s', 'museum-core' ), get_the_author_meta('display_name') ) ); ?></h3>
	<?php
		rewind_posts();
		get_template_part('parts/content', 'author');
	?>

	<?php tha_content_bottom(); ?>
</div>
<?php tha_content_after(); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
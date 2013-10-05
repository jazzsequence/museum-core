<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php tha_entry_before(); ?>
	<section class="entry">
		<?php tha_entry_top(); ?>

		<?php the_content(__('Read more &raquo;','museum-core')); ?>
		<?php get_template_part( 'parts/part', 'link-pages' ); ?>

		<?php tha_entry_bottom(); ?>
	</section>
	<?php tha_entry_after(); ?>

	<div class="icon icon-bullhorn pull-left" title="<?php _e( 'Status', 'museum-core' ); ?>"></div><?php get_template_part( 'parts/part', 'micropostmeta' ); ?>

</article>
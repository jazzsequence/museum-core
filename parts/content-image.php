<?php if (have_posts()) : while (have_posts()) : the_post();
global $content_width; ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<h1 class="the_title"><?php the_title(); ?></h1>

		<?php tha_entry_before(); ?>
		<section class="entry">
			<?php tha_entry_top(); ?>

			<div class="attachment">
				<?php
					/**
					 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
					 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
					 */
					$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
					foreach ( $attachments as $k => $attachment ) {
						if ( $attachment->ID == $post->ID )
							break;
					}
					$k++;
					// If there is more than 1 attachment in a gallery
					if ( count( $attachments ) > 1 ) {
						if ( isset( $attachments[ $k ] ) )
							// get the URL of the next image attachment
							$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
						else
							// or get the URL of the first image attachment
							$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
					} else {
						// or, if there's only 1 image, get the URL of the image
						$next_attachment_url = wp_get_attachment_url();
					}
				?>

				<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, array( $content_width, 9999 ) ); ?></a>
			</div><!-- .attachment -->

			<?php if ( ! empty( $post->post_excerpt ) ) : ?>
			<div class="entry-caption">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>

			<?php get_template_part( 'parts/part', 'link-pages' ); ?>

			<?php tha_entry_bottom(); ?>
		</section>
		<?php tha_entry_after(); ?>

		<div class="icon icon-paperclip pull-left" title="<?php esc_attr_e( 'Image', 'museum-core' ); ?>"></div><?php get_template_part( 'parts/part', 'postmetadata' ); ?>

        <?php tha_comments_before(); ?>
    	<section id="comments">
			<?php comments_template(); ?>
        </section>
        <?php tha_comments_after(); ?>

	</article>

<?php endwhile; endif; ?>
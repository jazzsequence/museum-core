<?php if ( 'chat' != get_post_format() || 'gallery' != get_post_format() ) { ?>
    <h3 class="the_date"><time datetime=<?php the_time('Y-m-d'); ?>><?php the_time(get_option('date_format')) ?></time></h3>
<?php } ?>

<?php $is_title_set = get_the_title();
if ( empty( $is_title_set ) ) { ?>
	<h1 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %s','museum-core'), the_title_attribute( 'echo=0' ) ); ?>"><?php _e('(no title)', 'museum-core'); ?></a></h1>
<?php } else { ?>
	<h1 class="the_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %s','museum-core'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h1>
<?php } ?>
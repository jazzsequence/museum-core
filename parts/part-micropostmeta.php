<section class="postmetadata">
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo sprintf( __('Permanent Link to %s','museum-core'), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>

	<span class="human-time-diff alt"><?php echo sprintf(__('%1$s ago','museum-core'), human_time_diff( get_the_time('U'), current_time('timestamp') )); ?></span><br />
</section>
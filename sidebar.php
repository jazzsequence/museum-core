<?php
/*
	this is the sidebar
*/
include( get_template_directory() . '/inc/load-options.php' ); ?>
 <div class="sidebar the_<?php echo $sidebar; ?> threecol<?php echo $last; ?>">
	<ul>
         <!-- regular sidebar starts here -->
         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
         <?php endif; ?>
     </ul>
</div>
<?php
/*
	this is the sidebar
*/
include( AP_CORE_OPTIONS ); ?>
 <div class="sidebar the_<?php echo $sidebar; ?> threecol<?php echo $last; ?>">
	<ul>
         <!-- regular sidebar starts here -->
         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(__('Sidebar','museum-core')) ) : ?>
         <?php endif; ?>
     </ul>
</div>
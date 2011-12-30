<?php
/*
	this is the sidebar
*/
?>
 <div class="sidebar the_right threecol last">
	<ul>
         <!-- regular sidebar starts here -->
         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
         <?php endif; ?>
     </ul>
</div>
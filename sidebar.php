<?php
/*
	this is the sidebar
*/
tha_sidebars_before();
$sidebar = ap_core_get_which_sidebar(); ?>
 <div class="sidebar the_<?php echo $sidebar; ?> col-md-3 col-lg-3">
 	<?php tha_sidebar_top(); ?>
	<ul>
         <!-- regular sidebar starts here -->
         <?php if ( !dynamic_sidebar(__('Sidebar','museum-core')) ) : ?>
         <?php endif; ?>
     </ul>
     <?php tha_sidebar_bottom(); ?>
</div>
<?php tha_sidebars_after();
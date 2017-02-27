<?php
/*
	this is the sidebar
*/
tha_sidebars_before();
$ap_core_sidebar = ap_core_get_which_sidebar(); ?>
 <div class="sidebar the_<?php echo esc_attr( $ap_core_sidebar ); ?> col-md-3">
 	<?php tha_sidebar_top(); ?>
	<ul>
         <?php dynamic_sidebar( 'main-sidebar-box'); ?>
     </ul>
     <?php tha_sidebar_bottom(); ?>
</div>
<?php tha_sidebars_after();

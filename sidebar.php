<?php
/*
	this is the sidebar
*/
$defaults = ap_core_get_theme_defaults();
$options = get_option( 'ap_core_theme_options' );
if ( !isset($options['sidebar']) )
	$sidebar = $defaults['sidebar'];
if ( 'right' == $options['sidebar'] )
	$last = ' last'; ?>
 <div class="sidebar the_<?php echo $sidebar; ?> threecol<?php echo $last; ?>">
	<ul>
         <!-- regular sidebar starts here -->
         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
         <?php endif; ?>
     </ul>
</div>
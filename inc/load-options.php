<?php
	/**
	 * Load options
	 * @since 0.4.2
	 * @author Chris Reynolds
	 * this file loads the options and the defaults and has some functions that are used in the actual template files
	 */

$defaults = ap_core_get_theme_defaults();
$options = get_option( 'ap_core_theme_options' );
if ( $options['sidebar'] ) {
	$sidebar = $options['sidebar'];
} else {
	$sidebar = $defaults['sidebar'];
}
$right = '';
$last = '';
$show_excerpt = '';
$archive_excerpt = '';

if ( !isset($options['sidebar']) ) {
	$sidebar = $defaults['sidebar'];
	$right = ' the_right last';
	$last = '';
}
if ( 'right' == $options['sidebar'] ) {
	$sidebar = $options['sidebar'];
	$last = ' last';
}
if ( 'left' == $options['sidebar'] ) {
	$sidebar = $options['sidebar'];
	$right = ' the_right last';
	$last = '';
}

if ( !isset($options['excerpts']) ) {
	$show_excerpt = $defaults['excerpts'];
} else {
	$show_excerpt = $options['excerpts'];
}
if ( is_archive() ) {
	if ( !isset($options['archive-excerpt']) ) {
		$archive_excerpt = $defaults['archive-excerpt'];
	} else {
		$archive_excerpt = $options['archive-excerpt'];
	}
}
?>
<?php
$args = array(
	'before' => '<ul class="pagination">',
	'after' => '</ul>',
	'before_link' => '<li>',
	'after_link' => '</li>',
	'current_before' => '<li class="active">',
	'current_after' => '</li>',
	'previouspagelink' => '&laquo;',
	'nextpagelink' => '&raquo;'
);

ap_core_link_pages( $args );
?>
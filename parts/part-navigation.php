	<nav class="navigation clearfix">
		<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','museum-core')) ?></div>
		<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','museum-core')) ?></div>
		<?php } ?>
	</nav>
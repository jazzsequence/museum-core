<nav class="navigation clearfix">
	<?php  if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
		<ul class="pager">
			<li class="previous"><?php next_posts_link(__('&larr; Older Entries','museum-core')) ?></li>
			<li class="next"><?php previous_posts_link(__('Newer Entries &rarr;','museum-core')) ?></li>
		</ul>
	<?php } ?>
</nav>
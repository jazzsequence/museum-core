<?php
	$searchtext = __('Search this site', 'museum-core');
?>
<form method="get" role="form" class="form-inline" id="searchform" action="<?php echo home_url(); ?>/">
	<div class="form-group">
		<label class="sr-only" for="search">
			<?php echo $searchtext; ?>
		</label>
		<input type="search" class="form-control col-md-12" placeholder="<?php echo $searchtext; ?>" name="s" id="s" />
		<button type="submit" id="searchsubmit" class="btn btn-default"><?php esc_attr_e('Go', 'museum-core'); ?></button>
	</div>
</form>

<?php
	$searchtext = __('Search this site', 'museum-core');
	$onfocus = "if (this.value == '$searchtext') {this.value = '';}";
	$onblur = "if (this.value == '') {this.value = '$searchtext';}";
?>
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
<div><input type="text" value="<?php echo $searchtext; ?>" name="s" id="s" onfocus="<?php echo $onfocus; ?>" onblur="<?php echo $onblur; ?>" />
<input type="submit" id="searchsubmit" value="<?php _e('Go', 'museum-core'); ?>" />
</div>
</form>

<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
<div><input type="text" value="Search this site" name="s" id="s" onfocus="if (this.value == 'Search this site')
{this.value = '';}" onblur="if (this.value == '') {this.value = 'Search this site';}" />
<input type="submit" id="searchsubmit" value="Go" />
</div>
</form>

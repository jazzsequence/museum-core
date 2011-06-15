<?php 
/*
	this is the sidebar
*/
?>
<?php include (TEMPLATEPATH.'/get-theme-options.php'); ?>
    <?php if (($left == "true") || ($right != "true" )) { ?>
<div class="sidebar the_left">
    <?php } ?>         
    <?php if ($right == "true") { ?>
 <div class="sidebar the_right">
	<?php } ?>
    <div class="social">
 	<div class="rss"><a href="<?php bloginfo('rss_url'); ?>" title="Subscribe to <?php bloginfo('title'); ?> by RSS" class="linktous"><img src="<?php bloginfo('template_url'); ?>/images/rss.png" border="0" alt="Subscribe by RSS" /> <abbr>RSS</abbr></a></div>    
	<?php if ($apbp_twitter != null ) {
	?> 
    <div class="twitter"><a href="http://www.twitter.com/<?php echo $apbp_twitter ?>" target="_blank" title="Follow <?php echo $apbp_twitter ?> on Twitter" class="linktous"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png" border="0" alt="Follow <?php echo $apbp_twitter ?> on Twitter" />Twitter</a></div>
    <?php } ?>
    <div class="clear"></div>
	<?php if ($apbp_facebook != null ) {
	?> 
    <div class="facebook"><a href="http://www.facebook.com/<?php echo $apbp_facebook ?>" target="_blank" title="Friend <?php echo $apbp_facebook ?> on Facebook" class="linktous"><img src="<?php bloginfo('template_url'); ?>/images/facebook.png" border="0" alt="Friend <?php echo $apbp_facebook ?> on Facebook" /> Facebook</a></div>
    <?php } ?>  
	<?php if ($apbp_myspace != null ) {
	?> 
    <div class="myspace"><a href="http://www.myspace.com/<?php echo $apbp_myspace ?>" target="_blank" title="Check out <?php echo $apbp_myspace ?> on MySpace" class="linktous"><img src="<?php bloginfo('template_url'); ?>/images/myspace.png" border="0" alt="Check out <?php echo $apbp_myspace ?> on MySpace" /> MySpace</a></div>
    <?php } ?>        
    </div>
    <div class="clear"></div>

	<!-- display recent tweets if enabled -->
		<?php if (($apbp_tweets != null ) && ($apbp_foottwit != "true")) { ?>
        <div id="twitter_div">
        <?php if ($apbp_twitter != null ) { ?>
        <h2><?php echo $apbp_twithead ?></h2>
        <?php } ?>
		<ul id="twitter_update_list"></ul>
		</div>    
		<?php } ?>
	<ul>
         <!-- regular sidebar starts here -->
         <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar') ) : ?>
         <?php endif; ?>
     </ul>
</div> 
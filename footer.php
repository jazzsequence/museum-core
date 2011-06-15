<?php include (TEMPLATEPATH.'/get-theme-options.php'); ?>
<div class="footer">
        <div class="leftbox span-8 colborder">
		  <ul>
        	 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Footer Box') ) : ?>
             <?php endif; ?>        
          </ul>         
        </div>
        <div class="middlebox span-7 colborder">
          <ul>
			 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Center Footer Box') ) : ?>
             <?php endif; ?>                
          </ul>
        </div>
        <div class="rightbox span-7 last">
			<?php if (($apbp_tweets != null ) && ($apbp_foottwit == "true")) { ?>
                <div id="twitter_div">
                <?php if ($apbp_twitter != null ) { ?>
                <h2><?php echo $apbp_twithead ?></h2>
                <?php } ?>
                <ul id="twitter_update_list"></ul>
                </div>    
            <?php } else {?>
		 <ul>
			 <?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Footer Box') ) : ?>
             <?php endif; }?>                
          </ul>      
        </div>
        <div class="spacer-10"></div>
		<div class="credit">&copy; <?php echo date('Y'); ?> <?php bloginfo('title'); ?> | <a href="http://museumthemes.com/blog/free-themes/ap-blueprint/" title="AP-Blueprint | A free WordPress theme framework" target="_blank">AP-Blueprint</a> is a <a href="http://museumthemes.com/category/free-themes/" target="_blank" title="Museum Themes | Fine Art WordPress Themes">free WordPress theme</a> by <a href="http://www.arcanepalette.com/" title="arcane palette creative design | artistic website design" target="_blank">Arcane Palette</a></div>
        </div>
</div>

		<?php do_action('wp_footer'); ?>
</div>

<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo $apbp_twitter; ?>.json?callback=twitterCallback2&amp;count=<?php echo $apbp_tweets; ?>"></script>
</body>
</html>

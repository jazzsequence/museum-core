		<footer class="row">
			<div class="fourcol" id="leftbox">
				<ul>
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Footer Box') ) : ?>
					<?php endif; ?>
				</ul>
			</div>
			<div class="fourcol" id="middlebox">
				<ul>
					 <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Center Footer Box') ) : ?>
					 <?php endif; ?>
				</ul>
			</div>
			<div class="fourcol last" id="rightbox">
				<ul>
					 <?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Footer Box') ) : ?>
					 <?php endif; ?>
				</ul>
			</div>
			<div class="spacer-10"></div>
			<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'footernav', 'theme_location' => 'footer', 'fallback_cb' => false ) ); ?>
			<div class="credit">&copy; <?php echo date('Y'); ?> <?php bloginfo('title'); ?> | <?php _e('Core is a ','ap_core'); ?><a href="http://wordpress.org" target="_blank">WordPress</a><?php _e(' theme framework by ','ap_core'); ?><a href="http://museumthemes.com/category/free-themes/" target="_blank" title="Museum Themes | Fine Art WordPress Themes">Museum Themes</a></div>
		</footer>
	</div><!-- closes .container -->

		<?php wp_footer(); ?>
</body>
</html>

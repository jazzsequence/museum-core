		<footer>
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
					 <ul>
						 <?php if( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Footer Box') ) : ?>
						 <?php endif; ?>                
					  </ul>      
					</div>
					<div class="spacer-10"></div>
					<div class="credit">&copy; <?php echo date('Y'); ?> <?php bloginfo('title'); ?> | Core is a <a href="http://wordpress.org" target="_blank">WordPress</a> theme framework by <a href="http://museumthemes.com/category/free-themes/" target="_blank" title="Museum Themes | Fine Art WordPress Themes">Museum Themes</a></div>
					<?php wp_nav_menu( array( 'container_class' => 'footernav', 'theme_location' => 'footer', 'fallback_cb' => false ) ); ?>
			</div>
		</footer>
	</div><!-- closes .container -->

		<?php wp_footer(); ?>
</body>
</html>

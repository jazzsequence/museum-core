	<?php
	$ap_options = get_option( 'ap_core_theme_options' );
	$ap_defaults = ap_core_get_theme_defaults();
	?>

	</div>

	<?php tha_footer_before(); ?>
	<footer class="row">
		<?php tha_footer_top(); ?>
		<?php if ( is_active_sidebar( 'left-footer-box' ) ) : ?>
			<div class="col-sm-4" id="leftbox">
				<ul>
					<?php dynamic_sidebar( 'left-footer-box' ); ?>
				</ul>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'center-footer-box' ) ) : ?>
			<div class="col-sm-4" id="middlebox">
				<ul>
					 <?php dynamic_sidebar( 'center-footer-box' ); ?>
				</ul>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'right-footer-box' ) ) : ?>
			<div class="col-sm-4 last" id="rightbox">
				<ul>
					 <?php dynamic_sidebar( 'right-footer-box' ); ?>
				</ul>
			</div>
		<?php endif; ?>
		<div class="spacer-10"></div>
		<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'footernav', 'theme_location' => 'footer', 'fallback_cb' => false, 'depth' => 1 ) ); ?>
		<div class="credit">
			<?php if ( isset( $ap_options['footer'] ) && $ap_options['footer'] != '' ) {
				echo wp_kses_post( stripcslashes( $ap_options['footer'] ) );
			} else {
				echo wp_kses_post( $ap_defaults['footer'] );
			} ?>
		</div>
		<?php tha_footer_bottom(); ?>
	</footer>
	<?php tha_footer_after(); ?>

</div><!-- closes .container -->

<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>
</body>
</html>

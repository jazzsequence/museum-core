<?php tha_html_before(); ?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<?php tha_head_top(); ?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php $options = get_option( 'ap_core_theme_options' ); ?>
<?php
	$headerimg = null;
	if ( $options['site-title'] == false ) {
		$headerimg_before = '<a href="' . home_url() . '" title="' . get_bloginfo('title') . '">';
		$headerimg_after = '</a>';
	} else {
		$headerimg_before = null;
		$headerimg_after = null;
	}

	$fixed_nav = null;
	if ( isset( $options['nav-menu'] ) && ( true == $options['nav-menu'] ) ) {
		$fixed_nav = 'bs-fixed-nav';
	}

	$navbar_inverse = null;
	if ( isset( $options['navbar-inverse'] ) && ( true == $options['navbar-inverse'] ) ) {
		$navbar_inverse = 'navbar-inverse';
	} else {
		$navbar_invers = 'navbar-default';
	}
?>
<title><?php wp_title(); ?></title>
  <!-- Mobile viewport optimized: h5bp.com/viewport -->
<meta name="viewport" content="width=device-width">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
<?php tha_head_bottom(); ?>
</head>
<body <?php body_class( $fixed_nav ); ?>>
<?php tha_body_top(); ?>
	<div class="container" id="wrap">
		<?php tha_header_before(); ?>
		<header>
			<?php tha_header_top(); ?>
			<?php
				$default = array( 'container' => 'nav', 'depth' => 2, 'container_class' => 'topnav ' . $navbar_inverse . ' collapse navbar-collapse navbar-ex1-collapse', 'theme_location' => 'top', 'fallback_cb' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new wp_bootstrap_navwalker() );
				$fixed = array( 'container' => 'nav', 'depth' => 2, 'container_class' => 'topnav ' . $navbar_inverse . ' navbar navbar-default navbar-fixed-top', 'theme_location' => 'top', 'fallback_cb' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new wp_bootstrap_navwalker() );
			if ( $fixed_nav ) {
				// if the nav menu is fixed
				wp_nav_menu( $fixed );
			} else {
				wp_nav_menu( $default );
			} ?>
			<?php if ( function_exists( 'get_custom_header' ) ) {
				$header_image_width = get_theme_support( 'custom-header', 'width' );
			} else {
				$header_image_width = HEADER_IMAGE_WIDTH;
			}
			// Check if this is a post or page, if it has a thumbnail, and if it's a big one
			if ( is_singular() && current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) && ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= $header_image_width ) :
				// there's a header image
				$headerimg = true;
				?>

				<div class="headerimg">

					<?php echo $headerimg_before; ?>
					<?php echo get_the_post_thumbnail( $post->ID ); ?>
					<?php echo $headerimg_after; ?>


			<?php elseif ( get_header_image() ) :

				$headerimg = true;
				if ( function_exists( 'get_custom_header' ) ) {
					$header_image_width = get_custom_header()->width;
					$header_image_height = get_custom_header()->height;
				} else {
					$header_image_width = HEADER_IMAGE_WIDTH;
					$header_image_height = HEADER_IMAGE_HEIGHT;
				} ?>

				<div class="headerimg">

					<?php echo $headerimg_before; ?>
					<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					<?php echo $headerimg_after; ?>

			<?php endif; ?>

			<hgroup class="siteinfo">
				<?php if ($options['alth1'] == true) { ?>
					<h2 class="alt"><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h2>
					<h3><?php bloginfo('description'); ?></h3>
				<?php } else { ?>
					<h2><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h2>
					<h3 class="alt"><?php bloginfo('description'); ?></h3>
				<?php } ?>
			</hgroup>

			<?php if ( $headerimg ) { ?>
				</div>
			<?php } ?>

			<?php wp_nav_menu( array( 'container' => 'nav', 'depth' => 2, 'container_class' => 'mainnav collapse navbar-collapse navbar-ex1-collapse', 'theme_location' => 'main', 'fallback_cb' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new wp_bootstrap_navwalker() ) ); ?>
			<?php tha_header_bottom(); ?>
		</header>
		<?php tha_header_after(); ?>
		<div class="row">
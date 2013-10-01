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
<title><?php wp_title(); ?></title>
  <!-- Mobile viewport optimized: h5bp.com/viewport -->
<meta name="viewport" content="width=device-width">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
<?php tha_head_bottom(); ?>
</head>
<body <?php body_class(); ?>>
<?php tha_body_top(); ?>
	<div class="container" id="wrap">
		<?php tha_header_before(); ?>
		<header>
			<?php tha_header_top(); ?>
			<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'topnav', 'theme_location' => 'top', 'fallback_cb' => false ) ); ?>
			<?php if ( (!get_header_image()) && (!has_post_thumbnail( $post->ID )) ) { ?>
				<hgroup class="siteinfo">
					<?php if ($options['alth1'] == true) { ?>
						<h2 class="alt"><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h2>
						<h3><?php bloginfo('description'); ?></h3>
					<?php } else { ?>
						<h2><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h2>
						<h3 class="alt"><?php bloginfo('description'); ?></h3>
					<?php } ?>
				</hgroup>
			<?php } else { ?>
				<?php if ( $options['site-title'] == false ) {
					$headerimg_before = '<a href="' . home_url() . '" title="' . get_bloginfo('title') . '">';
					$headerimg_after = '</a>';
				} else {
					$headerimg_before = null;
					$headerimg_after = null;
				} ?>
				<?php echo $headerimg_before; ?>
				<div class="headerimg">
					<?php
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() && current_theme_supports( 'post-thumbnails' ) &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID );
					elseif ( get_header_image() ) : ?>
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
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
				</div>
				<?php echo $headerimg_after; ?>
			<?php } ?>
			<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mainnav', 'theme_location' => 'main', 'fallback_cb' => false ) ); ?>
			<?php tha_header_bottom(); ?>
		</header>
		<?php tha_header_after(); ?>
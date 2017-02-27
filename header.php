<!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php tha_head_top(); ?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php $options = get_option( 'ap_core_theme_options' ); ?>
<?php
	$ap_core_headerimg = null;
	if ( !isset( $options['site-title'] ) || $options['site-title'] == false ) {
		$ap_core_headerimg_before = '<a href="' . esc_url( home_url() ) . '" title="' . get_bloginfo('title') . '">';
		$ap_core_headerimg_after = '</a>';
	} else {
		$ap_core_headerimg_before = null;
		$ap_core_headerimg_after = null;
	}

	$ap_core_fixed_nav = null;
	if ( isset( $options['nav-menu'] ) && ( true == $options['nav-menu'] ) ) {
		$ap_core_fixed_nav = 'bs-fixed-nav';
	}

	$ap_core_navbar_inverse = null;
	if ( isset( $options['navbar-inverse'] ) && ( true == $options['navbar-inverse'] ) ) {
		$ap_core_navbar_inverse = 'navbar-inverse';
	} else {
		$ap_core_navbar_inverse = 'navbar-default';
	}
?>
<?php tha_head_bottom(); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class( $ap_core_fixed_nav ); ?>>
<?php tha_body_top(); ?>
	<div class="container" id="wrap">
		<?php tha_header_before(); ?>
		<header>
			<?php tha_header_top(); ?>
			<div class="navbar-header">
				<?php
				$nav_1 = has_nav_menu( 'top' );
				$nav_2 = has_nav_menu( 'main' );
				$data_target = null;
				if ( !empty( $nav_1 ) ) {
					$data_target = '.navbar-1-collapse';
				} elseif ( !empty( $nav_2 ) ) {
					$data_target = '.navbar-2-collapse';
				}
				if ( !is_null( $data_target ) ) : ?>
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="<?php echo $data_target; ?>">
						<i class="icon-reorder" title="Menu"></i>
					</button>
				<?php endif; ?>
			</div>
			<?php
				$ap_core_navbar_default = array( 'container' => 'nav', 'container_class' => 'topnav ' . $ap_core_navbar_inverse . ' collapse navbar-collapse navbar-1-collapse', 'theme_location' => 'top', 'fallback_cb' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new AP_Core_WP_Bootstrap_Navwalker() );
				$ap_core_navbar_fixed = array( 'container' => 'nav', 'container_class' => 'topnav ' . $ap_core_navbar_inverse . ' navbar navbar-collapse collapse navbar-1-collapse navbar-default navbar-fixed-top', 'theme_location' => 'top', 'fallback_cb' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new AP_Core_WP_Bootstrap_Navwalker() );
			if ( $ap_core_fixed_nav ) {
				// if the nav menu is fixed
				wp_nav_menu( $ap_core_navbar_fixed );
			} else {
				wp_nav_menu( $ap_core_navbar_default );
			} ?>
			<?php
			$ap_core_header_image_width = get_theme_support( 'custom-header', 'width' );
			// Check if this is a post or page, if it has a thumbnail, and if it's a big one
			if ( is_singular() && current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) && ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= $ap_core_header_image_width ) :
				// there's a header image
				$ap_core_headerimg = true;
				?>

				<div class="headerimg">

					<?php echo wp_kses_post( $ap_core_headerimg_before ); ?>
					<?php echo get_the_post_thumbnail( $post->ID ); ?>
					<?php echo wp_kses_post( $ap_core_headerimg_after ); ?>


			<?php elseif ( get_header_image() ) :

				$ap_core_headerimg = true;
				$ap_core_header_image_width = get_custom_header()->width;
				$ap_core_header_image_height = get_custom_header()->height;
				?>

				<div class="headerimg">

					<?php echo wp_kses_post( $ap_core_headerimg_before ); ?>
					<img src="<?php header_image(); ?>" width="<?php echo esc_attr( $ap_core_header_image_width ); ?>" height="<?php echo esc_attr( $ap_core_header_image_height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
					<?php echo wp_kses_post( $ap_core_headerimg_after ); ?>

			<?php endif; ?>

			<hgroup class="siteinfo">
				<?php if ( isset( $options['alth1'] ) && $options['alth1'] == true) { ?>
					<h2 class="alt"><a href="<?php echo esc_url( home_url() ) ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h2>
					<h3><?php bloginfo('description'); ?></h3>
				<?php } else { ?>
					<h2><a href="<?php echo esc_url( home_url() ) ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h2>
					<h3 class="alt"><?php bloginfo('description'); ?></h3>
				<?php } ?>
			</hgroup>

			<?php if ( $ap_core_headerimg ) { ?>
				</div>
			<?php } ?>

			<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mainnav collapse navbar-collapse navbar-2-collapse', 'theme_location' => 'main', 'fallback_cb' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new AP_Core_WP_Bootstrap_Navwalker() ) ); ?>
			<?php tha_header_bottom(); ?>
		</header>
		<?php tha_header_after(); ?>
		<div class="row">

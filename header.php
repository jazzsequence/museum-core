<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php $options = get_option( 'ap_core_theme_options' ); ?>
<title><?php wp_title(); ?></title>
<?php /* meta description */ ?>
<?php if ($options['meta'] == 'true') {
	if ( is_tax() ) {
		$term_description = term_description(); ?>
	<meta name="description" content="<?php echo $term_description; ?>">
	<?php } elseif (( is_single() ) || ( is_page())) { ?>
	<meta name="description" content="<?php the_excerpt(); ?>">
<?php }
}
if ($options['author'] == 'true') {
	if (!is_404()) {
		// if there is no post author, this stuff doesn't exist
		$author_id = $post->post_author;
		$author = get_userdata($author_id);
	?>
	<meta name="author" content="<?php echo $author->display_name; ?>">
	<?php }
} ?>
  <!-- Mobile viewport optimized: h5bp.com/viewport -->
<meta name="viewport" content="width=device-width">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php if ( isset($options['favicon']) ) {
	$favicon = $options['favicon']; ?>
	<link rel="Shortcut Icon" href="<?php echo $favicon; ?>" type="image/x-icon" />
<?php } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="container" id="wrap">
		<header>
			<div class="header">
				<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'topnav', 'theme_location' => 'top', 'fallback_cb' => false ) ); ?>
				<?php if ( (!get_header_image()) && (!has_post_thumbnail( $post->ID )) ) { ?>
				<hgroup class="siteinfo">
					<?php if ($options['alth1'] == 'true') { ?>
						<h1 class="alt"><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
						<h2><?php bloginfo('description'); ?></h2>
					<?php } else { ?>
						<h1><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
						<h2 class="alt"><?php bloginfo('description'); ?></h2>
					<?php } ?>
				</hgroup>
				<?php } else { ?>

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
					<?php if ($options['alth1'] == 'true') { ?>
						<h1 class="alt"><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
						<h2><?php bloginfo('description'); ?></h2>
					<?php } else { ?>
						<h1><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
						<h2 class="alt"><?php bloginfo('description'); ?></h2>
					<?php } ?>
				</hgroup>
			</div>
			<?php } ?>
			<div class="clear"></div>
				<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mainnav', 'theme_location' => 'main', 'fallback_cb' => false ) ); ?>
			</div>
		</header>
		<div class="clear"></div>
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
	<title>
		<?php
		if ( !is_404() )
			$category = get_the_category();
		if ( is_home() ) { bloginfo('name'); }
		elseif ( is_category() ) { wp_title('',true); echo ' | ' ; bloginfo('name'); }
		elseif (is_single() ) { wp_title('',true); echo ' | '; echo $category[0]->cat_name; }
		elseif (is_page() ) { wp_title('',true); }
		elseif ( is_404() ) { wp_title('',true); }
		else { wp_title('',true); } ?> | <?php bloginfo('description'); ?>
	</title>
<?php $options = get_option( 'ap_core_theme_options' ); ?>
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
<!-- uncomment this if you want to use a favicon.  Upload your favicon to the /themes/museum-core/images/ directory
<link rel="Shortcut Icon" href="<?php echo get_template_directory_uri() ?>/images/favicon.ico" type="image/x-icon" />
-->
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_get_archives('type=monthly&format=link'); ?>
<?php wp_head(); ?>
<?php if ($options['generator'] == 'true') {
	echo ap_core_generator();
} ?>
</head>
<body <?php body_class(); ?>>
	<div class="row container">
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
				<hgroup class="siteinfo">
					<?php if ($options['alth1'] == 'true') { ?>
						<h1 class="alt"><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
						<h2><?php bloginfo('description'); ?></h2>
					<?php } else { ?>
						<h1><a href="<?php echo home_url() ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></h1>
						<h2 class="alt"><?php bloginfo('description'); ?></h2>
					<?php } ?>
				</hgroup>
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
			</div>
			<?php } ?>
			<div class="clear"></div>
				<?php wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'mainnav', 'theme_location' => 'main', 'fallback_cb' => false ) ); ?>
			</div>
		</header>
		<div class="clear"></div>
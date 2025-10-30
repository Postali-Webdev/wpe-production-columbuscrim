<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $qode_options_passage;
global $wp_query;
$disable_qode_seo = "";
$seo_title = "";
if (isset($qode_options_passage['disable_qode_seo'])) $disable_qode_seo = $qode_options_passage['disable_qode_seo'];
if ($disable_qode_seo != "yes") {
	$seo_title = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_title", true);
	$seo_description = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_description", true);
	$seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_keywords", true);
}
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php
	$responsiveness = "yes";
	if (isset($qode_options_passage['responsiveness'])) $responsiveness = $qode_options_passage['responsiveness'];
	if($responsiveness != "no"):
	?>
	<meta name=viewport content="width=device-width,initial-scale=1">
	<?php 
	endif;
	?>
	<title><?php if($seo_title) { ?><?php bloginfo('name'); ?> | <?php echo $seo_title; ?><?php } else {?><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?><?php } ?></title>
	<?php if ($disable_qode_seo != "yes") { ?>
	<?php if($seo_description) { ?>
	<meta name="description" content="<?php echo $seo_description; ?>">
	<?php } else if($qode_options_passage['meta_description']){ ?>
	<meta name="description" content="<?php echo $qode_options_passage['meta_description'] ?>">
	<?php } ?>
	<?php if($seo_keywords) { ?>
	<meta name="keywords" content="<?php echo $seo_keywords; ?>">
	<?php } else if($qode_options_passage['meta_keywords']){ ?>
	<meta name="keywords" content="<?php echo $qode_options_passage['meta_keywords'] ?>">
	<?php } ?>
	<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $qode_options_passage['favicon_image']; ?>">
	<?php wp_head(); ?>

	<!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MCHGD6');</script>
    <!-- End Google Tag Manager -->

	<!-- Add JSON schema here -->
	<?php // Global Schema
	$global_schema = get_field('global_schema', 'options');
	if(!is_page(384) && !is_page(16721) && !is_page(10774)) {
		if ( !empty($global_schema) ) :
			echo '<script type="application/ld+json">' . $global_schema . '</script>';
		endif;
	} 

	// Single Page Schema
	$single_schema = get_field('single_schema');
	if ( !empty($single_schema) ) :
		echo '<script type="application/ld+json">' . $single_schema . '</script>';
	endif;

	// FAQ Page Schema
	$faq_schema = get_field('faq_schema');
	if ( !empty($faq_schema) ) :
		echo '<script type="application/ld+json">' . $faq_schema . '</script>';
	endif; ?>

<?php if ( is_page_template( 'homepage.php' ) ) : ?>
<!-- Detect for touchscreen -->
<script>
jQuery(function($){
	// Touch Device Detection
	var isTouchDevice = 'ontouchstart' in document.documentElement;
	if( isTouchDevice ) {
		$('body').removeClass('no-touch');
	}
});
</script>
<?php endif; ?>

</head>

<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MCHGD6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->	
	
<?php
	$header_in_grid = false;
	if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

	$centered_logo = false;
	if (isset($qode_options_passage['center_logo_image'])){ if($qode_options_passage['center_logo_image'] == "yes") { $centered_logo = true; }};
?>
<div class="wrapper">
	

	<!-- header search bar -->
<div class="header_top_bar">
<div class="two_columns_50_50 clearfix">
	<div class="column1"><div class="header_phone"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-phone') ) : ?><?php endif; ?></div></div>
	<div class="column2"><div class="header_search"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-search') ) : ?><?php endif; ?></div></div>
	</div>
</div>
	
<header class="animate <?php if(isset($qode_options_passage['header_fixed']) && $qode_options_passage['header_fixed'] == "no"){ echo "no_fixed"; } ?><?php if($centered_logo){ echo " centered_logo"; } ?>">
	
				<div class="header_inner clearfix">
					<div class="header_left">
							<div class="main-logo"><a href="<?php echo home_url(); ?>/" title="Luftman Heck and Associates"><img src="<?php echo $qode_options_passage['logo_image']; ?>" alt="Luftman Heck and Associates"/></a></div>
					</div>
					<div class="header_right">
						<?php	
						$display_header_widget = $qode_options_passage['header_widget_area'];
						if($display_header_widget == "yes"){ ?> 
							<div class="header_right_widget">
								<?php dynamic_sidebar('header_right'); ?>
							</div>
						<?php } ?>
						<div class="head-menu">
							<?php
						        // The parent theme menu has way too many complications, lets use a simple wp_menu, primary-nav, set in the functions.php file
						        $args = array(
						          'container' => false,
						          'theme_location' => 'primary-nav'
						        );
						        wp_nav_menu( $args );
						      ?>
						</div>
						<div class="head-mobile mobile_show">
							<a href="#" id="menu-icon"><hr><hr><hr></a>
						</div>
					</div>
				</div>	
			</div>

</header>

<div id="mobile-nav" class="mobile_show">
	<?php
        // The parent theme menu has way too many complications, lets use a simple wp_menu, mobile-nav, set in the functions.php file
        $args = array(
          'container' => false,
          'theme_location' => 'mobile-nav'
        );
        wp_nav_menu( $args );
    ?>
    <div class="mobile-widget">
		<div class="column2"><div class="header_search"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('header-search') ) : ?><?php endif; ?></div></div>
      	<?php dynamic_sidebar('header_right'); ?>
    </div>
</div>
	
	
	<div class="content">
		<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$animation = get_post_meta($id, "qode_show-animation", true);

?>
			<?php if($qode_options_passage['page_transitions'] == "1" || $qode_options_passage['page_transitions'] == "2" || $qode_options_passage['page_transitions'] == "3" || $qode_options_passage['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
				<div class="meta">				
					<?php if($seo_title){ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php echo $seo_title; ?></div>
					<?php } else{ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
					<?php } ?>
					<?php if($seo_description){ ?>
						<div class="seo_description"><?php echo $seo_description; ?></div>
					<?php } else if($qode_options_passage['meta_description']){?>
						<div class="seo_description"><?php echo $qode_options_passage['meta_description']; ?></div>
					<?php } ?>
					<?php if($seo_keywords){ ?>
						<div class="seo_keywords"><?php echo $seo_keywords; ?></div>
					<?php }else if($qode_options_passage['meta_keywords']){?>
						<div class="seo_keywords"><?php echo $qode_options_passage['meta_keywords']; ?></div>
					<?php }?>
					<span id="qode_page_id"><?php echo $wp_query->get_queried_object_id(); ?></span>
					<div class="body_classes"><?php echo implode( ',', get_body_class()); ?></div>
				</div>
			<?php } ?>
			<div class="content_inner <?php echo $animation;?> ">
				
			
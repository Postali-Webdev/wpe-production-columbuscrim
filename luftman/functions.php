<?php

// enqueue the child theme stylesheet
Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' )  );
wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);

// Additional JS plugins
function my_custom_scripts() {
  	if( is_home() || is_front_page() ) {
  		wp_register_script('homepage_scripts', get_stylesheet_directory_uri() . '/js/homepage-scripts.js',array('jquery'), null, true); 
  		wp_enqueue_script('homepage_scripts');
  		//wp_register_script('fullpage', get_stylesheet_directory_uri() . '/js/jquery.fullpage.min.js',array('jquery'), null, true); 
		//wp_enqueue_script('fullpage');
		//wp_register_script('fullpage_custom_js', get_stylesheet_directory_uri() . '/js/fullpage-custom.js',array('jquery'), null, true); 
		//wp_enqueue_script('fullpage_custom_js');
		//wp_register_style('fullpage_css', get_stylesheet_directory_uri() . '/css/fullpage.min.css', null, null, 'all' );
		//wp_enqueue_style('fullpage_css');
		//wp_register_style('fullpage_custom_css', get_stylesheet_directory_uri() . '/css/fullpage-custom.css', null, null, 'all' );
		//wp_enqueue_style('fullpage_custom_css');
	}
  		wp_register_script('smooth_scroll', get_stylesheet_directory_uri() . '/js/smooth-scroll.min.js',array('jquery'), null, true); 
  		wp_enqueue_script('smooth_scroll', get_stylesheet_directory_uri() . '/js/smooth-scroll.min.js'); 
  		wp_register_script('smooth_scroll_settings', get_stylesheet_directory_uri() . '/js/smooth-scroll-settings.js',array('jquery'), null, true); 
  		wp_enqueue_script('smooth_scroll_settings', get_stylesheet_directory_uri() . '/js/smooth-scroll-settings.js');   

        // Modernizer
		wp_register_script('modernizer-webp', get_stylesheet_directory_uri() . '/js/modernizr-webp.js',array('jquery'), null, true); 
		wp_enqueue_script('modernizer-webp');

		//slick slider
		wp_register_script('slick-slider', get_stylesheet_directory_uri() . '/js/slick.min.js',array('jquery'), time(), true); 
  		wp_enqueue_script('slick-slider');
		
		wp_register_script('slick-custom', get_stylesheet_directory_uri() . '/js/slick-custom.js',array('jquery'), time(), true); 
  		wp_enqueue_script('slick-custom');

		wp_register_script('smooth_scroll_settings', get_stylesheet_directory_uri() . '/js/smooth-scroll-settings.js',array('jquery'), null, true); 
  		wp_enqueue_script('smooth_scroll_settings', get_stylesheet_directory_uri() . '/js/smooth-scroll-settings.js');   

  	// Custom Scripts
  		wp_register_script('custom_scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js',array('jquery'), null, true); 
  		wp_enqueue_script('custom_scripts');
  	// Read More Scripts
  	if ( is_post_type_archive( $post_types = 'results' ) ) {
		wp_register_script('readmore_scripts', get_stylesheet_directory_uri() . '/js/readmore.min.js',array('jquery'), null, true); 
		wp_enqueue_script('readmore_scripts');
	}
}

add_action('wp_enqueue_scripts', 'my_custom_scripts');

// ACF Options Pages
	if( function_exists('acf_add_options_page') ) {

		// Instructions & Customizations options pages functions live here

		// If the site is running the Postali theme,
		// you only need to add this function
		acf_add_options_page(array(
			'page_title'    => 'Global Schema',
			'menu_title'    => 'Global Schema',
			'menu_slug'     => 'global_schema',
			'capability'    => 'edit_posts',
			'icon_url'      => 'dashicons-media-code',
			'redirect'      => false
		));

	}

// Widget Logic Conditionals (ancestor) 
function is_tree( $pid ) {
global $post;

if ( is_page($pid) )
return true;

$anc = get_post_ancestors( $post->ID );
foreach ( $anc as $ancestor ) {
if( is_page() && $ancestor == $pid ) {
return true;
}
}
return false;
}


// User role edits
add_filter( 'user_has_cap',
function( $caps ) {
    if ( ! empty( $caps['edit_pages'] ) )
        $caps['manage_options'] = true;
    return $caps;
} );


// Add class for non-touch devices (Homepage only)
function be_body_classes( $classes ) {
  $classes[] = 'no-touch';
  return $classes;
}
add_filter( 'body_class', 'be_body_classes' );


// Add ability to add SVG to Wordpress Media Library
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


// Register site navigation menus
function emeraldCity_register_nav_menus() {
  register_nav_menus(
    array(
        'primary-nav' => __( 'Primary Navigation', 'emeraldCity' ),
        'mobile-nav' => __( 'Mobile Navigation', 'emeraldCity' ),
    )
  );
}
add_action( 'init', 'emeraldCity_register_nav_menus' );


// Shortode to display most recent blog post
function my_recent_posts($atts){
 $q = new WP_Query(
   array( 'orderby' => 'date', 'posts_per_page' => '5')
 );

$list = '<ul class="recent_posts">';

while($q->have_posts()) : $q->the_post();

 $list .= '<li><span class="subheader_blue">' . get_the_date() . '</span><a href="' . get_permalink() . '" title="Read the Blog Post">' . get_the_title() . '</a></li>';

endwhile;

wp_reset_query();

return $list . '</ul>';
	
}

add_shortcode('recent-posts', 'my_recent_posts');

// Add shortcode for current year
function year_shortcode() {
	$year = date('Y');
	return $year;
  }
add_shortcode('year', 'year_shortcode');

// add ability to target ancestor pages
 function is_child( $page_id_or_slug ) { // $page_id_or_slug = The ID of the page we're looking for pages underneath
  global $post; // load details about this page

	    if ( !is_numeric( $page_id_or_slug ) ) { // Used this code to change a slug to an ID, but had to change is_int to is_numeric for it to work.
	        $page = get_page_by_path( $page_id_or_slug );
	        $page_id_or_slug = $page->ID;
	    }

	    if ( is_page() && ( $post->post_parent == $page_id_or_slug ) )
	        return true; // we're at the page or at a sub page
	    else
	        return false; // we're elsewhere
};


/* Tweaked Social Share shortcode */
if (!function_exists('social_share')) {
function social_share($atts, $content = null) {
	global $qode_options_passage;
	if(isset($qode_options_passage['twitter_via']) && !empty($qode_options_passage['twitter_via'])) {
		$twitter_via = " via " . $qode_options_passage['twitter_via'];
	} else {
		$twitter_via = 	"";
	}
    $html = "";  
	if(isset($qode_options_passage['enable_social_share']) && $qode_options_passage['enable_social_share'] == "yes") { 
		$post_type = get_post_type();
		if(isset($qode_options_passage["post_types_names_$post_type"])) {
			if($qode_options_passage["post_types_names_$post_type"] == $post_type) {
			if($post_type == "portfolio_page") {
				$html .= '<div class="portfolio_social_share">';
			}
				$html .= '<div class="social_share_holder">';
					$html .= '<ul>';
					if(isset($qode_options_passage['enable_facebook_share']) &&  $qode_options_passage['enable_facebook_share'] == "yes") { 
						$html .= '<li class="facebook_share">';
						if(wp_is_mobile()) {
							$html .= '<a title="'.__("Share on Facebook","qode").'" href="javascript:void(0)" onclick="window.open(\'http://m.facebook.com/sharer.php?u=' . urlencode(get_permalink());
						}
						else {
							$html .= '<a title="'.__("Share on Facebook","qode").'" href="javascript:void(0)" onclick="window.open(\'http://www.facebook.com/sharer.php?s=100&amp;p[title]=' . urlencode(get_the_title()) . '&amp;p[url]=' . urlencode(get_permalink()) . '&amp;p[images][0]=';
							if(function_exists('the_post_thumbnail')) {
								$html .=  wp_get_attachment_url(get_post_thumbnail_id());
							}
						}

						$html .= '&amp;p[summary]=' . urlencode(strip_tags(get_the_excerpt()));
						$html .='\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');">';
						if(!empty($qode_options_passage['facebook_icon'])) {
							$html .= '<img src="' . $qode_options_passage["facebook_icon"] . '" />';
						} else { 
							$html .= '<span class="social_image"><span class="social_image_inner"></span></span>';
						} 
						$html .= "<span class='share_text'>" . __('<i class="wp-svg-custom-facebook-share-icon facebook-share-icon"></i>','qode') . "</span>";
						$html .= "</a>";
						$html .= "</li>";
						} 
						if($qode_options_passage['enable_twitter_share'] == "yes") { 
							$html .= '<li class="twitter_share">';
							if(wp_is_mobile()) {
								$html .= '<a href="#" title="'.__("Share on Twitter", 'qode').'" onclick="popUp=window.open(\'http://twitter.com/intent/tweet?text=' . urlencode(the_excerpt_max_charlength(mb_strlen(get_permalink())) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;">';
							}
							else {
								$html .= '<a href="#" title="'.__("Share on Twitter", 'qode').'" onclick="popUp=window.open(\'http://twitter.com/home?status=' . urlencode(the_excerpt_max_charlength(mb_strlen(get_permalink())) . $twitter_via) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;">';
							}
									if(!empty($qode_options_passage['twitter_icon'])) { 
										$html .= '<img src="' . $qode_options_passage["twitter_icon"] . '" />';
									 } else { 
										$html .= '<span class="social_image"><span class="social_image_inner"></span></span>';
									 }
									$html .= "<span class='share_text'>" . __('<i class="wp-svg-custom-twitter-share-icon twitter-share-icon"></i>','qode') . "</span>";
								$html .= "</a>";
							$html .= "</li>";
						 } 
						if($qode_options_passage['enable_google_plus'] == "yes") { 
							$html .= '<li  class="google_share">';
							$html .= '<a href="#" onclick="popUp=window.open(\'https://plus.google.com/share?url=' . urlencode(get_permalink()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false">';
									if(!empty($qode_options_passage['google_plus_icon'])) { 
										$html .= '<img src="' . $qode_options_passage['google_plus_icon'] . '" />';
									} else { 
										$html .= '<span class="social_image"><span class="social_image_inner"></span></span>';
									 } 
									$html .= "<span class='share_text'>" . __('Share','qode') . "</span>";
								$html .= "</a>";
							$html .= "</li>";
						 }
						$html .= "</ul>";
				$html .= "</div>";
				if($post_type == "portfolio_page") {
					$html .= '</div>';
				}
			} 
		}  
	}
    return $html;
}
}
add_shortcode('social_share', 'social_share');



// Contact Form 7 Submission Page Redirect
add_action( 'wp_footer', 'mycustom_wp_footer' );
 
function mycustom_wp_footer() {
?>
<script type="text/javascript">
document.addEventListener( 'wpcf7mailsent', function( event ) {
    location = '/form-success/';
}, false );
</script>
<?php
}


// Shortcode for adding default sidebar to page content
function sidebar_sc( $atts ) {
    ob_start();
    dynamic_sidebar('SidebarPage');
    $html = ob_get_contents();
    ob_end_clean();
    return '
    <aside class="sidebar">'.$html.'</aside>';
    }

    add_shortcode('sidebar', 'sidebar_sc');


// Add categories to custom post types 
 function wpse_category_set_post_types( $query ){
if( $query->is_category ):
$query->set( 'post_type', array( 'post', 'Results', 'Results' ) );
endif;
return $query;
}

add_action( 'pre_get_posts', 'wpse_category_set_post_types' );

// Remove WordPress auto trash delete of pages
function wpb_remove_schedule_delete() {
    remove_action( 'wp_scheduled_delete', 'wp_scheduled_delete' );
}
add_action( 'init', 'wpb_remove_schedule_delete' );


// Remove Wordpress Emoji Javascript call
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/* Pagination settings */ 
if ( ! function_exists( 'postali_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 * Based on paging nav function from Twenty Fourteen
 */

function postali_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
        'end_size' => 0,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&laquo;', 'Previous' ),
		'next_text' => __( '&raquo;', 'Next' ),
		'type'      => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
			<?php echo $links; ?>
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

// Pagespeed
function qode_styles_child() {
wp_deregister_style('style_dynamic');
wp_register_style('style_dynamic', get_stylesheet_directory_uri() . '/css/style_dynamic.css');
wp_enqueue_style('style_dynamic');
wp_deregister_style('style_dynamic_responsive');
wp_register_style('style_dynamic_responsive', get_stylesheet_directory_uri() . '/css/style_dynamic_responsive.css');
wp_enqueue_style('style_dynamic_responsive');
 wp_deregister_style('custom_css');
    wp_register_style('custom_css', get_stylesheet_directory_uri() . '/css/custom_css.css');
    wp_enqueue_style('custom_css');
}
function qode_scripts_child() {
wp_deregister_script('default_dynamic');
wp_register_script('default_dynamic', get_stylesheet_directory_uri() . '/js/default_dynamic.js');
wp_enqueue_style('default_dynamic', array(),false,true);
wp_deregister_script('custom_js');
    wp_register_script('custom_js', get_stylesheet_directory_uri() . '/js/custom_js.js');
    wp_enqueue_style('custom_js', array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'qode_styles_child', 11);
add_action( 'wp_enqueue_scripts', 'qode_scripts_child', 11);

//Media Mentions CPT
function media_mentions() {
	$labels = array(
		'name'               => __( 'Media Mentions', 'post type general name' ),
		'singular_name'      => __( 'Media Mention', 'post type singular name' ),
		'add_new'            => __( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Media Mention' ),
		'edit_item'          => __( 'Edit Media Mention' ),
		'new_item'           => __( 'New Media Mention' ),
		'all_items'          => __( 'All Media Mentions' ),
		'view_item'          => __( 'View Media Mentions' ),
		'search_items'       => __( 'Search Media Mentions' ),
		'not_found'          => __( 'No Media Mentions found' ),
		'not_found_in_trash' => __( 'No Media Mentions found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Media Mentions'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'All of my Media Mentions',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'menu_icon'		=> 'dashicons-share',
	);
	register_post_type( 'media_mentions', $args );	
}
add_action( 'init', 'media_mentions' );

//Restrict color picker options
function klf_acf_input_admin_footer() { ?>
	<script type="text/javascript">
	(function($) {
	
	acf.add_filter('color_picker_args', function( args, $field ){
	
	// add the hexadecimal codes here for the colors you want to appear as swatches
	args.palettes = ['#ffffff', '#000000', '#0d213a', '#ceaa78']
	
	// return colors
	return args;
	
	});
	
	})(jQuery);
	</script>
	
	<?php }
	
	add_action('acf/input/admin_footer', 'klf_acf_input_admin_footer');

function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');
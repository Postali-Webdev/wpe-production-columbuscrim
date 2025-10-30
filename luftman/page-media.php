<?php 
/* Template Name: Media Mentions */ 
?>

<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);  

if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_passage['responsive_title_image'];
}

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_passage['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options_passage['title_image'];
}

if(get_post_meta($id, "qode_title-height", true) != ""){
 $title_height = get_post_meta($id, "qode_title-height", true);
}else{
	$title_height = $qode_options_passage['title_height'];
}

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>
	<?php get_header(); ?>
		<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
			<div class="title animate <?php if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
				<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
				<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
					<?php if($title_in_grid){ ?>
					<div class="container">
						<div class="container_inner clearfix">
					<?php } ?>
							
					<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
							
					<?php if ( !is_page(array (33,106))) : ?> 
						<span class="title_subheader">Practice Areas</span>
					<?php elseif ( is_page(106)) : ?> 
						<span class="title_subheader">Central Ihio Courts</span>	
					<?php endif; ?>	

					<h1><?php the_title(); ?></h1>
					<?php if( get_field('sub_title') ): ?>
						<div class="header-sub-title"><?php the_field('sub_title'); ?></div>
					<?php endif; ?>
					<?php if($title_in_grid){ ?>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if($qode_options_passage['show_back_button'] == "yes") { ?>
			<a id='back_to_top' href='#'>
				<span class='back_to_top_inner'>
					<span>&nbsp;</span>
				</span>
			</a>
		<?php } ?>
		
		<?php
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){
			echo do_shortcode($revslider);
		}
		?>
	<div class="full_width">
        <div class="container_inner">

        <div class="assets">
            <div class="assets_left">
                <span class="assets_left_cta">Need Our Brand Assets?</span>
                <span class="assets_left_content">Media Contact: 
                    <a class="assets_left_content_link" href="mailto:<?php the_field('email'); ?>" title="Email Postali"><?php the_field('email'); ?></a>
                </span>
            </div>
            <div class="assets_right">
                <?php if ( have_rows('social_links') ): ?>
                    <?php while ( have_rows('social_links') ): the_row(); 
                        $social         = get_sub_field('name');
                        $social_url     = get_sub_field('url');
                        $social_icon    = get_sub_field('icon');
                        $icon_alt       = $social_icon['alt'];
                        $icon_src       = $social_icon['url'];
                    ?>  
                        <div class="social">
                            <a href="<?php echo $social_url; ?>" class="social_btn" title="<?php echo $social; ?>" target="_blank">
                                <img class="social_icon" src="<?php echo esc_url($icon_src); ?>" alt="<?php echo esc_attr($icon_alt); ?>" />
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?> 
            </div>
        </div>

            <!-- /* Add post list & pagination */ -->
            <div class="mentions-container">
            <h2 class="media-banner-title">Media Coverage</h2>
            <?php 
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $custom_query = new WP_Query(
                array(
                    'post_type' => 'media_mentions',
                    'offset'=> (($paged -1) * 5),  
                            'posts_per_page' => 5,
                    'orderby'   => array(
                        'date' =>'DESC',
                        'menu_order'=>'ASC',
                    ),
                )
            );

            if ( $custom_query -> have_posts() ):
            while($custom_query->have_posts()) : $custom_query->the_post(); 
                    $image = get_field('image');
                    $image_url = $image['url'];
                    $image_alt = $image['alt'];
                    $link = get_field('link');
                    $cta_text = get_field('cta_text');
                            $no_follow = get_field('add_no_follow');
                ?>		
                        <div class="media-mention">
                            <?php if ( !empty($image) ) { ?>
                                <div class="media-mention_image">
                                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
                                </div>
                            <?php } ?>
                            <div class="media-mention_info">
                                <h2 class="media-title"><?php the_title(); ?></h2>
                                <div class="desc"><p><?php the_content(); ?></p></div>
                                <a class="mention-link" <?php echo ( $no_follow === true) ? "rel='nofollow'" : ''; ?> href="<?php echo $link; ?>" title="<?php the_title(); ?>" target="_blank"><?php echo $cta_text; ?> &raquo;</a>
                            </div>
                        </div> 
                            <?php wp_reset_postdata(); ?>
                <?php endwhile; ?>
                </div>

            <div class="pagination">
                <?php function add_pagination($custom_query) {                    
                    $total_pages = $custom_query->max_num_pages;
                
                    if ($total_pages > 1){
                        $current_page = max(1, get_query_var('paged'));
                
                        ?><nav class="navigation paging-navigation" role="navigation"><ul class="page-numbers"><?php
                        echo paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => 'page/%#%',
                            'current' => $current_page,
                            'total' => $total_pages,
                            'type'      => 'list',
                            'prev_text' => __( '&laquo;', 'Previous' ),
                            'next_text' => __( '&raquo;', 'Next' ),
                        ));
                        ?></ul></nav><?php
                    }
                }
                
                add_pagination($custom_query); ?>
            </div>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            </div>
        </div>

	</div>
	<?php get_footer(); ?>			
<?php 
/*
Template Name: Homepage - 2026
*/ 
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

<link rel='stylesheet' id='styles-css' href='/wp-content/themes/luftman/assets/css/styles.css' type='text/css' media='all' />

<?php get_header(); ?>

<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
    <div class="title animate <?php if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
        <?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
        <?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
            <?php if($title_in_grid){ ?>
            <div class="container">
                <div class="container_inner clearfix">
            <?php } ?>
            <h1><?php the_title(); ?></h1>
            <?php if($title_in_grid){ ?>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
<?php } ?>

<?php $banner_bg = get_field('banner_background_image'); ?>

<div class="body-container">
    <section class="banner" style="background-image:url(<?php echo $banner_bg; ?>);">
        <div class="container">
            <div class="columns">
                <div class="column-50">
                    <h1><?php the_field('page_title_h1'); ?></h1>
                    <p class="headline"><?php the_field('banner_headline'); ?></p>
                    <p class="subhead"><?php the_field('banner_intro_copy'); ?></p>
                    <div class="spacer-15"></div>
                    
                    <?php get_template_part('block-cta-block', null, array(
                        'class' => "",
                    ),
                    ); ?>

                    <div class="spacer-15"></div>
                    <p class="cta-text">24/7 reliability  |  Free Consults</p>
                </div>
                <div class="column-33">
                    <div class="banner-testimonial">
                        <p class="testimonial-top">600+ Five Star Reviews  ★★★★★</p>
                        <?php
                        $featured_post = get_field('review');
                        if( $featured_post ): ?>
                            <p><?php echo esc_html( $featured_post->post_content ); ?></p>
                        <?php endif; ?>
                        <p class="link"><a href="/testimonials/">View More Client Reviews</a> <span class="icon-crest-chevron-right"></span></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container awards">
            <div class="columns">
                <div class="column-full">
                    <?php if( have_rows('awards') ): ?>
                    <?php while( have_rows('awards') ): the_row(); ?>  
                    <?php 
                    $image = get_sub_field('image');
                    if( !empty( $image ) ): ?>
                    <div class="award">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                    <?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </section>

    <section class="p1 white">
        <div class="container">
            <div class="columns">
                <div class="column-50 testimonial" style="background-image:url(<?php the_field('testimonial_image'); ?>);">
                    <p class="stars">★★★★★</p>
                    <div class="spacer-15"></div>
                    <p class="testimonial-quote"><?php the_field('testimonial_quote'); ?></p>
                    <div class="spacer-15"></div>
                    <p class="testimonial-author"><?php the_field('testimonial_author'); ?></p>
                </div>
                <div class="column-50">
                    <p class="highlight"><?php the_field('p1_section_highlight'); ?></p>
                    <?php the_field('p1_section_copy'); ?>
                    <?php get_template_part('block-cta-block', null, array(
                        'class' => "reversed",
                    ),
                    ); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="p2 white">
        <div class="container">
            <div class="columns">
                <div class="column-50">
                    <p class="highlight"><?php the_field('p2_section_highlight'); ?></p>
                    <?php the_field('p2_section_copy'); ?>
                </div>
                <div class="column-50" style="background-image:url(<?php the_field('cases_image'); ?>);">
                </div>
            </div>
            <div class="spacer-30"></div>
            <div class="columns results">
            <?php if( have_rows('p2_results_list') ): ?>
            <?php while( have_rows('p2_results_list') ): the_row(); ?>
                <?php $post_object = get_sub_field('result'); ?>
                <?php if( $post_object ): ?>
                    <?php // override $post
                    $post = $post_object;
                    setup_postdata( $post );
                    ?>
                    <a class="column-25 result" href="<?php the_permalink(); ?>">
                        <p class="med"><strong><?php the_title(); ?></strong></p>
                        <div class="read-more">Read More <span class="icon-crest-chevron-right"></span></div>
                    </a>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                <?php endif; ?>
            <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="p3 white">
        <div class="container">
            <div class="columns">
                <div class="column-66 centered center">
                    <h2><?php the_field('p3_section_headline'); ?></h2>
                    <?php the_field('p3_section_copy'); ?>
                </div>
                <div class="spacer-30"></div>
                <div class="column-full practice-areas">
                    <?php if( have_rows('practice_areas') ): ?>
                    <?php while( have_rows('practice_areas') ): the_row(); ?>  
                        <a class="column-25 practice-area" style="background-image:url(<?php the_sub_field('background_image'); ?>;)" href="<?php the_sub_field('page_link'); ?>" title="<?php the_sub_field('practice_area_name'); ?>">
                            <div class="pa-title"><?php the_sub_field('practice_area_name'); ?> <span class="icon-crest-chevron-right"></span></div>
                            <div class="overlay"></div>
                        </a>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>
                <div class="spacer-30"></div>
                <div class="column-full centered center">
                    <a href="/practice-areas/" class="btn">All Practice Areas</a>
                </div>
            </div>
        </div>
    </section>

    <section class="p4 blue-gradient">
        <div class="container">
            <div class="columns">
                <div class="column-full">
                    <h2><?php the_field('p4_section_headline'); ?></h2>
                    <?php if( have_rows('tout_boxes') ): ?>
                    <div class="spacer-30"></div>
                    <div class="touts">
                    <?php while( have_rows('tout_boxes') ): the_row(); ?>  
                        <div class="column-33 tout-box">
                            <h4><?php the_sub_field('headline'); ?></h4>
                            <?php the_sub_field('copy'); ?>
                        </div>
                    <?php endwhile; ?>
                    </div>
                    <?php endif; ?> 
                </div>

                <div class="spacer-line"></div>

                <div class="column-50 attorney-img">
                    <?php 
                    $image = get_field('p4_bio_photo');
                    if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div>
                <div class="column-50 block">
                    <div class="section-highlight"><?php the_field('p4_section_highlight'); ?></div>
                    <?php the_field('p4_section_copy'); ?>

                    <div class="spacer-30"></div>

                    <div id="award-slider" class="slide">
                        <?php $n=1 ?>
                        <?php if( have_rows('awards') ): ?>
                        <?php while( have_rows('awards') ): the_row(); ?>  
                            <?php 
                            $image = get_sub_field('image');
                            if( !empty( $image ) ): ?>
                            <div class="award" id="award_<?php echo $n; ?>">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                            <?php endif; ?>
                            <?php $n++; ?>
                        <?php endwhile; ?>
                        <?php endif; ?> 
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p5 white">
        <div class="container">
            <div class="columns">
                <div class="column-66 centered center">
                    <p class="stars">★★★★★</p>
                    <p class="large"><strong><?php the_field('p5_quote'); ?></strong></p>
                    <p><a href="/testimonials/"><strong>View More Client Reviews </strong> <span class="icon-crest-chevron-right"></span></a></p>
                </div>
                <div class="spacer-60"></div>
                <div class="column-full award-logos">
                    <?php if( have_rows('award_logos') ): ?>
                    <?php while( have_rows('award_logos') ): the_row(); ?>  
                        <?php 
                        $image = get_sub_field('logo');
                        if( !empty( $image ) ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </section>

    <section class="p6 white">
        <div class="container">
            <div class="columns">
                <div class="column-50 block">
                    <p class="highlight"><?php the_field('p6_section_highlight'); ?></p>
                    <?php the_field('p6_left_content'); ?>
                </div>
                <div class="column-50">
                    <?php 
                    $image = get_field('p6_right_image');
                    if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="p7 white">
        <div class="container">
            <div class="columns">
                <div class="column-66 centered center">
                    <p class="highlight"><?php the_field('p7_section_highlight'); ?></p>
                    <?php the_field('p7_section_copy'); ?>
                </div>
                <div class="spacer-60"></div>
                <div class="column-full hp-tabs">
                    <div class="legal_process_steps">
                        <div class="tabs transparent">

                            <ul class="tabs-nav">
                            <?php if( have_rows('p7_tabs') ): ?>
                            <?php $b = 1; ?>
                            <?php while( have_rows('p7_tabs') ): the_row(); ?>  
                                <li><a href="#tabid<?php echo $b; ?>"><?php the_sub_field('tab_group_title'); ?></a></li>
                                <?php $b++; ?>
                            <?php endwhile; ?>
                            <?php endif; ?> 
                            </ul>

                            <div class="tabs-container" style="display: block;">
                                <?php if( have_rows('p7_tabs') ): ?>
                                <?php $n = 1; ?>
                                <?php while( have_rows('p7_tabs') ): the_row(); ?>  
                                <div id="tabid<?php echo $n; ?>" class="tab-content">
                                    <div class="tabs-content">
                                        <div class="interior-tabs-nav">   
                                            <?php if( have_rows('tab_group_steps') ): ?>
                                            <?php $c = 1; ?>
                                            <ul>
                                            <?php while( have_rows('tab_group_steps') ): the_row(); ?> 
                                                <li><span id="tab<?php echo $c; ?>"><div class="number"><?php echo $c; ?>.</div> <div class="step-title"><?php the_sub_field('title'); ?></div></span></li>
                                                <?php $c++; ?>
                                            <?php endwhile; ?>
                                            </ul>
                                            <?php endif; ?> 
                                        </div>

                                        <div class="interior-tabs-content">
                                            <?php if( have_rows('tab_group_steps') ): ?>
                                            <?php $d = 1; ?>
                                            <?php while( have_rows('tab_group_steps') ): the_row(); ?> 
                                            <div id="tab<?php echo $d; ?>">
                                                <h3><?php the_sub_field('title'); ?></h3>
                                                <?php the_sub_field('copy'); ?>
                                            </div>
                                            <?php $d++; ?>
                                            <?php endwhile; ?>
                                            <?php endif; ?> 
                                        </div>

                                    </div>
                                </div>
                                
                                <?php $n++; ?>
                                <?php endwhile; ?>
                                <?php endif; ?> 

                            </div>
                        </div>
                    </div>
                </div>
                <div class="spacer-30"></div>
                <div class="column-50 chart">
                    <?php the_field('p7_felony_chart'); ?>
                </div>
                <div class="column-50 chart">
                    <?php the_field('p7_misdemeanor_chart'); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="p8 faqs blue">
        <div class="container">
            <div class="columns">
                <div class="column-33 block">
                    <h2><?php the_field('faqs_section_headline'); ?></h2>
                    <?php the_field('faqs_section_copy'); ?>
                </div>
                <div class="column-66">
                    <?php if( have_rows('hp_faqs') ): ?>
                    <?php $n=1; ?>
                    <?php while( have_rows('hp_faqs') ): the_row(); ?>  
                        <div class="accordions">
                            <div class="accordions_title">
                                <h3><?php the_sub_field('question'); ?></h3>
                            </div>
                            <div class="accordions_content" <?php if ($n == 1) { ?> style="display:block;" <?php } ?>>
                                <?php the_sub_field('answer'); ?>
                            </div>
                        </div>
                        <?php $n++; ?>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </section>

    <section class="p9 dui white">
        <div class="container">
            <div class="columns">
                <div class="column-66 block">
                    <h2><?php the_field('p9_section_headline'); ?></h2>
                    <?php the_field('p9_section_copy'); ?>
                </div>
                <div class="column-33">
                    <a href="/ovi-dui-defense/" class="btn">OVI / DUI Defense overview</a>
                    <div class="slider-nav">
                        <div class="prev-button-slick"><span class="icon-crest-chevron-left"></span></div>
                        <div class="next-button-slick"><span class="icon-crest-chevron-right"></span></div>
                    </div>
                </div>
                <div class="spacer-15"></div>
                <div class="dui-slides">
                    <?php if( have_rows('p9_dui_links') ): ?>
                    <?php while( have_rows('p9_dui_links') ): the_row(); ?>  
                        <a class="column-25 dui-slide" href="<?php the_sub_field('link'); ?>">
                            <p class="large"><?php the_sub_field('title'); ?></p>
                            <p><?php the_sub_field('copy'); ?></p>
                            <div class="learn-more">Learn More <span class="icon-crest-chevron-right"></span></div>
                        </a>
                    <?php endwhile; ?>
                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </section>

    <?php 
    $image = get_field('p10_background_image');
    ?>

    <section class="p10 blue" style="background-image:url('<?php echo $image; ?>');">
        <div class="container">
            <div class="columns">
                <div class="column-50 block">
                    <h2><?php the_field('p10_section_headline'); ?></h2>
                    <?php the_field('p10_section_copy'); ?>
                    <div class="spacer-15"></div>
                    <div class="cta-block">
                        <a href="tel:16145003836" class="btn">(614) 500-3836</a>
                        <a href="/contact/">Contact Us Online</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="p11 white">
        <div class="container">
            <div class="columns">
                <div class="column-50 block">
                    <p class="highlight"><?php the_field('p11_section_highlight'); ?></p>
                    <h2><?php the_field('p11_section_headline'); ?></h2>
                    <?php the_field('p11_section_copy'); ?>
                    <div class="spacer-15"></div>
                    <div class="nap-locations">
                        <div class="column-50">

                            <p class="large"><strong>Columbus Office</strong></p>
                            <p>
                                <span itemprop="streetAddress">150 E Mound St STE 300</span><br />
                                <span itemprop="addressLocality">Columbus</span> <span itemprop="addressRegion">OH</span> 
                                <span itemprop="postalCode">43215-5429</span> 
                            </p>

                            <p><strong><a href="tel:614-500-3836">(614) 500-3836</a></strong></p>
        
                        </div>
                        <div class="column-50">

                            <p class="large"><strong>Dublin Office</strong></p>
                            <p>
                                <span itemprop="streetAddress">5890 Venture Dr</span><br />
                                <span itemprop="addressLocality">Dublin</span> <span itemprop="addressRegion">OH</span> 
                                <span itemprop="postalCode">43017-6142</span> 
                            </p>

                            <p><strong><a href="tel:614-224-1500">(614) 224-1500</a></strong></p>

                        </div>
                    </div>
                </div>
                <div class="column-50 block">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d195545.78049378272!2d-83.10578260839836!3d40.021784952718605!3m2!1i1024!2i768!4f13.1!2m1!1sLuftman%2C%20Heck%20%26%20Associates%20LLP!5e0!3m2!1sen!2sus!4v1774880002274!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

</div>


<?php get_footer(); ?>			
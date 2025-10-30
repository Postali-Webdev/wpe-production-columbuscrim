<?php
/*
Template Name: Practice Area (Updated)
*/ ?>

<?php 
//ACF Fields
$banner_img = get_field('hero_background_image');
$icon_img = get_field('hero_banner_icon');
$featured_award = get_field('p2_best_lawyer_award');

$featured_award_url = $featured_award['url'] ? $featured_award['url'] : '/wp-content/uploads/2022/02/Lawyer-of-the-Year-Contemporary-Logo.png';
$featured_award_alt = $featured_award['alt'] ? $featured_award['alt'] : "Ben Luftman's Best Lawyers award";
$featured_award_title = $featured_award['title'] ? $featured_award['title'] : "Ben Luftman's Best Lawyers award";


get_header(); ?>

<div class="title animate has_background" style="background-image:url('<?php esc_html_e( $banner_img['url'] ); ?>'); height: 590px;">
    <div class="container">
        <div class="container_inner clearfix">
            <?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
            <span class="title_subheader">Practice Areas</span>
            <h1><?php the_field('hero_banner_title'); ?></h1>
            <div class="header-sub-title">
                <?php the_field('banner_intro_cta_text') ?> 
            </div>
        </div>
    </div>
    <div class="icon-wrapper">
        <img class="pa-icon" src="<?php esc_html_e($icon_img['url']); ?>" alt="<?php esc_html_e($icon_img['alt']); ?>" title="<?php esc_html_e($icon_img['title']); ?>">
    </div>
</div>

<div class="full_width">
    <div id="practice_area_intro" class="textpanel">
        <div class="container_inner">
            <div class="two_columns_66_33 clearfix">
                <div class="column1">
                    <div class="column_inner">

                        <?php if(get_field('add_on_page_cta')) { ?>
                        <p class="subheader_gold attention">ATTENTION</p>
                        <div class="callout_box">
                            <p><?php the_field('p1_cta_intro_text'); ?></p>
                            <p><a class="ibp" title="Luftman, Heck and Associates" href="tel:<?php the_field('p1_cta_phone_number'); ?>"><?php the_field('p1_cta_phone_number'); ?></a></p>
                            <div class="box-separator"></div>
                            <p><?php the_field('p1_cta_bottom_text'); ?></p>
                        </div>
                        <?php } ?>

                        <p class="intro_text_gold"><?php the_field('p1_intro_text'); ?></p>

                        <div class="arrow_down">
                            <p class="subheader_gold">Scroll for more information</p>
                            <i class="wp-svg-custom-down-arrow-2 down-arrow-2"></i>
                        </div>
                    </div>
                </div>
                <div class="column2"><div class="column_inner">
                    <div class="practice_area_submenu">
                        <p class="subheader_gold">Jump to</p>
                        <?php if( have_rows('p3_main_body') ) : ?>
                            <ul>
                            <?php while( have_rows('p3_main_body') ) : the_row(); ?>
                                <?php if( get_sub_field('section_title_h2') ) :
                                    //prepare string for anchor link
                                    $anchor_link = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', get_sub_field('section_title_h2')));
                                    $anchor_link = str_replace('--', '-', $anchor_link);
                                    ?>
                                    <li><a href="#<?php echo strtolower($anchor_link); ?>"><?php the_sub_field('section_title_h2'); ?></a></li>
                                <?php endif; ?>
                            <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="practice_area_awards" class="textpanel">
        <div class="container_inner">
            <div class="content_width_75">
                <p class="intro_text_white"><?php the_field('p2_award_copy'); ?></p>
                <a href="<?php the_field('p2_best_lawyer_link'); ?>"> 
                    <img src="<?php esc_html_e($featured_award_url); ?>" alt="<?php esc_html_e($featured_award_alt); ?>" title="<?php esc_html_e($featured_award_title); ?>">
                </a>
                <br>
                <?php $all_awards = get_field('p2_all_awards'); 
                if( $all_awards ) : 
                    $all_awards_mobile_url = $all_awards['mobile_version'] ? $all_awards['mobile_version'] : '/wp-content/uploads/2018/03/dui-awards-mobile.png';
                    $all_awards_desktop_url = $all_awards['desktop_version'] ? $all_awards['desktop_version'] : '/wp-content/uploads/2018/03/dui-awards.png'; ?>
                    <img src="<?php esc_html_e( $all_awards_mobile_url ); ?>" alt="attorney award icons" title="attorney award icons" class="mobile_show">
                    <img src="<?php esc_html_e( $all_awards_desktop_url ); ?>" alt="attorney award icons" title="attorney award icons" class="mobile_hide">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div id="practice_area_content" class="textpanel">
        <div class="container_inner">
            <div class="two_columns_66_33 clearfix">
                <?php if( have_rows('p3_main_body') ) : ?>
                <div class="column1">
                    <div class="column_inner"> 
                        
                        <?php while( have_rows('p3_main_body') ) : the_row(); ?>    
                            <?php if( get_row_layout() === 'section_title' ) :
                                //prepare string for anchor link
                                $anchor_link = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', get_sub_field('section_title_h2')));
                                $anchor_link = str_replace('--', '-', $anchor_link);
                                ?>
                                <h2 id="<?php echo strtolower($anchor_link); ?>"><?php the_sub_field('section_title_h2'); ?></h2>
                            <?php endif; ?>

                            <?php if( get_row_layout() === 'copy_block' ) : ?> 
                                <div class="copy-block"><?php the_sub_field('copy'); ?></div>
                            <?php endif; ?>

                            <?php if( get_row_layout() === 'cta_block' ) : ?>
                                <div class="contact_tab">
                                    <div class="two_columns_50_50 clearfix flexbox_container">
                                        <div class="column1">
                                            <div class="column_inner">
                                                <?php the_sub_field('cta_text'); ?>
                                            </div>
                                        </div>
                                        <div class="column2">
                                            <div class="column_inner">
                                                <div class="contact_form">
                                                    <div class="wpcf7 js" id="wpcf7-f16290-p15102-o1" lang="en-US" dir="ltr">
                                                        <?php echo do_shortcode( get_sub_field('contact_form')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( get_row_layout() === 'video_embed') : ?>
                                <div id="schema-videoobject" class="video-container"><iframe title="<?php the_sub_field('video_title') ?>" src="<?php the_sub_field('youtube_embed_url'); ?>" width="100%" height="420" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
                <?php endif; ?>
                <div class="column2">
                    <div class="column_inner">  
                        <aside class="sidebar">
                            <div class="widget">
                                <?php dynamic_sidebar('SidebarPage'); //utilizing wp menus through widgets ?>
                            </div>
                        </aside> 
                    </div>
                </div>
            </div>
        </div>

    </div>
    <a href="#" class="to-top-btn"></a>
</div>

<?php get_footer(); ?>		
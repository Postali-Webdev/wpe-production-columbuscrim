<?php

if(get_post_meta(get_the_ID(), "qode_show-sidebar", true) != ""){
	$sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);
}else{
	$sidebar = $qode_options_passage['blog_single_sidebar'];
}

$blog_hide_comments = "";
if (isset($qode_options_passage['blog_hide_comments'])) 
	$blog_hide_comments = $qode_options_passage['blog_hide_comments'];
	
if(get_post_meta(get_the_ID(), "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta(get_the_ID(), "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_passage['responsive_title_image'];
}

if(get_post_meta(get_the_ID(), "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta(get_the_ID(), "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_passage['fixed_title_image'];
}

if(get_post_meta(get_the_ID(), "qode_title-image", true) != ""){
 $title_image = get_post_meta(get_the_ID(), "qode_title-image", true);
}else{
	$title_image = $qode_options_passage['title_image'];
}

if(get_post_meta(get_the_ID(), "qode_title-height", true) != ""){
 $title_height = get_post_meta(get_the_ID(), "qode_title-height", true);
}else{
	$title_height = $qode_options_passage['title_height'];
}

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

if(isset($qode_options_passage['twitter_via']) && !empty($qode_options_passage['twitter_via'])) {
	$twitter_via = " via " . $qode_options_passage['twitter_via'];
} else {
	$twitter_via = 	"";
}

if(get_post_meta(get_the_ID(), "qode_content-animation", true) != ""){
 $content_animation = get_post_meta(get_the_ID(), "qode_content-animation", true);
}else{
	if(isset($qode_options_passage['content_animation'])){
		$content_animation = $qode_options_passage['content_animation'];
	}else{
		$content_animation = 'yes';
	}
}

?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
				<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title", true)) { ?>
					<div class="title animate <?php if($content_animation == 'no'){ echo 'no_entering_animation '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
						<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
						<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title-text", true)) { ?>
							<?php if($title_in_grid){ ?>
							<div class="container">
								<div class="container_inner clearfix">
							<?php } ?>
							
							<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
							
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
					$revslider = get_post_meta(get_the_ID(), "qode_revolution-slider", true);
					if (!empty($revslider)){
						echo do_shortcode($revslider);
					}
				?>
				<div class="container top_move <?php if($content_animation == 'no'){ echo 'no_entering_animation'; }  ?>">
					<div class="container_inner">
					<div class="container_inner2 clearfix">
					<?php if(($sidebar == "default")||($sidebar == "")) : ?>
						<div class="blog_single_holder">	
							<article>
													
								<?php if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") {
										if ( has_post_thumbnail()) { ?>
											<div class="image">		
												<?php the_post_thumbnail('full'); ?>
											</div>
									<?php }
									}
								?>
								<div class="blog_title_holder">
									 <?php if(!get_post_meta(get_the_ID(), "qode_page-title-text", true)){ ?>
									 <h2><?php the_title(); ?></h2>
									 <?php } ?>
									 <span><?php the_time('d M Y'); ?>, <?php _e('by','qode'); ?> <span class="blog_author"><?php the_author(); ?></span> <?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span></span>
								</div>
								<div class="blog_single_text_holder">
									<div class="text">
										<?php the_content(); ?>
									</div>
									<div class="info">
										<span class="left">
											<?php echo do_shortcode('[social_share]'); ?>
										</span>
										<?php if( has_tag()) { ?><span class="right"><?php the_tags(__('TAGS: ','qode')); ?></span><?php } ?>
									</div>			
									<?php wp_link_pages(); ?>
								</div>
							</article>
						</div>
						<?php
							if($blog_hide_comments != "yes"){
								comments_template('', true); 
							}else{
								echo "<br/><br/>";
							}
						?> 
						
					<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
						<?php if($sidebar == "1") : ?>	
							<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
											
							<div class="title_container"><h1><?php the_title(); ?></h1>										
							 <span class="create">Posted On: <span class="blue"><?php the_time('F jS, Y'); ?></span>  &nbsp; | &nbsp; Posted by: Luftman, Heck & Associates LLP</span>
							</div>


							<div class="column1">
						<?php elseif($sidebar == "2") : ?>	
							<div class="two_columns_75_25 background_color_sidebar grid2 clearfix">
								<div class="column1">
						<?php endif; ?>

							<!-- social share -->
							<?php echo do_shortcode('[social_share]'); ?>
					
									<div class="column_inner">

									<div class="blog_single_holder">	
											<article>
											
												<?php if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") {
														if ( has_post_thumbnail()) { ?>
															<div class="image">		
																<?php the_post_thumbnail('full'); ?>
															</div>
													<?php }
													}
												?>

												<div class="mobile_show"><?php echo do_shortcode('[social_share]'); ?></div>

												<div class="blog_single_text_holder">
													<div class="text">

                                                        <?php if(get_field('add_on_page_cta')) { ?>
                                                        <p class="subheader_gold attention">ATTENTION</p>
                                                        <div class="callout_box">
                                                            <p><?php the_field('p1_cta_intro_text'); ?></p>
                                                            <p><a class="ibp" title="Luftman, Heck and Associates" href="tel:<?php the_field('p1_cta_phone_number'); ?>"><?php the_field('p1_cta_phone_number'); ?></a></p>
                                                            <div class="box-separator"></div>
                                                            <p><?php the_field('p1_cta_bottom_text'); ?></p>
                                                        </div>
                                                        <?php } ?>

														<?php the_content(); ?>
													</div>

													<?php wp_link_pages(); ?>
												</div>
											</article>
										</div>
										
										<?php
											if($blog_hide_comments != "yes"){
												comments_template('', true); 
											}else{
												echo "<br/><br/>";
											}
										?> 
									</div>
								</div>	
								<div class="column2"> 
									<?php get_sidebar(); ?>
									<?php 
										$all_categories = get_the_category($post->ID); 
										$primary_category = '';
										$primary_category_slug = '/category/';
										$count = 0;
										foreach($all_categories as $category) {
											if( $count < 1 ) {
												$primary_category = $category->name;
												$primary_category_slug .= $category->slug . '/';
											}
											$count++;
										}
										$related_posts_args = [
											'post_type'			=> 'post',
											'post_status'		=> 'publish',
											'posts_per_page'	=> 5,
											'orderby' => 'publish_date',
											'order' => 'DESC',
											'post__not_in'      => array( $post->ID ),
											'category_name'     => $primary_category
										];
										$related_posts_query = new WP_Query($related_posts_args);
									
										if( $related_posts_query->have_posts() ) : ?>
											<div class="column_inner">
												<aside>
													<div class="widget related_posts_faux_widget">
														<h5>Related Blog Posts</h5>
														<div class="textwidget">
															<ul class="related_posts">
															<?php while( $related_posts_query->have_posts() ) :
																$related_posts_query->the_post(); 
																$link = get_the_permalink(); 
																$title = get_the_title();
																$date = get_the_date();
																?>
																	<li><span class="subheader_blue"><?php echo $date; ?></span><a href="<?php esc_html_e($link); ?>" title="Read the Blog Post"><?php esc_html_e($title); ?></a></li>
															<?php endwhile; ?>
															</ul>
															<a class="read_more" href="<?php esc_html_e( $primary_category_slug ); ?>" title="View all blog posts">View <?php esc_html_e( $primary_category ); ?> Blog Posts</a>
														</div>
													</div>	
												</aside>
											</div>
										<?php endif; ?>
								</div>
							</div>
						<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
							<?php if($sidebar == "3") : ?>	
								<div class="two_columns_33_66 background_color_sidebar grid2 clearfix">
								<div class="column1"> 
									<?php get_sidebar(); ?>
								</div>
								<div class="column2">
							<?php elseif($sidebar == "4") : ?>	
								<div class="two_columns_25_75 background_color_sidebar grid2 clearfix">
									<div class="column1"> 
										<?php get_sidebar(); ?>
									</div>
									<div class="column2">
							<?php endif; ?>
							
										<div class="column_inner">
											<div class="blog_single_holder">	
												<article>
													<?php if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") {
															if ( has_post_thumbnail()) { ?>
																<div class="image">		
																	<?php the_post_thumbnail('full'); ?>
																</div>
														<?php }
														}
													?>
													<div class="blog_title_holder">
														 <?php if(!get_post_meta(get_the_ID(), "qode_page-title-text", true)){ ?>
														 <h2><?php the_title(); ?></h2>
														 <?php } ?>
														 <span><?php the_time('d M Y'); ?>, <?php _e('by','qode'); ?> <span class="blog_author"><?php the_author(); ?></span> <?php _e('in','qode'); ?> <span class="category"><?php the_category(', '); ?></span></span>
													</div>
													<div class="blog_single_text_holder">
														<div class="text">
															<?php the_content(); ?>
														</div>
														<div class="info">
															<span class="left">
																<?php echo do_shortcode('[social_share]'); ?>
															</span>
															<?php if( has_tag()) { ?><span class="right"><?php the_tags(__('TAGS: ','qode')); ?></span><?php } ?>
														</div>			
														<?php wp_link_pages(); ?>
													</div>
												</article>
											</div>
											<?php
												if($blog_hide_comments != "yes"){
													comments_template('', true); 
												}else{
													echo "<br/><br/>";
												}
											?> 
										</div>
									</div>	
									
								</div>
						<?php endif; ?>
					</div>
				</div>
			</div>						
<?php endwhile; ?>
<?php endif; ?>	

<?php get_footer(); ?>	
<?php get_header(); ?>
<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

$sidebar = $qode_options_passage['category_blog_sidebar'];

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

$blog_hide_comments = "";
if (isset($qode_options_passage['blog_hide_comments'])) 
	$blog_hide_comments = $qode_options_passage['blog_hide_comments'];

if(get_post_meta($id, "qode_title-height", true) != ""){
 $title_height = get_post_meta($id, "qode_title-height", true);
}else{
	$title_height = $qode_options_passage['title_height'];
}

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

if(get_post_meta($id, "qode_content-animation", true) != ""){
 $content_animation = get_post_meta($id, "qode_content-animation", true);
}else{
	if(isset($qode_options_passage['content_animation'])){
		$content_animation = $qode_options_passage['content_animation'];
	}else{
		$content_animation = 'yes';
	}
}

?>
	<div class="title animate <?php if($content_animation == 'no'){ echo 'no_entering_animation '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes"){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no"){ echo 'has_background'; } if($responsive_title_image == 'yes'){ echo 'with_image'; } ?>" <?php if($responsive_title_image == 'no' && $title_image != ""){ echo 'style="background-image:url('.$title_image.'); height:'.$title_height.'px;"'; }?>>
			<?php if($responsive_title_image == 'yes' && $title_image != ""){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>	
	
				<?php if($title_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
				<?php } ?>

				<?php if ( function_exists('yoast_breadcrumb') ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>

				<h1>Case Result Categories</h1>
				<?php if($title_in_grid){ ?>
					</div>
				</div>
				<?php } ?>
	</div>
	
	
		<div class="container top_move <?php if($content_animation == 'no'){ echo 'no_entering_animation'; }  ?>">

			<div class="textpanel" id="case_results_intro"><div class="container_inner">

				<div class="content_width_75">
					<p class="intro_text_gold">The Columbus criminal defense team represents clients in the central Ohio area charged with OVI / DUI and most any other criminal offense(s). We are mindful of the fact that every time we enter a courtroom on behalf of our clients, there is a great deal at stake. Please review our criminal and OVI / DUI case results listed below. We are proud of the work we do and the lives we effect each day. If you are in need of assistance, please feel free to contact us at <span class="ibp">(614) 500-3836</span.</p>
				</div>

			</div></div>

		<div class="container_inner clearfix" id="topics-quick-link">
			<div class="container_inner2 clearfix">

				<?php if(($sidebar == "default")||($sidebar == "")) : ?>

					
					<div class="two_columns_33_66 clearfix"> <!-- 2 columns start -->
						<div class="column1"><div class="column_inner">
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('SidebarPage') ) :   endif; ?>
						</div></div>

					<div class="column2"><div class="column_inner">
							<div class="blog_holder">
								<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
									<article>
										
										<div class="post_text_holder">
											<div class="post_text_inner">

												<span class="result_date"><?php the_time('F jS, Y'); ?></span>

												<h4><?php the_title(); ?></h4>
												<span class="create">
													Categories: <span class="category"><?php echo get_the_term_list( $post->ID, 'topics', '', ', ', '' ); ?></span>
												</span>
												<?php the_content(); ?>

												
											</div>
										</div>	
									</article>
								<?php endwhile; ?>
								<div class="pagination"><?php postali_paging_nav(); ?></div>
								<?php else: //If no posts are present ?>
									<div class="entry">                        
											<p><?php _e('No posts were found.', 'qode'); ?></p>    
									</div>
								<?php endif; ?>
							</div>
					 
					</div>
				</div>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
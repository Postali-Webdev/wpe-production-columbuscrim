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
							
					<h1>404 - Page Not Found</h1>
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
						
  						<div class="page_not_found">

  							     <img src="/wp-content/uploads/2018/03/404.png" alt="404 Page not found">  
                       								                       								
                                <div class="content_width_75">   
                                                    
    						<p>Our apologies, but the page you requested could not be found.</p>
                           
                            <h3>Maybe these links are what you are looking for?</h3>
                            
<ul>
<li><a href="/criminal-defense-overview/" title="Criminal Defense Overview">Criminal Defense Overview</a></li>
<li><a href="/ovi-dui-defense/" title="Columbus DUI Defense Lawyers">DUI / OVI</a></li>
<li><a href="/driving-under-suspension/" title="Driving Under Suspension">Driving Under Suspension</a></li>
<li><a href="/alcohol-offenses/" title="Alcohol-Related Offenses">Alcohol Offenses</a></li>
<li><a href="/drug-offenses/" title="Columbus Drug Charges">Drug Charges</a></li>
<li><a href="/theft-fraud-crimes/" title="Theft and Fraud Crimes">Theft & Fraud Charges</a></li>
<li><a href="/domestic-violence-assault/" title="Domestic Violence and Assault Charges">Domestic Violence & Assault Charges</a></li>
</ul>
                            
                            <p>If not, we suggest you head <a href="/" title="Head back home">Back Home</a> and try again.</p>
                               	</div>
                                
								
						</div>			

				</div>
			</div>
	<?php get_footer(); ?>			
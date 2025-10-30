<?php global $qode_options_passage; ?>
				
		</div>
	</div>
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('google-review-schema') ) : ?><?php endif; ?>
		

		<!-- footer contact widget -->
	<?php if ( !is_page(19)) : ?>
<div class="footer_contact"><div class="container_inner">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-contact') ) : ?><?php endif; ?>
	</div></div>
	<?php endif; ?>


	<?php if (is_single()) { ?>
		<div class="blog-cta mobile-show">
			<a href="tel:614-500-3836"><img src="/wp-content/uploads/2021/09/phone-icon.svg" title="phone icon"> <strong>Call Now</strong> (614) 500-3836</a>
		</div>
	<?php } ?>

		<footer>
			
		<!-- Google font call -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i,500,600,700" rel="stylesheet">
			
			<div class="footer_holder clearfix">
				
					
						<?php	
						$display_footer_widget = false;
						if ($qode_options_passage['footer_widget_area'] == "yes") $display_footer_widget = true;
						if($display_footer_widget): ?> 
						<div class="footer_top_holder">
							<div class="footer_top">
								
								
									<?php
										$header_in_grid = false;
										if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

									?>
									

										<div class="container">
											<div class="container_inner clearfix">

									<div class="footer_top_inner">
										<div class="two_columns_50_50 clearfix">
											<div class="column1">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_1' ); ?>
                                                    <?php if(is_page(84)) { ?>
                                                    <a href="https://www.postali.com" title="Site design and development by Postali" target="blank"><img src="https://www.postali.com/wp-content/themes/postali-site/img/postali-tag-reversed.png" alt="Postali | Results Driven Marketing" style="display:block; max-width:250px; margin:17px 0;"></a>
                                                    <?php } ?>
                                                </div>
											</div>
											<div class="column2">

											<div class="two_columns_50_50 clearfix">
                                            
											<div class="column1">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_2' ); ?>
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_3' ); ?>
												</div>
											</div></div>
												
											<?php dynamic_sidebar( 'footer_column_4' ); ?>
												
											</div>
										</div>
									</div>

										</div>
									</div>
								
							</div>
						</div>
						<?php endif; ?>
						
						<?php
						$display_footer_text = false;
						if (isset($qode_options_passage['footer_text'])) {
							if ($qode_options_passage['footer_text'] == "yes") $display_footer_text = true;
						}
						if($display_footer_text): ?>
						<div class="footer_bottom_holder">
							<div class="footer_bottom">
								<?php dynamic_sidebar( 'footer_text' ); ?>
							</div>
						</div>
						<?php endif; ?>
			</div>
		</footer>
</div>
<?php 

global $qode_toolbar;
if(isset($qode_toolbar)) include("toolbar.php")
?>
	<?php wp_footer(); ?>
<script type="text/javascript" src="//cdn.callrail.com/companies/903391720/8e7addc64e8edbb35e80/12/swap.js"></script> 

<script>(function (w,d,s,v,odl){(w[v]=w[v]||{})['odl']=odl;;
var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=true;
j.src='https://intaker.azureedge.net/widget/chat.min.js';
f.parentNode.insertBefore(j,f);
})(window, document, 'script','Intaker', 'luftmanheck');
</script>

</body>
</html>
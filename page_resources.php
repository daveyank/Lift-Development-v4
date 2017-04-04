<?php 
//* Template Name: Resources * //


/** Force full-width layout **/
add_filter('genesis_pre_get_option_site_layout', 'lift_fullwidth_layout');


//* Get page's custom header *//
add_action('genesis_after_header', 'lift_page_header');



//* Add custom content for the page *//
add_action('genesis_after_loop', 'lift_resource_page');

function lift_resource_page() {	
	
		
	// Check if the repeater field has rows of page sections
	if( have_rows('resource_sections') ):
	
		?>
		
		<div class="lift-resources">
	
		<?php
			
		$first = 'first';
		
	 	// loop through the rows of data
	    while ( have_rows('resource_sections') ) : the_row();
	    	
			?>
			
			<div class="lift-resource-section one-half <?php echo $first; ?>">
			
				<h4 class="lift-resource-section-title"><?php the_sub_field('resource_section_name'); ?></h4>
				
				<div class="lift-resource-section-desc"><?php the_sub_field('resource_section_description'); ?></div>
				
				<?php  
					
				// check if the repeater field has rows of data
				if( have_rows('resources') ):
				?>
					<ul class="lift-resource-list">
						
					<?php
				 	// loop through the rows of data
				    while ( have_rows('resources') ) : the_row(); 
				    
				    	$img1 = get_sub_field("resource_icon");
						$src1 = '';
						
						if ($img1) {
							$src = wp_get_attachment_image_src( $img1, 'headshot', true ); 
							$src1 = $src[0];
						} else {
							$src1 = 'http://getflywheel.com/wp-content/themes/flywheel15/favicon.png';
						}
				    ?>
				
						<li>
							<div class="lift-resource-icon">
								<img src="<?php echo $src1; ?>" />
							</div>
							
							<div class="lift-resource-details">
								<a class="lift-resource-title" href="<?php the_sub_field('resource_url'); ?>" target="_blank"><?php the_sub_field('resource_name'); ?></a>
								<div class="lift-resource-desc">
									<?php the_sub_field('resource_description'); ?>
								</div>
							</div>
							
						</li>
						
					<?php  			    
				    endwhile;
				    ?>
				    
					</ul>
					
				<?php
				endif;
				?>
			
			</div>
			
		<?php	
			
			if ($first == 'first') {
				$first = '';
			} else {
				$first = 'first';
			}
			
	    endwhile;
	
		?>
		
		</div>
		
	<?php	
	endif;		

} 



genesis();
<?php
//* Template Name: Work *//
 
 
//* Force full-width layout *//
add_filter('genesis_pre_get_option_site_layout', 'lift_fullwidth_layout');


//* Add page's custom header *//
add_action('genesis_after_header', 'lift_page_header');



//* Add custom content for the page *//
add_action('genesis_after_loop', 'lift_portfolio_page');

function lift_portfolio_page() {
	
?>

	<div id="development-projects" class="row">
	
		
		
		<?php

			wp_reset_postdata();
			
		    global $post;
		    				
					    
			// Set up the arguments for retrieving the pages
			$args = array(
			    'post_type' => 'works',
			    'numberposts' => 100,
			    'post_status' => null,
			    'order' => 'DESC',
			    'orderby' => 'date',
			    );
			 $subpages = get_posts($args);
			 $x = 1;
			 
			 foreach($subpages as $post) :
			 	setup_postdata($post);
			 	$custom = get_post_custom($post->ID);
			 	
			 ?>
			 
			 
			 	<div class="lift-project one-half <?php if ($x==1) { echo 'first'; } ?>" style="text-align: center;">
					
					
					<div class="lift-project-image"><a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a></div>
					<div class="lift-project-details">
						
						<h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
							
						<div class="lift-project-haiku">
							<?php echo get_field('project_haiku'); ?>
						</div>
						
						 
					</div>
					
				</div>
				
		      	
		      	
		      	<?php 
			    $x++; 
		      	if ($x==3) { 
			    	$x=1; 
			    } 
		      	
		      	wp_reset_postdata();
		      	?>
		      
		    	      
		    <?php endforeach; 
		    
		    ?>


	</div>

<?php } 
 
genesis();

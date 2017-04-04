<?php
/**
 * Template Name: Clients
 * This file handles quote listings within a page.
 *
 */
 
 /** Add custom content for the page **/
add_action('genesis_after_header', 'lift_page_header');



/** Add custom content for the page **/
add_action('genesis_loop', 'lift_clients_page');
function lift_clients_page() {
	
?>

	<div id="lift-interior-quotes">
		
		
		<?php

			wp_reset_postdata();
			
		    global $post;
		    
		    
		    
			// Set up the arguments for retrieving the pages
			$args = array(
			    'post_type' => 'quotes',
			    'numberposts' => 100,
			    'post_status' => null,
			    'order' => 'DESC',
			    'orderby' => 'date',
			    //'meta_key' => 'ecpt_featuredclient',
			    //'meta_value' => 'On'
			    );
			 $subpages = get_posts($args);
			 $x = 1;
			 
			 foreach($subpages as $post) :
			 	
			 	setup_postdata($post);
			 	$clientname = get_post_meta($post->ID,'ecpt_clientname', $single='True');
			 	$clientcompany = get_post_meta($post->ID,'ecpt_clientcompany', $single='True');
			 	$clienturl = get_post_meta($post->ID,'ecpt_clienturl', $single='True');
			 	$clientlocation = get_post_meta($post->ID,'ecpt_clientlocation', $single='True');
			 	
			 	$clientemail = get_field('gravatar_email');
			 ?>
			 
			 	<div class="lift-interior-quote">
					<div class="quote-body"><?php the_content($post); ?></div>
					
					<div class="quote-image">
						
						<?php
						if ( has_post_thumbnail($post->ID)) { ?>
							<?php the_post_thumbnail('headshot'); ?>
						<?php
						}
						elseif (lift_validate_gravatar($clientemail)) {
							echo get_avatar( $clientemail, 80 ); 
						}
						?> 
						
					</div>
					<div class="quote-credentials">
						<div class="quote-author"><?php echo $clientname; ?></div>
						<div class="quote-company"><?php echo $clientcompany; ?></div>
						<div class="quote-location"><?php echo $clientlocation; ?></div>
					</div>
					
					<div class="clearfix"></div>
					
				</div>
				
		      	
		      	<?php $x++; 
		      	if ($x==3) { $x=1; } 
		      	
		      	wp_reset_postdata();
		      	?>
		      
		    	      
		    <?php endforeach; 
		    	
		    ?>

	</div>

<?php } 
 
genesis();

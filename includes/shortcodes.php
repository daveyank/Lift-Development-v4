<?php

//* Shortcode for showing the list of Lift Development clients *//
add_shortcode('lift-clients', 'lift_client_list');

function lift_client_list() {	
	
	ob_start();
	
?>
	<div class="lift-client-shortcode">
		
		<div class="lift-client-list">
		<?php
			
			// Set up the arguments for retrieving the clients.
			$args1 = array(
			    'post_type' => 'client',
			    'numberposts' => 10000,
			    'post_status' => 'publish',
			    'order' => 'ASC',
			    'orderby' => 'title', 
			);	
			    
			 
			$liftclients = get_posts($args1);
			
			$column = 1;
			
			
				
			 foreach ( $liftclients as $row ) :
				
				wp_reset_postdata();
				global $post;
						    
			 	$post = get_post($row->ID);
			 	setup_postdata($post);
			 	
			 	//$eventdate =  get_post_meta($post->ID,'ecpt_eventdate', 'True');
			 	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium', true );
			 	
			 	
			 	$columnclass='';
			 	
			 	
			 ?>
			 	
			 	<div class="lift-client <?php echo $catlist; ?>">
					
					<?php if(get_field('client_url')) { ?><a href="<?php echo get_field('client_url'); ?>" target="_blank"><? } ?><img src="<?php echo $src[0]; ?>" /><?php if(get_field('client_url')) { ?></a><?php } ?>	
							
				</div>
			
				
		 
		<?php 
			endforeach; 			
			
		?>
		</div>
			
	</div>

<?php 
	
	$output = ob_get_clean();
	return $output;
	
}

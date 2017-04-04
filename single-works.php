<?php
	

/** Remove standard loop from the page **/
remove_action('genesis_loop', 'genesis_do_loop');
	
	
/** Add custom content for the page **/
add_action('genesis_loop', 'lift_do_work');

function lift_do_work() {
	
	global $post;
	setup_postdata($post);
	
	?>
	
		<div class="lift-project">
					
					
			<div class="lift-project-image">
				<?php the_post_thumbnail('full'); ?>
			</div>
			
			<div class="lift-project-details">
				
				<div class="lift-project-header">
					
					<h4><?php the_title(); ?></h4>	
						
					
					<h6>Project Summary</h6>
					
				</div>
				
				<div class="lift-project-description">
					<?php the_content(); ?>
					
					<div class="lift-project-url">
						<i class="fa fa-globe" aria-hidden="true"></i> <a href="<?php echo get_field('ecpt_websiteurl'); ?>" target="_blank">Visit the website</a>
					</div>	
					
				</div>	
				
				
				
				
				 
			</div>
			
		</div>
		
	<?php
}	
	
genesis();

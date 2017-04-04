<?php
//* Template Name: Blog *//
 

//* Force full-width layout *//
add_filter('genesis_pre_get_option_site_layout', 'lift_fullwidth_layout');

//* Remove the standard loop *//
remove_action ('genesis_loop', 'genesis_do_loop'); 

//* Add custom loop *//
add_action( 'genesis_loop', 'lift_blog_do_loop' ); 

//* Remove Title and Description on Blog Template Page *//
remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );

//* Get page's custom header *//
add_action('genesis_after_header', 'lift_page_header');


//* Customize search form input box text *//
add_filter( 'genesis_search_text', 'ac_search_text' );
function ac_search_text( $text ) {
	return esc_attr( 'Search the blog...' );
}



function lift_blog_do_loop() {
	?>
	
	<?php the_content(); ?>
		
	<?php

	//* Category sorting, not currently being used
	$cat = '';
	
	if ($_GET['cat']) { 
		$cat = $_GET['cat'];
	}
	
	

	//* Get blog posts
	$args = wp_parse_args(
		genesis_get_custom_field( 'query_args' ),
		array(
		'post_type'   => 'post',
		'post_status' => 'publish',
		'paged'       => get_query_var( 'paged' ),
		'category_name' => $cat )
		
	);


	global $wp_query;
	$wp_query = new WP_Query( $args );

	if ( have_posts() ) : ?>
	
		<div class="lift-blog-section">
		
		<?php
			
		$firstclass = 'first'; 
		
		while ( have_posts() ) : the_post(); 
		
			setup_postdata($post);
			
			
			$imagestyle = 'background:#333;';
			
			
			if ( has_post_thumbnail($post->ID) ) {
				$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium', true);
				$imgurl = $src[0];
				$imagestyle = 'background-image:url(' . $imgurl . ');';
			} 
			
			
			
		 	
			?>
			
			<div class="lift-post one-half <?php echo $firstclass; ?>">
							 
			 	<div class="lift-post-container">
				 	
				 	<div class="lift-post-underlay" style="<?php echo $imagestyle; ?>">
					 	
				 	</div>
				 	
				 	<div class="lift-post-overlay">
					 
				 		<a href="<?php the_permalink($post); ?>" class="post-hyperlink">
					 		
					 		<div class="lift-post-details">							
				     			<h4 class="post-title"><?php echo get_the_title($post); ?></h4>
				     	
					 			<div class="post-info"><?php echo get_the_date(); ?></div>
					 		</div>
				    	</a>
				 	</div>
				 	
				 					
			 	</div>
			 	
		      
			 </div> 
			
			<?php
			
			wp_reset_postdata();
			
			if ($firstclass == 'first') {
				$firstclass = '';
			} else {
				$firstclass = 'first';
			}
 
		endwhile;
		?>
		</div>
		<div class="clearfix"></div>
		
		<?php
		do_action( 'genesis_after_endwhile' );
	endif;
	

	wp_reset_query();
}



genesis();
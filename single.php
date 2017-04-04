<?php


//* Get post's custom header *//
add_action('genesis_after_header', 'lift_page_header');


//* Remove the entry meta in the entry header (requires HTML5 theme support) *//
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Add custom call-to-action at the end of the post *//
add_action('genesis_after_entry_content', 'lift_blog_cta');
function lift_blog_cta() {
	
	if (get_field('post_cta_url')) {
	?>
	
	<div class="lift-blog-cta">
		<div class="lift-blog-cta-wrap">
			
			<div class="lift-blog-cta-image">
				<?php
				if (get_field('post_cta_image')) {
					$src = wp_get_attachment_image_src( get_field("post_cta_image"), 'full', true ); 
					?>
					<a href="<?php echo get_field('post_cta_url'); ?>" target="_blank" rel="nofollow">
						<img src="<?php echo $src[0]; ?>" />
					</a>
				<?php
				}
				?>
			</div>
			
			<div class="lift-blog-cta-content">
				
				<h4 class="lift-blog-cta-headline"><?php echo get_field('post_cta_headline'); ?></h4>
				
				<?php echo get_field('post_cta_text'); ?>
				
				<a class="lift-blog-cta-link" href="<?php echo get_field('post_cta_url'); ?>" target="_blank" rel="nofollow">Learn more</a>
				
			</div>
			
			
			
			<div class="clearfix"></div>
			
		</div>
	</div>	
	
	<?
	}
}


//* Remove the Edit Comment link. Use the dashboard for that *//
add_filter ( 'genesis_edit_comment_link' , '__return_false' );


genesis();
<?php
	
//* Get page's custom header *//
add_action('genesis_after_header', 'lift_page_header');

//* Force full-width layout *//
add_filter('genesis_pre_get_option_site_layout', 'lift_fullwidth_layout');


//* Remove default loop *//
remove_action( 'genesis_loop', 'genesis_do_loop' );

//* Add custom page content *//
add_action( 'genesis_loop', 'lift_genesis_404' );
function lift_genesis_404() { 
?>

	
		<article class="post-5 page type-page status-publish entry" itemscope="itemscope" itemtype="http://schema.org/CreativeWork" style="min-height:400px;">
			
			
			<div class="entry-content" itemprop="text">
				<p style="text-align: center;">Sorry about that. Double-check the requested URL and try again.</p>
				<p style="text-align: center;">If all else fails, go back to the <a href="<?php echo get_bloginfo('url'); ?>">home page</a>.</p>
			</div>

		</article>


<?php
}

genesis();
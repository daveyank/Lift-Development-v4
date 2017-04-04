<?php
		
//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'lift_post_info_filter' );
function lift_post_info_filter($post_info) {
	$post_info = '[post_date]';
	return $post_info;
}


//* Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );	
	
genesis();
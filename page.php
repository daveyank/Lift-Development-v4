<?php
		
//* Get page's custom header *//
add_action('genesis_after_header', 'lift_page_header');

//* Add extra content to end of page that is full-width *//
add_action('genesis_after_content', 'lift_extra_content');

function lift_extra_content() {
	if ( get_field('extra_full-width_content')) {
	?>
		<div class="clearfix"></div>
		<div class="lift-extra-content">
			<?php echo get_field('extra_full-width_content'); ?>
		</div>
	<?php
		
	}
}

genesis();
<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Remove the edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );

//* Disable admin bar
add_filter( 'show_admin_bar', '__return_false' );


/** Get Custom includes **/
require(CHILD_DIR.'/includes/custom-post-types.php');
require(CHILD_DIR.'/includes/shortcodes.php');



//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'lift_enqueue_scripts' );
function lift_enqueue_scripts() {
	
	// Google Web Fonts
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Roboto:300,400,400i,500,700,700i', array(), CHILD_THEME_VERSION );
	
	//Font Awesome
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), '4.2.0' );
	
	//jQuery Maximage plugin:
	wp_enqueue_script( 'jquery-maximage', CHILD_URL . '/scripts/jquery.maximage.min.js', array(), PARENT_THEME_VERSION );
	wp_enqueue_style( 'jquery-maximage-style', CHILD_URL . '/css/jquery.maximage.min.css', array(), PARENT_THEME_VERSION );
	
	
	//jQuery Slicknav
	wp_enqueue_style( 'jquery-slicknav-style', get_bloginfo('stylesheet_directory') . '/scripts/slicknav.css', array(), '1.0.7'  );
	wp_enqueue_script( 'jquery-slicknav', get_bloginfo('stylesheet_directory') . '/scripts/jquery.slicknav.min.js',  array(), '1.0.7'  );
	
	
	//Gravity Forms styling
	wp_enqueue_style( 'gf-styles-lift', CHILD_URL . '/css/gravity-styles-lift.css', array(), PARENT_THEME_VERSION );
	
	
	//Disable Superfish
	wp_deregister_script( 'superfish' );
	wp_deregister_script( 'superfish-args' );
	
}

	
	
//* Add scripts after opening <body> tag:
// UPDATE - 4/20/17 - removing the pre-loader for now. Some of the pages like the Portfolio/Work are getting larger & that pre-load will take longer. Instead look at some sort of lazy loader for loading images that are above the fold.
//add_action( 'genesis_before', 'lift_opening_scripts' );
function lift_opening_scripts() {
	?>
	
	<script type="text/javascript">			

		$=jQuery;
		
		
		// Show pre-loader while page is loading
		// Wait for window load
		$(window).load(function() {
			// Animate loader off screen
			$(".se-pre-con").fadeOut("slow");;
		});

		 
	</script>
	
	<div class="se-pre-con"></div>
	
<?php
}
	

//* Add scripts to end of page:
add_action( 'genesis_after', 'lift_after_scripts' );
function lift_after_scripts() {
	?>
	<script type="text/javascript">			

		$=jQuery;
		
		$(function(){
			$('#menu-main-menu').slicknav();
		});

		 
	</script>

<?php }
	

//* Unregister un-used Genesis site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
	


//* Add custom image sizes
add_image_size( 'icon', 32, 32, FALSE );
add_image_size( 'headshot', 80, 80, TRUE );
add_image_size( 'page-header', 1920, 900, TRUE );



//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


//* Full-width layout:
function lift_fullwidth_layout($opt) {
    $opt = 'full-width-content';
    return $opt;
}

//* Content-sidebar layout:
function lift_content_sidebar_layout($opt) {
    $opt = 'content-sidebar';
    return $opt;
}

//* Sidebar-content layout:
function lift_sidebar_content_layout($opt) {
    $opt = 'sidebar-content';
    return $opt;
}


//* Custom footer copyright text:
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'lift_custom_footer' );
function lift_custom_footer() {
	echo '&copy; ' . date('Y') . ' Lift Development LLC. All rights reserved. <a href="' . get_bloginfo('url') . '/credits">CREDITS</a>';
}


function lift_page_header() {

	global $post;
	
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'page-header' );
	
	$imageurl = '';
	
	if ( has_post_thumbnail( $post->ID ) || is_singular('post') || is_404() ) {
		
		
		$imageurl = $image[0];
		
		if ( !is_page_template( 'page_blog.php' ) ) {
			remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		}	
		
		if ( is_404() ) {
			$imageurl = get_bloginfo('stylesheet_directory') . '/images/plane-wreck.jpg';
		}
		
	?>
		
		<div class="lift-page-header">
			<div class="lift-page-header-background" style="<?php if ($imageurl) { ?>background-image: url(<?php echo $imageurl; ?>);<?php } ?>">
				
			</div>
			<div class="lift-page-header-overlay">
				<div class="wrap">
				
					<div class="lift-page-header-content">
						<h1>
							<?php if (get_field('page_title')) { 
								echo get_field('page_title');
							} elseif ( is_404() ) {
								echo 'Page not found';
							} else {
								echo get_the_title($post->ID);
							} 
							?>
						</h1>
						
						<?php if (get_field('page_subtitle')) { ?>
							<h3><?php echo get_field('page_subtitle'); ?></h3>
						<?php } ?>
						
						<?php if ( is_singular('post') ) { ?>
							<h3><?php echo get_the_date(); ?></h3> 
						<?php } ?>
						
						<?php if ( is_404() ) { ?>
							<h3>Oops! It looks like something went wrong.</h3> 
						<?php } ?>
					
					</div>
				</div>
			</div>
		</div>

	<?php
	}

}




// Check for valid Gravatar image, not just a placeholder image:
function lift_validate_gravatar($email) {
	
	// Craft a potential url and test its headers
	$hash = md5(strtolower(trim($email)));
	$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
	
	$headers = @get_headers($uri);
	
	$siteurl = get_bloginfo('url');
	$avatarurl = get_avatar( $email, 200 );
	
	// First, check if it's a local avatar
	if ( strpos($avatarurl, $siteurl) !== false ) {
		$has_valid_avatar = TRUE;
	}
	// Next, check if Gravatar returns a not-found response
	elseif (!preg_match("|200|", $headers[0])) {
		$has_valid_avatar = FALSE;
	}
	// Otherwise it's a legit Gravatar
	else {
		$has_valid_avatar = TRUE;
	}
	
	return $has_valid_avatar;
}



// Add ACF Options page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title'=>'Lift Options',
		'capability'	=> 'edit_posts'
	));

}


add_action('genesis_before', 'lift_opening_body_scripts');
function lift_opening_body_scripts() {
	
	if (get_field('opening_body_scripts', 'option')) { 
	?>
	
		<?php echo get_field('opening_body_scripts', 'option'); ?>
		
	<?php
	}
	
}





// Redirect all requests for "Clients" & "Quotes" post types:
add_action( 'template_redirect', 'lift_redirect_clients' );
function lift_redirect_clients() {
  $queried_post_type = get_query_var('post_type');
  if ( is_single() && ('client' ==  $queried_post_type || 'quotes' ==  $queried_post_type) ) {
	  $url = get_bloginfo('url') . '/clients';
	  wp_redirect( $url, 301 );
	  exit;
  }
}



/**
* Conditional function to check if post belongs to term in a custom taxonomy.
*
* @param    tax        string                taxonomy to which the term belons
* @param    term    int|string|array    attributes of shortcode
* @param    _post    int                    post id to be checked
* @return             BOOL                True if term is matched, false otherwise
*/
function pa_in_taxonomy($tax, $term, $_post = NULL) {
	// if neither tax nor term are specified, return false
	if ( !$tax || !$term ) { return FALSE; }
	// if post parameter is given, get it, otherwise use $GLOBALS to get post
	if ( $_post ) {
	$_post = get_post( $_post );
	} else {
	$_post =& $GLOBALS['post'];
	}
	// if no post return false
	if ( !$_post ) { return FALSE; }
	// check whether post matches term belongin to tax
	$return = is_object_in_term( $_post->ID, $tax, $term );
	// if error returned, then return false
	if ( is_wp_error( $return ) ) { return FALSE; }
	return $return;
}


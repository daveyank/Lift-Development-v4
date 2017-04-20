<?php 
//* Template Name: Home *//


//* DEVELOPER'S NOTE: This page is a work-in-progress, and some content is hard-coded into the template. This is not something I'd ever do on a client site, but since I can easily edit my own theme files, hard-coding the content helped get this launched on time. Eventually everything will be dynamic and hooked up to various custom fields in WordPress. *//


//* Force full-width layout *//
add_filter('genesis_pre_get_option_site_layout', 'lift_fullwidth_layout');


//* Add  scripts to head:
add_action( 'genesis_before', 'lift_home_head_scripts' );
function lift_home_head_scripts() {
	?>
	<script type="text/javascript">
		
		$=jQuery;
		
		$(function(){
		 	// Helper function to Fill and Center the HTML5 Video
		 	$('video,object').maximage('maxcover');
		});
		
		
		//Initial load of page
		$(document).ready(sizeContent);

		//Every resize of window
		$(window).resize(sizeContent);
		
		//Dynamically assign height
		function sizeContent() {
			
		    var newHeight = $(window).height();
		    
		    if ( $(window).width() > 1023 ) {
		    	$(".full-height").css("height", newHeight);
		    } else {
			    $(".full-height").css("height", null);
		    }
		}	
		
		
		
		$(document).ready(function(){	
				
			var header = $('.site-header'),
			pos = header.offset();
			
			var homelogo = $('.lift-home-feature .wrap');
			
			
			
			
			$(window).scroll(function () {
				
				if ( $(window).width() > 1023 ) {
				  if ( $(this).scrollTop() > 50 && ! header.hasClass('switchedHeader') ) {
				    
				    $(header).addClass('switchedHeader');
				    $('#lift-feature-center').addClass('switchedFeature');
				    
				   } else if ( $(this).scrollTop() <= 50 ) {
				    
				    $(header).removeClass('switchedHeader');
				    $('#lift-feature-center').removeClass('switchedFeature');
				    
				  }
			  	}
			  
			  
			  
			});
			
		});
		
		
				 
	</script>

<?php }






//* Add video & preloader to beginning of HTML
add_action( 'genesis_before', 'ci_home_open' );
function ci_home_open() {
	global $post;
	?>
	
	
	<?php 
		
		if ( !wonderplugin_is_device('Mobile') ) { 
		
	?>
	    
		<video id="ci-home-video" autoplay="" loop="loop" poster="<?php echo wp_get_attachment_url( get_post_meta($post->ID, 'placeholder_image', true)); ?>" width="1280" height="720">
			
			<source src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/background-video-lift-bw.mp4" type="video/mp4">
			
		</video>
		
		<div id="ci-video-overlay"></div>	
	
	<?php } else { ?>
		
		
		<?php 
			
		$src = wp_get_attachment_url( get_post_meta($post->ID, 'placeholder_image', true)); 
		
		?>
		
		<div id="ci-home-no-video" style="background-image: url(<?php echo $src; ?>);"></div> 
			
		
	<?php } ?>
	
<?php }



/** Remove standard loop from the home page **/
remove_action('genesis_loop', 'genesis_do_loop');

/** Add custom content for the home page **/
add_action('genesis_loop', 'lift_do_home');

function lift_do_home() { 
	global $post;
?>

	<div class="lift-home-feature  full-height" >
		<div class="wrap">
		
			<div id="lift-feature-center">
				<img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/logo-overdark.png" alt="logo" style="width:140px;height:auto;" />
				<h1>A friendly <strong>design</strong> + <strong>development</strong> company that creates custom web solutions on WordPress.</h1>
				<h5>Grand Rapids, Minnesota | Established 2007</h5>
			</div>
			
			
		</div>	
	</div>
	
	
	<div class="lift-home-intro lift-section">
		<div class="wrap">
			<h4 class="lift-section-title">Elevate your brand</h4>	
			<p>Your organization knows where it wants to be...maybe you just haven't figured out the "what" or "how" parts yet. That's where we come in. We'll work with you to take your ideas and build on them, resulting in an ever-changing website you can be proud of. You'll even be able to manage it yourself because, hey, WordPress allows you to do that!</p>
			
			<div class="one-third first">
				<i class="fa fa-desktop fa-2x"></i>
				<h2>Website Design</h2>
				<p>We'll craft a custom look & feel that you'll love.</p>
			</div>
			
			<div class="one-third">
				<i class="fa fa-code fa-2x"></i>
				<h2>Front-End Development</h2>
				<p>We'll turn your beautiful design into quality HTML5, CSS3, PHP, & jQuery code.</p>
			</div>
			
			<div class="one-third">
				<i class="fa fa-wordpress fa-2x"></i>
				<h2>WordPress Development</h2>
				<p>Manage your site's content & functionality directly through the world's best CMS.</p>
			</div>
			
			<div class="one-third first">
				<i class="fa fa-mobile fa-2x"></i>
				<h2>Responsive Layouts</h2>
				<p>Your website will adapt & look good on desktop, tablet, mobile...everywhere!</p>
			</div>
			
			<div class="one-third">
				<i class="fa fa-dashboard fa-2x"></i>
				<h2>Monitoring & Backups</h2>
				<p>We'll make sure your site is running well & your valuable data is archived & easily restored.</p>
			</div>
			
			<div class="one-third">
				<i class="fa fa-magic fa-2x"></i>
				<h2>Strategy & Support</h2>
				<p>We'll become an extended part of your team, working to constantly improve your presence.</p>
			</div>
			
		</div>
	</div>
	
	
	
	
	<div class="lift-section lift-clients">
		<div class="wrap">
			<h4 class="lift-section-title">We like who we work with</h4>	
			<p>While Lift Development is nestled among the towering pines of beautiful northern Minnesota, we are privileged to work with clients all over the country. Here are just a few of the awesome organizations we've helped:</p>
			
			<div class="lift-client-list">
			<?php
				
				// Set up the arguments for retrieving the clients.
				$args1 = array(
				    'post_type' => 'client',
				    'numberposts' => 10000,
				    'post_status' => 'publish',
				    'order' => 'ASC',
				    'orderby' => 'title',
					'meta_key' => 'featured_client',
				    'meta_value' => true   
				);	
				    
				 
				$liftclients = get_posts($args1);
				
				$column = 1;
				
				
					
				 foreach ( $liftclients as $row ) :
					
					wp_reset_postdata();
					global $post;
							    
				 	$post = get_post($row->ID);
				 	setup_postdata($post);
				 	
				 	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium', true );
				 	
				 	
				 ?>
				 	
				 	<div class="lift-client <?php echo $catlist; ?>">
						
						<?php if(get_field('client_url')) { ?><a href="<?php echo get_field('client_url'); ?>" target="_blank"><? } ?><img src="<?php echo $src[0]; ?>" /><?php if(get_field('client_url')) { ?></a><?php } ?>	
								
					</div>
				
					
			 
			<?php 
				endforeach; 			
				
			?>
			</div>
			
			
			
			<div class="lift-clients-cta">
				<a href="/clients">View more clients</a>
			</div>
			
			
			
		</div>
	</div>
	
	
	<div class="lift-section lift-testimonials">
		<div class="wrap">
			
				<?php
			    global $post;
				// Set up the arguments for retrieving the pages
				$args = array(
				    'post_type' => 'quotes',
				    'numberposts' => 3,
				    'post_status' => null,
				    'order' => 'DESC',
				    'orderby' => 'date',
				    'meta_key' => 'ecpt_featuredclient',
				    'meta_value' => true
				    );
				 $subpages = get_posts($args);
				 
				 foreach($subpages as $post) :
				 
				 	setup_postdata($post);
				 
				 	$clientname = get_post_meta($post->ID,'ecpt_clientname', $single='True');
				 	$clientcompany = get_post_meta($post->ID,'ecpt_clientcompany', $single='True');
				 	$clienturl = get_post_meta($post->ID,'ecpt_clienturl', $single='True');
				 	$clientlocation = get_post_meta($post->ID,'ecpt_clientlocation', $single='True');
				 	
				 	$clientemail = get_field('gravatar_email');
				 ?>
				 
				 	<div class="lift-quote">
				 		<div class="lift-quote-body"><?php the_content($post); ?></div>
						
						<div class="lift-quote-credentials">
							<div class="lift-quote-image">
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
							<div class="lift-quote-author">
								<?php echo $clientname; ?>
								<div class="lift-quote-company"><?php echo $clientcompany; ?></div>
								<div class="lift-quote-location"><?php echo $clientlocation; ?></div>
							</div>
						</div>
						<div class="clearfix"></div>
						
					</div>
			      
			    	      
			    <?php 
				    
				    wp_reset_postdata();
				    
				    endforeach; ?>
			
		</div>
	</div>
	
	
	<div class="lift-section lift-call-to-action">
		<div class="wrap">
			<h4 class="lift-section-title">Let's build something great together</h4>	
			
			<p>We'd love to help you out. Tell us about your needs.</p>
			
			<div class="lift-call-to-action-cta">
				<a href="/hire">Get started</a>
			</div>
			
		</div>
	</div>
	
		
<?php }


genesis();
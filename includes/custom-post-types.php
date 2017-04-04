<?php
	
//* Set up the Lift's custom post types & taxonomies *//

	//* registration code for Quote post type *//
	function register_quotes_posttype() {
		$labels = array(
			'name' 				=> _x( 'Quotes', 'post type general name' ),
			'singular_name'		=> _x( 'Quote', 'post type singular name' ),
			'add_new' 			=> __( 'Add New Quote' ),
			'add_new_item' 		=> __( 'Add New Quote' ),
			'edit_item' 		=> __( 'Edit Quote' ),
			'new_item' 			=> __( 'New Quote' ),
			'view_item' 		=> __( 'View Quote' ),
			'search_items' 		=> __( 'Search Quotes' ),
			'not_found' 		=> __( 'No Quotes found' ),
			'not_found_in_trash'=> __( 'No Quotes found in Trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Quotes' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','thumbnail','excerpt','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Quote'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> false,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'quotes', 'with_front' => true ),
			'supports' 			=> $supports,
			'menu_position' 	=> 20,
			'menu_icon' 		=> 'dashicons-thumbs-up',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('quotes',$post_type_args);
	}
	add_action('init', 'register_quotes_posttype');
	
	
	//* registration code for Works aka Projects post type *//
	function register_works_posttype() {
		$labels = array(
			'name' 				=> _x( 'Projects', 'post type general name' ),
			'singular_name'		=> _x( 'Project', 'post type singular name' ),
			'add_new' 			=> __( 'Add New Project' ),
			'add_new_item' 		=> __( 'Add New Project' ),
			'edit_item' 		=> __( 'Edit Project' ),
			'new_item' 			=> __( 'New Project' ),
			'view_item' 		=> __( 'View Project' ),
			'search_items' 		=> __( 'Search Projects' ),
			'not_found' 		=> __( 'No Projects found' ),
			'not_found_in_trash'=> __( 'No Projects found in Trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Projects' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','thumbnail','excerpt','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Project'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> false,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'work', 'with_front' => true ),
			'supports' 			=> $supports,
			'menu_position' 	=> 20,
			'menu_icon' 		=> 'dashicons-portfolio',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('works',$post_type_args);
	}
	add_action('init', 'register_works_posttype');
	
	
	
	//* registration code for Client post type *//
	function register_client_posttype() {
		$labels = array(
			'name' 				=> _x( 'Clients', 'post type general name' ),
			'singular_name'		=> _x( 'Client', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Client' ),
			'edit_item' 		=> __( 'Edit Client' ),
			'new_item' 			=> __( 'New Client' ),
			'view_item' 		=> __( 'View Client' ),
			'search_items' 		=> __( 'Search Clients' ),
			'not_found' 		=> __( 'No Clients found' ),
			'not_found_in_trash'=> __( 'No Clients found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Clients' )
		);
		
		$taxonomies = array();

		$supports = array('title','thumbnail');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Client'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> true,
			'show_in_nav_menus'	=> false,
			'capability_type' 	=> 'post',
			'has_archive' 		=> false,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'client', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 20,
			'menu_icon' 		=> 'dashicons-groups',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('client',$post_type_args);
	}
	add_action('init', 'register_client_posttype');
	
	
	//* registration code for WorkType taxonomy used by Works *//
		function register_worktype_tax() {
			$labels = array(
				'name' 					=> _x( 'Work Types', 'taxonomy general name' ),
				'singular_name' 		=> _x( 'Work Type', 'taxonomy singular name' ),
				'add_new' 				=> _x( 'Add New Work Type', 'Work Type'),
				'add_new_item' 			=> __( 'Add New Work Type' ),
				'edit_item' 			=> __( 'Edit Work Type' ),
				'new_item' 				=> __( 'New Work Type' ),
				'view_item' 			=> __( 'View Work Type' ),
				'search_items' 			=> __( 'Search Work Types' ),
				'not_found' 			=> __( 'No Work Type found' ),
				'not_found_in_trash' 	=> __( 'No Work Type found in Trash' ),
			);
			
			$pages = array('works','');
			
			$args = array(
				'labels' 			=> $labels,
				'singular_label' 	=> __('Work Type'),
				'public' 			=> true,
				'show_ui' 			=> true,
				'hierarchical' 		=> true,
				'show_tagcloud' 	=> false,
				'show_in_nav_menus' => false,
				'rewrite' 			=> array('slug' => 'worktype', 'with_front' => true ),
			 );
			register_taxonomy('worktype', $pages, $args);
		}
		add_action('init', 'register_worktype_tax');
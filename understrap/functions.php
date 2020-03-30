<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}


function my_logo() {
	$output = '';
	$output .= '<a class="navbar-brand" aria-label="home" href="'.get_home_url().'">';
	$custom_logo_id = get_theme_mod('custom_logo');
	$custom_logo_attr = '';
	if ($custom_logo_id) {
		$custom_logo_attr = array(
			'class' => 'custom-logo',
		);
		$image_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
		if (empty ($image_alt)) {
			$custom_logo_attr ['alt'] = get_bloginfo('name', 'display');
		}
	}
	$output .= wp_get_attachment_image($custom_logo_id, 'full', false, $custom_logo_attr) . '</a>';

	echo $output;
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	acf_add_options_sub_page('Footer');
}


// --------------------------Portfolio post type--------------------
function register_works_post_type() {
	$labels = array(
		'name'               => _x( 'Works', 'post type general name', 'understrap' ),
		'singular_name'      => _x( 'Work', 'post type singular name', 'understrap' ),
		'menu_name'          => _x( 'Work', 'admin menu', 'understrap' ),
		'name_admin_bar'     => _x( 'Work', 'add new on admin bar', 'understrap' ),
		'add_new'            => _x( 'Add New work', 'client', 'understrap' ),
		'add_new_item'       => __( 'Add New work', 'understrap' ),
		'new_item'           => __( 'New work', 'understrap' ),
		'edit_item'          => __( 'Edit work', 'understrap' ),
		'view_item'          => __( 'View work', 'understrap' ),
		'all_items'          => __( 'All works', 'understrap' ),
		'search_items'       => __( 'Search work', 'understrap' ),
		'parent_item_colon'  => __( 'Parent Work:', 'understrap' ),
		'not_found'          => __( 'No work in Work found.', 'understrap' ),
		'not_found_in_trash' => __( 'No work in Work found in Trash.', 'understrap' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Our Work.', 'understrap' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'work' ),
		'taxonomies'         => array ( 'category' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'thumbnail', 'editor'),
	);

	register_post_type( 'works', $args );
}
add_action( 'init', 'register_works_post_type' );



add_action( 'init', 'create_taxonomy_category' );
function create_taxonomy_category(){

	register_taxonomy( 'category', [ 'works' ], [ 
		'label'                 => __( 'Category', 'understrap' ),
		'labels'                => [
			'singular_name'     => 'Category element',
			'search_items'      => 'Search Category element',
			'all_items'         => 'All Categories element',
			'view_item '        => 'View Category element',
			'parent_item'       => 'Parent Category element',
			'parent_item_colon' => 'Parent Category element:',
			'edit_item'         => 'Edit Category element',
			'update_item'       => 'Update Category element',
			'add_new_item'      => 'Add New Category element',
			'new_item_name'     => 'New Genre Category element',
			'menu_name'         => 'Category element',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => false,
		'rewrite'               => true,
		'capabilities'          => array(),
	] );
}


function new_excerpt_more($excerpt) {
	return str_replace('[...]', ' ', $excerpt);
}
add_filter('wp_trim_excerpt', 'new_excerpt_more');
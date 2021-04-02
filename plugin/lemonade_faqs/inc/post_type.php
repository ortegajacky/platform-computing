<?php
function lemonade_create_faqs() {
	$labels = array(
		'name'                => 'Faqs',
		'singular_name'       => 'Faqs',
		'menu_name'           => 'Faqs',
		'parent_item_colon'   => 'Parent Faq:',
		'all_items'           => 'All Faqs',
		'view_item'           => 'View Faq',
		'add_new_item'        => 'Add New Faq',
		'add_new'             => 'New Faq',
		'edit_item'           => 'Edit Faq',
		'update_item'         => 'Update Faq',
		'search_items'        => 'Search Faqs',
		'not_found'           => 'No Faqs found',
		'not_found_in_trash'  => 'No Faqs found in Trash',
	);

	$args = array(
		'label'               => 'Faqs',
		'description'         => 'Faqs post type',
		'labels'              => $labels,
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'capability_type'     => 'page',
		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'page-attributes', 'editor'),
		'menu_icon' => plugins_url( 'lemonade_icon.png', __FILE__ ),
	);

	register_post_type( 'faqs', $args );
}
add_action( 'init', 'lemonade_create_faqs', 0 );
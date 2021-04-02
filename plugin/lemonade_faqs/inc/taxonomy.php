<?php
//Faq Type
function faq_type_init() {
	register_taxonomy(
		'faq_type',
		'faqs',
		array(
			'label' => __( 'Faq Type' ),
			'rewrite' => array( 
			'slug' => 'faq_type',
			),
		'hierarchical' => true,
		)
	);
}
add_action( 'init', 'faq_type_init' ); 
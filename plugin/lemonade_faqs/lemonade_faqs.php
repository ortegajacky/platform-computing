<?php
/*
Plugin Name: Faqs Custom Post Type - Lemonade Stand
Plugin URI: https://www.lemonadestand.org/
Description: Faqs custom post type.
Version: 1.0
Author: Lemonade Stand
Author URI: https://www.lemonadestand.org/
*/

include("inc/post_type.php");
include("inc/shortcodes.php");
include("inc/taxonomy.php");


/* rename labels */
function lemonade_faq_title_alter( $title ) {
    $screen = get_current_screen();
    if ( $screen->post_type == "faq") {
        $title = 'Enter Question Here';
    }
    return $title;
}
add_filter( 'enter_title_here', 'lemonade_faq_title_alter' );

/* register CSS */
function lemonade_faqs_scripts() {
    $plugin_url = plugin_dir_url( __FILE__ );

    //register slideshow css
    wp_register_style( 'faqsStyle', $plugin_url . 'inc/css/faqs.css' );
    wp_enqueue_style( 'faqsStyle' );

}
add_action( 'wp_enqueue_scripts', 'lemonade_faqs_scripts' );
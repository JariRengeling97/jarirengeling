<?php

function main_menu() {
    register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'main_menu' );

function css() {  
    // Register the style like this for a theme:  
    wp_register_style( 'main-style', get_template_directory_uri().'/style.css');  
    
    // enqueue the style
    wp_enqueue_style( 'main-style' );
}  
add_action( 'wp_enqueue_scripts', 'css' ); 

// Disable admin bar
add_filter('show_admin_bar', '__return_false');

// Thumbnails
add_theme_support( 'post-thumbnails' );

// Disable emoji's
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
add_filter( 'emoji_svg_url', '__return_false' );

// Disable WordPress version
remove_action('wp_head', 'wp_generator');

// Disable WP embed
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

// Disable RSD
remove_action ('wp_head', 'rsd_link');

// Disable short URL
remove_action( 'wp_head', 'wp_shortlink_wp_head');

// Disable manifest
remove_action( 'wp_head', 'wlwmanifest_link');

// Disable tinymce emoji
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

//Disable gutenberg style in Front
function wps_deregister_styles() {
    wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );

// Font
add_action('wp_head', 'youttheme_font_typekit');
//Add TypeKit Font Set
 function youttheme_font_typekit() {
 echo '<script src="https://use.typekit.net/lbd1qkc.css"></script>
<script>try{Typekit.load({ async: false });}catch(e){}</script>';
}

function wpb_add_google_fonts() {
    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Encode+Sans:300,400,500&display=swap', false ); 
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

// Big image disable resize
add_filter( 'big_image_size_threshold', '__return_false'); 
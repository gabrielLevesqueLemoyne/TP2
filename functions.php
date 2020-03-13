<?php

 add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version'));
        wp_enqueue_script( 'main_js', get_stylesheet_directory_uri() . 'js/main.js'); 
}


 add_action( 'wp_enqueue_scripts', 'enqueue_load_fa' );
 function enqueue_load_fa() {
 wp_enqueue_style( 'load-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
 }

/*
function extraire_evenement( $query ) {
 
   if (!is_home() && $query->is_category('evenement'))
   {
      $query->set( 'posts_per_page', -1 );
      $query->set( 'orderby', 'date' );
      $query->set( 'order', 'asc' );
   }
}
add_action( 'pre_get_posts', 'extraire_evenement' );

*/

function extraire_nouvelle( $query ) {

   if ($query->is_category('nouvelle'))
   {
      $query->set("posts_per_page" , 3);
   }
}
add_action( 'pre_get_posts', 'extraire_nouvelle' ); 
<?php
// This function enqueues the Normalize.css for use. The first parameter is a name for the stylesheet, the second is the URL. Here we
// use an online version of the css file.
function add_normalize_CSS() {
    wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
}
// Register a new sidebar simply named 'sidebar'
function add_widget_Support() {
    register_sidebar( array(
                    'name'          => 'Sidebar',
                    'id'            => 'sidebar',
                    'before_widget' => '<div>',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h2>',
                    'after_title'   => '</h2>',
    ) );
}
// Hook the widget initiation and run our function
add_action( 'widgets_init', 'add_Widget_Support' );

// Register a new navigation menu
function add_Main_Nav() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
  // Hook to the init action hook, run our navigation menu function
add_action( 'init', 'add_Main_Nav' );
// Register a new navigation menu for footer
function add_Footer_Nav() {
    register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
// Hook to the init action hook, run our footer navigation menu function
add_action( 'init', 'add_Footer_Nav' );
function add_custom_scripts() {
    // Enregistrer le script
    wp_register_script('custom-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
    
    // Charger le script
    wp_enqueue_script('custom-scripts');
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');
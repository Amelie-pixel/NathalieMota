<?php

function add_normalize_CSS() {
    wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
}


/// widget ///
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
add_action( 'widgets_init', 'add_Widget_Support' );


///Menu header ///

function add_Main_Nav() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'add_Main_Nav' );


/// Menu Footer ///

function add_Footer_Nav() {
    register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'add_Footer_Nav' );


/// Gesion des scripts ///

function add_custom_scripts() {
    wp_register_script('custom-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
    wp_register_script('lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), null, true);
    wp_enqueue_script('custom-scripts');
    wp_enqueue_script('lightbox');
}
add_action('wp_enqueue_scripts', 'add_custom_scripts');


// ajout image mise en avant //
add_theme_support( 'post-thumbnails' );

add_action('wp_ajax_custom_filter_photos', 'custom_filter_photos');
add_action('wp_ajax_nopriv_custom_filter_photos', 'custom_filter_photos');


/// Menu déroulant ///

function custom_filter_photos() {
    $nonce = isset($_GET['nonce']) ? $_GET['nonce'] : '';
    if (!wp_verify_nonce($nonce, 'custom_filter_nonce')) {
        wp_die('Invalid nonce');
    }

    $category = isset($_GET['category']) ? intval($_GET['category']) : 0;
    $format = isset($_GET['format']) ? intval($_GET['format']) : 0;
    $order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'date_desc';

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => isset($_GET['all_photos']) ? -1 : 8,
        'orderby' => 'date',
        'order' => ($order === 'date_asc') ? 'ASC' : 'DESC',
    );

    $tax_query = array();

    if ($category) {
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field' => 'term_id',
            'terms' => $category,
        );
    }

    if ($format) {
        $tax_query[] = array(
            'taxonomy' => 'formats',
            'field' => 'term_id',
            'terms' => $format,
        );
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    $all_photos = new WP_Query($args);

    if ($all_photos->have_posts()) {
        while ($all_photos->have_posts()) {
            $all_photos->the_post();
            get_template_part('templates-part/photo_block');
        }
    } else {
        echo 'Aucune photo trouvée';
    }

    wp_die();
}

add_action('wp_ajax_custom_filter_photos', 'custom_filter_photos');
add_action('wp_ajax_nopriv_custom_filter_photos', 'custom_filter_photos');


/// fichier css /////
function add_custom_styles() {
    wp_register_style('modal-styles', get_template_directory_uri() . '/css/modal.css', array(), null);
    wp_register_style('home-styles', get_template_directory_uri() . '/css/home.css', array(), null);
    wp_register_style('post-styles', get_template_directory_uri() . '/css/post.css', array(), null);
    wp_register_style('HeaderFooter-styles', get_template_directory_uri() . '/css/HeaderFooter.css', array(), null);
    wp_register_style('lightbox-styles', get_template_directory_uri() . '/css/lightbox.css', array(), null);
    wp_register_style('photo_block-styles', get_template_directory_uri() . '/css/photo_block.css', array(), null);
    wp_register_style('responsive-styles', get_template_directory_uri() . '/css/responsive.css', array(), null);


    wp_enqueue_style('modal-styles');
    wp_enqueue_style('home-styles');
    wp_enqueue_style('post-styles');
    wp_enqueue_style('lightbox-styles');
    wp_enqueue_style('HeaderFooter-styles');
    wp_enqueue_style('photo_block-styles');
    wp_enqueue_style('responsive-styles');
}
add_action('wp_enqueue_scripts', 'add_custom_styles');


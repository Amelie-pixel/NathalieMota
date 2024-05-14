<?php

// This function enqueues the Normalize.css for use. The first parameter is a name for the stylesheet, the second is the URL. Here we
// use an online version of the css file.
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
  // Hook to the init action hook, run our navigation menu function
add_action( 'init', 'add_Main_Nav' );

/// Menu Footer ///

function add_Footer_Nav() {
    register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'add_Footer_Nav' );

/// lightbox ///

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
    $format = isset($_GET['format']) ? $_GET['format'] : '';
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : '';
    $all_photos = isset($_GET['all_photos']) && $_GET['all_photos'] === 'true' ? true : false;


    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => $all_photos ? -1 : 8,
    );

    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'id',
            'terms' => $category,
            'operator' => 'IN',
        );
    }

    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'formats',
            'field' => 'id',
            'terms' => $format,
            'operator' => 'IN',
        );
    }

    if (!empty($order)) {
        if ($order === 'date_desc') {
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
        } elseif ($order === 'date_asc') {
            $args['orderby'] = 'date';
            $args['order'] = 'ASC';
        }
    }

    // Exécuter la requête WP_Query
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part( 'templates-part/photo_block' );
        }
        wp_reset_postdata();
    } else {
        echo '<p>Aucun résultat trouvé.</p>';
    }

    wp_die();
}

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

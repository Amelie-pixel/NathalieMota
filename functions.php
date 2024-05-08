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

// Ajouter le support des images mises en avant (post thumbnails)
add_theme_support( 'post-thumbnails' );

add_action('wp_ajax_custom_filter_photos', 'custom_filter_photos');
add_action('wp_ajax_nopriv_custom_filter_photos', 'custom_filter_photos');

function custom_filter_photos() {
    // Récupérer les valeurs du formulaire
    $format = isset($_GET['format']) ? $_GET['format'] : '';
    $category = isset($_GET['category']) ? $_GET['category'] : '';
    $order = isset($_GET['order']) ? $_GET['order'] : '';
    $all_photos = isset($_GET['all_photos']) && $_GET['all_photos'] === 'true' ? true : false;

    // Créer les arguments de la requête pour WP_Query en fonction des valeurs du formulaire
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => $all_photos ? -1 : 8,
    );

    // Si une catégorie est sélectionnée, ajoutez-la aux arguments de requête
    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'id',
            'terms' => $category,
            'operator' => 'IN',
        );
    }

    // Si un format est sélectionné, ajoutez-le aux arguments de requête
    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'formats',
            'field' => 'id',
            'terms' => $format,
            'operator' => 'IN',
        );
    }

    // Si un critère de tri est sélectionné, ajustez l'ordre des résultats
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

    // Afficher les résultats
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            // Afficher les résultats comme vous le souhaitez
            get_template_part( 'templates-part/photo_block' );
        }
        wp_reset_postdata();
    } else {
        echo '<p>Aucun résultat trouvé.</p>';
    }

    wp_die(); // Terminer la réponse Ajax
}





<?php get_header(); ?>
<main class="wrap">
<?php 
$random_image = get_posts(array(
    'post_type' => 'photos',
    'posts_per_page' => 1,
    'orderby' => 'rand',
));

if ($random_image) {
    $post = $random_image[0];
    $thumbnail_id = get_post_thumbnail_id($post->ID);
    $thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
}
?>
<div id="index" class="index_background" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
    <h1 class="title_photo_event">Photographe Event</h1>
</div>

<!-- Ajoutez la nonce ici -->
<script>
    var ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
    var nonce = '<?php echo wp_create_nonce('custom_filter_nonce'); ?>';
</script>

<form class="custom-select" id="filter-form">
    <div id="category-select" class="custom-dropdown">
        <span class="dropdown-placeholder">CATÉGORIES</span>
        <input type="hidden" name="category">
        <ul class="dropdown-list">
            <li data-value="">CATÉGORIES</li> <!-- Ajout du nom de la catégorie -->
            <?php
                $categories = get_terms(array(
                    'taxonomy' => 'categorie',
                    'hide_empty' => false,
                ));
                foreach ($categories as $category) {
                    echo '<li data-value="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</li>';
                }
            ?>
        </ul>
    </div>
    <div id="format-select" class="custom-dropdown">
        <span class="dropdown-placeholder">FORMATS</span>
        <input type="hidden" name="format">
        <ul class="dropdown-list">
            <li data-value="">FORMATS</li> <!-- Ajout du nom du format -->
            <?php
            $formats = get_terms(array(
                'taxonomy' => 'formats',
                'hide_empty' => false,
            ));
            foreach ($formats as $format) {
                echo '<li data-value="' . esc_attr($format->term_id) . '">' . esc_html($format->name) . '</li>';
            }
        ?>
        </ul>
    </div>
    <div id="order-select" class="custom-dropdown">
        <span class="dropdown-placeholder">TRIER PAR</span>
        <input type="hidden" name="order">
        <ul class="dropdown-list">
            <li data-value="">TRIER PAR</li> <!-- Ajout du nom du tri -->
            <li data-value="date_desc">Plus récentes</li>
            <li data-value="date_asc">Plus anciennes</li>
        </ul>
    </div>
</form>

<section class="photo_section flexcolumn">
    <div class="groupe">
      <?php
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $all_photos = new WP_Query($args);

        if ($all_photos->have_posts()) {
      ?>
      <div id="results-container" class="photo-box">
      <?php
            while ($all_photos->have_posts()) {
                $all_photos->the_post();
                get_template_part('templates-part/photo_block');
            }
      ?>
      </div>
      <?php
        }
        wp_reset_postdata();
      ?>
    </div>
    <div class="btn_chargerplus flexrow">
        <button id="load-more" class="charger_plus">Charger plus</button>
    </div>
</section>
</main>
<?php get_footer(); ?>

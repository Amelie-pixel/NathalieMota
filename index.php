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
<div id="index" class="index_background" style="background-image: url('<?php echo $thumbnail_url ?>');">
    <h1 class="title_photo_event">Photographe Event</h1>
</div>
<script>
    var ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
</script>

<form id="filter-form">
  <select id="category-select" name="category">
        <option value="">CATÉGORIES</option>
        <?php
            $categories = get_terms(array(
                'taxonomy' => 'categorie',
                'hide_empty' => false,
            ));
            foreach ($categories as $category) {
                echo '<option value="' . $category->term_id . '">' . $category->name . '</option>';
            }
        ?>
    </select>
    <select id="format-select" name="format">
        <option value="">FORMATS</option>
        <?php
            $formats = get_terms(array(
                'taxonomy' => 'formats',
                'hide_empty' => false,
            ));
            foreach ($formats as $format) {
                echo '<option value="' . $format->term_id . '">' . $format->name . '</option>';
            }
        ?>
    </select>
    <select id="order-select" name="order">
        <option value="">TRIER PAR</option>
        <option value="date_desc">Nouveauté</option>
        <option value="date_asc">Plus anciens</option>
    </select>
</form>
  <section class="photo_section flexcolumn ">

    <div class="groupe">

      <?php
        $args = array('post_type' => 'photos',
                      'posts_per_page' => '8',
                      'orderby' => 'date',
                      'order' => 'DESC');
        $all_photos = new wp_query($args);

        // The Loop
        if ( $all_photos->have_posts() ){
      ?>
      <div id="results-container" class="photo-box">
      <?php
        while ( $all_photos->have_posts() ) { 
            $all_photos->the_post();

            get_template_part( 'templates-part/photo_block' );

        };
      ?>
        </div>
      <?php  
        };
        wp_reset_query();
      ?>
      </div>

    <div class="btn_chargerplus flexrow">
      <button id="load-more"class="charger_plus">Charger plus</button>
    </div>

  </section>
</main>
<?php get_footer(); ?>

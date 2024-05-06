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
<section class="photo_section flexcolumn">

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
    <div class="photo-box flexrow">
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
    <button class="charger_plus">Charger plus</button>
  </div>

</section>
</main>
<?php get_footer(); ?>

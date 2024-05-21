<!-- Gestion des blocks photos -->
<div class="photo-block__picture flexrow">
    <div class="photo-block__picture__img_container">
        <!-- Ajout de la photo -->
        <img src="<?php the_post_thumbnail_url(); ?>" class="photo-block__picture__img">

        <!-- Ajout des informations des photos au survol -->
        <div class="photo-block__picture__img_hover">
            <div class="show_photo_icon" data-link="<?php echo get_permalink(get_the_ID()); ?>">
                <a href="<?php echo get_permalink(get_the_ID()); ?>">
                    <img class="oeil" src="<?php echo get_stylesheet_directory_uri() ;?>/assets/eye.svg" alt="Oeil">
                </a>
                <div class="fullscreen">
                    <img id="fullscreen" class=" open-lightbox" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/fullscreen.svg" alt="pleins écran" onclick="openLightbox('<?php the_post_thumbnail_url(); ?>', '<?php echo get_field('reference'); ?>', '<?php echo implode(', ', wp_list_pluck(get_the_terms(get_the_ID(), 'categorie'), 'name')); ?>')">
                </div>
            </div>
            <div class="ref_cat flexrow">
                <p class="photo_reference_hover">
                    <?php echo get_field('reference'); ?>
                </p>
                <p class="photo_categorie_hover">
                    <?php
                    $category = get_the_term_list(get_the_ID(), 'categorie');   
                    if ($category) {
                        echo strip_tags($category);
                    };
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="photo-block__picture">
    <div class="photo-block__picture__img_container">
        <img src="<?php the_post_thumbnail_url(); ?>" class="photo-block__picture__img">
        <div class="photo-block__picture__img_hover">
            <div class="show_photo_icon" data-link="<?php echo get_permalink(get_the_ID()); ?>">
            <a href="<?php echo get_permalink(get_the_ID()); ?>">
                <img class="oeil" src="<?php echo get_stylesheet_directory_uri() ;?>/assets/eye.svg" alt="Oeil">
            </a>
                <img class="fullscreen" src="<?php echo get_stylesheet_directory_uri() ;?>/assets/fullscreen.svg" alt="pleins écran">
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

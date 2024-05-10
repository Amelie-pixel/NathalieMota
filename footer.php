<footer>
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="close" onclick="closeLightbox()">&times;</span>
        <div class="lightbox-nav">
    <div class="lightbox-nav2">
        <div class="flexrow">
            <span class="prev" id="prevButton"><img src="<?php echo get_stylesheet_directory_uri() ;?>/assets/NavigationArrowsLeft.png" alt="Précédente"></span>
            <img src="<?php the_post_thumbnail_url(); ?>" class="lightbox-img" id="lightboxImg">
            <span class="next" id="nextButton"><img src="<?php echo get_stylesheet_directory_uri() ;?>/assets/NavigationArrowsRight.png" alt="Suivante"></span>
        </div>
        <div class="lightbox-content flexrow">
            <p class="lightbox-reference"><?php echo get_field('reference'); ?></p>
            <p class="lightbox-categorie">
                <?php
                $categories = get_the_terms(get_the_ID(), 'categorie');
                if ($categories) {
                    foreach ($categories as $category) {
                        echo $category->name . ' ';
                    }
                }
                ?>
            </p>
        </div>
    </div>
</div>

    </div>
    <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu-class' ) ); ?>
    <?php get_template_part ( '/templates-part/modalContact'); ?>
    <?php wp_footer(); ?>
</footer>
</body>
</html>
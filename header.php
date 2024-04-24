<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <title><?php bloginfo('name'); ?> &raquo; <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header class="entete">
      <a class="my-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="http://nathaliemota.local/wp-content/uploads/2024/04/Logo.png" alt="<?php bloginfo('name'); ?>"></a>
      <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'header-menu-class' ) ); ?>
<!-- Trigger/Open The Modal -->
<button id="myBtn">CONTACT</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close"></span>
    </div>
    <div class="modal-body">
    <?php
				echo do_shortcode('[contact-form-7 id="81cb67f" title="Contact form 1"]');
			?>
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>

  </header>


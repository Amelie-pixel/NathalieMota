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

<!-- Ajout du logo et du menu header -->
  <header class="entete">
    <a class="my-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_stylesheet_directory_uri() ;?>/assets/Logo.png" alt="<?php bloginfo('name'); ?>"></a>
    <div class="menu-header">
      <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'header-menu-class' ) ); ?>
      <button id="myBtn">CONTACT</button>
    </div>

    <!-- Ajout du menu hamburger -->
    <nav id="site-navigation" class="main-navigation">  
      <div id="mySidenav" class="sidenav hidden"> 
        <div class="blocknav">
          <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'header-menu-class' ) ); ?>
          <button id="myBtn3">CONTACT</button>
        </div> 
      </div>
      <span id="burger-icon" class="burger-icon">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </nav>
  </header>


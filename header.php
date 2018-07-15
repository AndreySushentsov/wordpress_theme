<?php
  /*
    This is the template for the header
    @package second theme
  */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=divice-width, intial-scale=1">
    <?php if(is_singular() && pings_open(get_queried_object())): ?>
      <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>
    <title><?php bloginfo('name'); wp_title(); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header class="container">
      <div class="header__container background-img" style="background-image:url(<?php header_image(); ?>);">
        <nav>
          <?php wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => 'header__navigation'
          )); ?>
        </nav>
      </div>
    </header>

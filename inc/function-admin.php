<?php
/*
 * @packge secondtheme
 * ========================
 *  ADMIN
 * ========================
 */

 function secondtheme_add_admin_page(){
   // Созадем сраницу в админ панели
   add_menu_page('Настройки темы', 'Моя Тема', 'manage_options','andrey-second', 'second_theme_create_page', '', 110 );

   // Созадем подстраницы
   add_submenu_page('andrey-second', 'Настройки темы', 'Общие Настройки', 'manage_options', 'andrey-second','second_theme_create_page');
   add_submenu_page('andrey-second', 'Настройки Стилей', 'Настройки Стилей', 'manage_options', 'andrey-second-css','second_theme_settings_page');

   // Активируем настройки
   add_action('admin_init', 'second_custom_settings');
 }

 function second_custom_settings(){
    register_setting('second-settings-group','first_name');
    register_setting('second-settings-group','last_name');
    register_setting('second-settings-group','twitter_handler');
    register_setting('second-settings-group','instagram_handler');
    register_setting('second-settings-group','youtube_handler');
    register_setting('second-settings-group','facebook_handler');

    add_settings_section('second-sidebar-options','Настройки сайдбара','second_sidebar_options','andrey-second');

    add_settings_field('sidebar-name','Имя, Фамилия:','second_sidebar_name','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-twitter', 'Twitter', 'second_sidebar_twitter','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-vk', 'Twitter', 'second_sidebar_twitter','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-instagram', 'Instagram', 'second_sidebar_instagram','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-youtube', 'Youtube', 'second_sidebar_youtube','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-fb', 'Facebook', 'second_sidebar_facebook','andrey-second','second-sidebar-options');

 }


 function second_sidebar_options(){

 }

/* Настройки Имя, Фамилия */
 function second_sidebar_name(){
   $firstName = esc_attr(get_option('first_name'));
   $lastName = esc_attr(get_option('last_name'));
   echo "<input type='text' name='first_name' value='". $firstName ."' placeholder='Введите имя' /> <input type='text' name='last_name' value='". $lastName ."' placeholder='Введите Фамилию' />";
 }

 /* Настройки социальных сетей*/
  function second_sidebar_twitter(){
    $twitter = esc_attr(get_option('twitter_handler'));
    echo "<input type='text' name='twitter_handler' value='". $twitter ."' placeholder='Твиттер аккаунт' />";
  }

  function second_sidebar_instagram(){
    $instagram = esc_attr(get_option('instagram_handler'));
    echo "<input type='text' name='instagram_handler' value='". $instagram ."' placeholder='аккаунт в инстаграм' />";
  }

  function second_sidebar_youtube(){
    $youtube = esc_attr(get_option('youtube_handler'));
    echo "<input type='text' name='youtube_handler' value='". $youtube ."' placeholder='yuoutube канал' />";
  }

  function second_sidebar_facebook(){
    $facebook = esc_attr(get_option('facebook_handler'));
    echo "<input type='text' name='facebook_handler' value='". $facebook ."' placeholder='аккаунт в facebook' />";
  }


/* Подключение шаблона */
 function second_theme_create_page(){
   require_once(get_template_directory() . '/inc/templates/second-admin.php');
 }

 function second_theme_settings_page(){

 }

 add_action('admin_menu', 'secondtheme_add_admin_page');

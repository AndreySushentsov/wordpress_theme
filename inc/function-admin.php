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
   add_submenu_page('andrey-second', 'Настройки Формы обратной связи', 'Настройки Формы обратной связи', 'manage_options', 'andrey-theme-contact','second_theme_contact_page');
   add_submenu_page('andrey-second', 'Опции', 'Опции темы', 'manage_options', 'andrey-theme-support','second_theme_support_page');

   // Активируем настройки
   add_action('admin_init', 'second_custom_settings');
 }

 function second_custom_settings(){

   //
    register_setting('second-settings-group','profile_photo');
    register_setting('second-settings-group','first_name');
    register_setting('second-settings-group','last_name');
    register_setting('second-settings-group','vk_handler');
    register_setting('second-settings-group','twitter_handler');
    register_setting('second-settings-group','instagram_handler');
    register_setting('second-settings-group','youtube_handler');
    register_setting('second-settings-group','facebook_handler');

    add_settings_section('second-sidebar-options','Настройки информации о пользователе','second_sidebar_options','andrey-second');

    add_settings_field('sidebar-picture','Фото:','second_sidebar_photo','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-name','Имя, Фамилия:','second_sidebar_name','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-vk', 'vk', 'second_sidebar_vk','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-Twitter', 'Twitter', 'second_sidebar_twitter','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-instagram', 'Instagram', 'second_sidebar_instagram','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-youtube', 'Youtube', 'second_sidebar_youtube','andrey-second','second-sidebar-options');
    add_settings_field('sidebar-fb', 'Facebook', 'second_sidebar_facebook','andrey-second','second-sidebar-options');

    // theme options
    register_setting('second-theme-support', 'post_formats');
    register_setting('second-theme-support', 'custom_header');
    register_setting('second-theme-support', 'custom_background');

    add_settings_section('second-theme-options', 'Опции темы', 'second_theme_options','andrey-theme-support');

    add_settings_field('post-formats', 'Post Formats', 'second_post_formats', 'andrey-theme-support', 'second-theme-options');
    add_settings_field('custom-header', 'Опции Хедера', 'second_custom_header', 'andrey-theme-support', 'second-theme-options');
    add_settings_field('custom-background', 'Опции бэкграунда', 'second_custom_background', 'andrey-theme-support', 'second-theme-options');

    // Contact Form settings
    register_setting('second-contact-options', 'activate_contact');

    add_settings_section('second-contact-section', 'Форма Обратной Связи', 'second_contact_section', 'andrey-theme-contact');
    add_settings_field('activate-form', 'Активируем форму обратной связи', 'second_activate_contact', 'andrey-theme-contact','second-contact-section');

    //Custom CSS options
    register_setting('second-custom-css', 'second_css', 'second_sanitize_custom_css');

    add_settings_section('second-custom-css-section', 'Настройки CSS', 'second_custom_css_section_callback','andrey-second-css' );
    add_settings_field('custom-css', 'Добавте свои стили: ', 'second_custom_css_callback', 'andrey-second-css', 'second-custom-css-section');

 }


 function second_sidebar_options(){

 }

/* Настройки Фото профиля */
 function second_sidebar_photo(){
   $picure = esc_attr(get_option('profile_photo'));
   echo "<input type='button' value='Изображение профиля' id='upload_picure_button' class='button button-secondary'/><input type='hidden' id='profile_picture' name='profile_photo' value='. $picure .'/>";
 }

/* Настройки Имя, Фамилия */
 function second_sidebar_name(){
   $firstName = esc_attr(get_option('first_name'));
   $lastName = esc_attr(get_option('last_name'));
   echo "<input type='text' name='first_name' value='". $firstName ."' placeholder='Введите имя' /> <input type='text' name='last_name' value='". $lastName ."' placeholder='Введите Фамилию' />";
 }

 /* Настройки социальных сетей*/
 function second_sidebar_vk(){
   $vk = esc_attr(get_option('vk_handler'));
   echo "<input type='text' name='vk_handler' value='". $vk ."' placeholder='vk аккаунт' />";
 }

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

/*
 * ======================
 *  Options submenu
 * ======================
 */

/* post formats */

function second_theme_options(){
  echo "hello";
}

function second_post_formats()
{
  $formats = array('aside', 'gallery', 'link', 'image', 'qoute', 'status', 'video', 'audio', 'chat');
  $options = get_option('post_formats');
  $output ='';
  foreach($formats as $format){
    $checked = (@$options[$format] == 1 ? 'checked' : '');
    $output .= "<input type='checkbox' id='".$format."' name='post_formats[".$format."]' value='1' ".$checked."/> ".$format."<br>";
  }
  echo $output;
}

function second_custom_header()
{
  $options = get_option('custom_header');
  $checked = (@$options == 1 ? 'checked' : '');
  echo "<input type='checkbox' id='custom_header' name='custom_header' value='1' ".$checked."/> Активировать Хедер";
}

function second_custom_background()
{
  $options = get_option('custom_background');
  $checked = (@$options == 1 ? 'checked' : '');
  echo "<input type='checkbox' id='custom_background' name='custom_background' value='1' ".$checked."/> Активировать Бэкграунд";
}

// Форма обратной связи
 function second_contact_section(){
   echo "настройки формы обратной связи";
 }

 function second_activate_contact(){
   $options = get_option('activate_contact');
   $checked = (@$options == 1 ? 'checked' : '');
   echo "<input type='checkbox' id='activate_contact' name='activate_contact' value='1' ".$checked."/>";
 }


// Настройки стилей
function second_custom_css_section_callback(){
  echo "<p> Пользовательские настройки стилей. </p>";
}

function second_sanitize_custom_css($input)
{
  $output = esc_textarea($input);
  return $output;
}

function second_custom_css_callback(){
  $css = get_option('second_css');
  $css = (empty($css) ? '/* Second Theme Custom CSS */' : $css);
  echo "<textarea rows='10' style='width:500px;' id='second_css' name='second_css'>".$css."</textarea>";
}

/* Подключение шаблонов */
 function second_theme_create_page(){
   require_once(get_template_directory() . '/inc/templates/second-admin.php');
 }

 function second_theme_support_page(){
   require_once(get_template_directory() . '/inc/templates/second-theme-support.php');
 }

 function second_theme_contact_page()
 {
   require_once(get_template_directory() . '/inc/templates/second-theme-contact.php');
 }

 function second_theme_settings_page(){
   require_once(get_template_directory() . '/inc/templates/second-custom-css.php');
 }

 add_action('admin_menu', 'secondtheme_add_admin_page');

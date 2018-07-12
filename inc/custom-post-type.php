<?php
  /*
  @package secondtheme

  =========================
    THEME CUSTOM POST TYPES
  =========================
  */

  $contact = get_option('activate_contact');
  if(@$contact == 1){
    add_action('init', 'second_contact_custom_post_type');
  }

  function second_contact_custom_post_type(){
    $labels = array(
      'name'           => 'Сообщения',
      'singular_name'  => 'Сообщение',
      'menu_name'      => 'Сообщения',
      'name_admin_bar' => 'Сообщение'
    );

    $args = array(
      'labels'        => $labels,
      'show_ui'       => true,
      'show_in_menu'  => true,
      'capability'    => 'post',
      'hierarchical'  => false,
      'menu_position' => 26,
      'supports'      => array('title', 'editor', 'author')
    );

    register_post_type('second-contact', $args);
  }

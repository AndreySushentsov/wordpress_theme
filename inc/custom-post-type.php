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
    add_filter('manage_second-contact_posts_columns', 'second_set_contact_columns');
    add_action('manage_second-contact_posts_custom_column', 'second_contact_custom_column', 10, 2);
    add_action('add_meta_boxes', 'second_contact_add_meta_box');
    add_action('save_post', 'second_save_contact_email_data');
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

  function second_set_contact_columns(){
    $newColumns = array();
    $newColumns['title'] = 'Имя';
    $newColumns['message'] = 'Сообщение';
    $newColumns['email'] = 'Почта';
    $newColumns['date'] = 'Дата';

    return $newColumns;
  }

  function second_contact_custom_column( $column , $post_id){
    switch ($column) {
      case 'message':
        echo get_the_excerpt();
        break;
      case 'email':
        $email = get_post_meta($post_id, '_contact_email_value_key', true);
        echo $email;
        break;
    }
  }

// META BOXES
function second_contact_add_meta_box(){
  add_meta_box('contact_email', 'User email', 'second_contact_email_callback','second-contact','side', 'default');
}

function second_contact_email_callback($post){
  wp_nonce_field('second_save_contact_email_data', 'second_contact_email_meta_box_nonce');

  $value = get_post_meta($post->ID, '_contact_email_value_key', true);
  echo '<label for="second_contact_email_field">Email пользователя: </lable>';
  echo '<input type="email" id="second_contact_email_field" name="second_contact_email_field" value="'.esc_attr($value).'" size="25" />';
}

function second_save_contact_email_data($post_id){
  if(! isset($_POST['second_contact_email_meta_box_nonce'])){
    return;
  }

  if(!wp_verify_nonce($_POST['second_contact_email_meta_box_nonce'], 'second_save_contact_email_data')){
    return;
  }

  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
    return;
  }

  if(! current_user_can('edit_post', $post_id)){
    return;
  }

  if(!isset($_POST['second_contact_email_field'])){
    return;
  }

  $my_data = sanitize_text_field($_POST['second_contact_email_field']);
  update_post_meta($post_id, '_contact_email_value_key', $my_data);
}

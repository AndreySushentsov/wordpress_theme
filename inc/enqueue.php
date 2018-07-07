<?php
/*
 * @packge secondtheme
 * ========================
 *  ADMIN ENQUEUE
 * ========================
 */

 function second_load_admin_scripts($hook){
   if('toplevel_page_andrey-second' != $hook){ return; }
   wp_register_style('second_admin', get_template_directory_uri() . '/css/second.admin.css', array(), '1.0.0', 'all');
   wp_enqueue_style('second_admin');

   wp_enqueue_media();

   wp_register_script('second-admin-script', get_template_directory_uri() . '/js/second.admin.js', array('jquery'), true);
   wp_enqueue_script('second-admin-script');
 }
 add_action('admin_enqueue_scripts', 'second_load_admin_scripts');

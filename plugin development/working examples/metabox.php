<?php
/*
Plugin Name: MG Meta Box
*/

add_action('add_meta_box','mg_meta_create');

function mg_meta_create()
{
    add_meta_box('html_id','title','mg_admin_html','page','normal','high',1);
}

function mg_admin_html( $post )
{
  //retieve metadata if exists
  $postmeta = get_post_meta($post->ID, 'mg_post_meta', true);
  
  //diplay html per post
  echo "<h1> MG custom metabox </h1>
  <p> MG text field: <input type='text' name='mg_text_field' value='$postmeta'> </p>";
}

add_action('save_post','mg_save_post_meta');

function mg_save_post_meta( $post_id)
{
  if( isset( $_POST['mg_text_field']))
  {
    update_post_meta($post_id,'mg_post_meta',strip_tags($_POST['mg_text_field']));
  }
  
}

?>

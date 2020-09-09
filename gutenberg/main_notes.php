<?php
/*PHP FILE */

on init action

// first include the js script
// 3rd param is dependency
wp_register_script('custom-js-block', "file_path", array( 'wp-blocks' ));

register_block_type("namespace/slug", array(
  'editor_script' => 'custom-js-block'
) );


/*JS FILE */
const { registerBlockType } = wp.blocks;

registerBlockType("namespace/slug", {

//built in attributes
title: 'title of block',
description: 'Description of block',
icon: 'format-image',
category: 'woocommerce',

//custom attributies
attributes: {
  author: {
    type: 'string'
  }
},
//custom functions

//build in functions
  
//this returns the block in the page's back end
edit({attributes}) {

  // custom functions musst be defined inside the edit
  
  //seTaattribute function is saving an attribute run time, attributes are variables for the component
reutrn <div> { attributes.author } </div>;
  
},
save() {}
});

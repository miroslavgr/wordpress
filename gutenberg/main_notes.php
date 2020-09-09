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
attributes: {},
//custom functions

//build in functions
edit() {},
save() {}
});

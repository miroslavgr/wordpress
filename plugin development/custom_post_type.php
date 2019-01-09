<?php
/*
    This file is about custom post type create and use.

    Overall functions 
*/
register_post_type( 'type_name', ['public' => 'true'] );// 1st param name of type
flush_rewrite_rules();//clear the permalinks after the post type has been registered
register_activation_hook();//on plugin activation
register_deactivation_hook();//on plugin deactivation


//Main Example
function pluginprefix_setup_post_type() {
   //text labels for admin menu
	$labels = array(
        'name'               => __( 'Products', 'halloween-plugin' ),
        'singular_name'      => __( 'Product', 'halloween-plugin' ),
        'add_new'            => __( 'Add New', 'halloween-plugin' ),
        'add_new_item'       => __( 'Add New Product', 'halloween-plugin' ),
        'edit_item'          => __( 'Edit Product', 'halloween-plugin' ),
        'new_item'           => __( 'New Product', 'halloween-plugin' ),
        'all_items'          => __( 'All Products', 'halloween-plugin' ),
        'view_item'          => __( 'View Product', 'halloween-plugin' ),
        'search_items'       => __( 'Search Products', 'halloween-plugin' ),
        'not_found'          =>  __( 'No products found', 'halloween-plugin' ),
        'not_found_in_trash' => __( 'No products found in Trash', 'halloween-plugin' ),
        'menu_name'          => __( 'Products', 'halloween-plugin' )
    );

    //other options for the custom post type
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'register_meta_box_cb' =>'example_metabox',// name of the function
        //support actions
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );

	register_post_type( 'type-name', $args );
}
add_action( 'init', 'pluginprefix_setup_post_type' );
 
function pluginprefix_install() {
    // trigger our function that registers the custom post type
    pluginprefix_setup_post_type();
 
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pluginprefix_install' );

function pluginprefix_deactivation() {
    // unregister the post type, so the rules are no longer in memory
    unregister_post_type( 'type_name' );
    // clear the permalinks to remove our post type's rules from the database
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );

//metabox create
function example_metabox()
{
    add_meta_box('example_metabox_customfields','Example Custom Fields','example_metabox_display','type-name','normal');
    // 4nd param type name
    //5rd param where to position normal/side
    //6rd priority
}
add_action('add_meta_boxes','example_metabox');

function example_metabox_display()
{
    global $post;
    $sub_title = get_post_meta($post->ID,'sub_title',true);
    // we are already in a form tag
    ?>
    <label>Sub Title</label>
    <input type="text" name="sub_title" placeholder="Sub Title" class="widefat" value="<?php print $sub_title; ?>"/>
    <?php
}
//save meta data
function example_posttype_save($post_id)
{
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    if($is_autosave || $is_revision)
    {
        return;
    }

    $post = get_post($post_id);
    if($post->post_type == "type-name")
    {
        //save the custom fields data
        if(arrey_key_exists('sub_title',$_POST))
        {
            update_post_meta($post_id,'sub_title',$_POST['sub_title']);
        }
    }
}
add_action('save_post','example_posttype_save');



?>
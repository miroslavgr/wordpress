<?php
/*
    This file is about custom post type create and use.
	5 default types
	post
	page
	attachment - media uploaded and attached to post type entries
	revision - revision ofa post type used as backup and can be restored
	nav menus - Menu items added to a nav menu
	always use init on register

    Create single-(post_type).php for showing a single item
    and archive-(post_type).php for a blog of items
    Search for this functions followed by 'example'
    Overall functions 
*/
//core functions
flush_rewrite_rules();//clear the permalinks after the post type has been registered
register_activation_hook();//on plugin activation
register_deactivation_hook();//on plugin deactivation
//register new post type on 'init' action hook and no more than 20 chars
register_post_type( 'type_name', ['public' => 'true'] );// 1st param name of type
register_taxonomy('post_tag', 'post_type');// mandatory if want to attach a taxanomy
post_type_exists('post_type');//boolean
get_post_types($args, $output, $operator);//return all post type existing
get_post_type($post); // or post->id, if empty current post used //return the post type
add_post_type_support('post_type', $supports);// alter a post type and more support
remove_post_type_support('post_type', $supports);// remove 
set_post_type($post_id, 'post_type');//change the post type of a post entry

/*post meta
uniqe- true for only 1 possible entry for this post.
_$meta_key - for hiding it from the editor
*/
add_post_meta($post_id, $meta_key, $meta_value, $uniqe);// add custom field to a post
update_post_meta($post_id, $meta_key, $meta_value, $prev_value);//perfrom create if not exist, prev_val is optional if not uniqe
delete_post_meta($post_id, $meta_key, $meta_value);// $meta_value is optional needed if not uniqe
get_post_meta($post_id, $meta_key, $single);// 3rd param true if uniqe, otherwise false to return array
get_post_custom($post_id);//return multi dimensial array of all meta data existing for a post
/*
    Metaboxes creation must be attachd to add_action('add_meta_box','cb') hook 
    They are already in a <form> and already have Submit buttons from the editor
*/
add_meta_box('box_name_id','Box title','html_box_cb','post_type');
remove_meta_box('box_name_id','Box title','html_box_cb','post_type'); 
//my functions
display_custom_posts();//example with WP_query
exm_get_post_types();//get_post_types example

//Main Example

// Start Create Post Type and flush
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
        'has_archive'        => true, // archive-(post_type).php for show all like a blog
        'hierarchical'       => false,
        'menu_position'      => null,
        'register_meta_box_cb' =>'example_metabox',// name of the function
        //support actions
        'taxonomies'         => array('post_tag'),//add taxonomies optional
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt','custom-fields' )
    );

    register_post_type( 'type-name', $args );
    
    register_taxonomy('post_tag', 'post_type');// mandatory if want to attach a taxanomy
}
add_action( 'init', 'pluginprefix_setup_post_type' );
 
function pluginprefix_install() {
    // trigger our function that registers the custom post type
    pluginprefix_setup_post_type();
 
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();

    //wp version require check
    global $wp_version;
    if(version_compare($wp_version,'4.1','<'))
    {
        wp_die('This plugin requiers WP version 4.1 or higher');
    }
}
register_activation_hook( __FILE__, 'pluginprefix_install' );

function pluginprefix_deactivation() {
    // unregister the post type, so the rules are no longer in memory
    unregister_post_type( 'type_name' );
    // clear the permalinks to remove our post type's rules from the database
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );
// End Create Post Type and flush

// Start Post meta

function example_post_meta_crud()
{
    //single value for 1 meta key
    add_post_meta($post_id,'price','10',true);
    update_post_meta($post_id, 'price','15'); 

    $price = get_post_meta($post_id, 'price', true);
    echo $price;
    delete_post_meta($post_id, 'price');

    //many values for 1 meta key
    add_post_meta($post_id,'price','10',false);
    add_post_meta($post_id,'price','15',false);
    update_post_meta($post_id, 'price','16','10');
    $prices = get_post_meta($post_id, 'price', true);

    foreach($prices as $price)
    {
        echo $price;
    }

    delete_post_meta($post_id, 'price');// delete all
    delete_post_meta($post_id, 'price','15');//delete only one

    //retrieve all meta for a post - good because makes only 1 query
    $all_metadata = get_post_custom($post_id);

    foreach($all_metadata as $key=>$value)
    {
        echo $key;
        foreach($value as $keyVal => $rlval)
        {
            echo $keyVal." = > ";
            echo var_dump($rlval);
        }
    }
}


//metabox create
function example_metabox()
{
    add_meta_box('example_metabox_customfields','Example Custom Fields','example_metabox_display','type-name','normal');
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
// End Post meta

//show all posts example
function display_custom_posts()
{
    $args = array(
        'posts_per_page'=> '-1',//all
        'post_type'=>'products',//post type name
        'tax_query'=> array(//posts iassigned with a particular taxonomy
            'taxonomy'=>'category', //type taxonomy
            'field' => 'slug',
            'terms' => 'specials' //term
        )
    );
    $allPosts = new WP_Query($args);
	
    $content = " ";	
    while($allPosts->have_posts()):
        $allPosts->the_post();
        $content .= the_title();
        $content .= the_content();
    endwhile;
    wp_reset_postdata();
    return $content
}
add_shortcode('show_all','display_custom_posts')

//get_post_types example
function exm_get_post_types()
{
    $args = array(
        'public'   => true, 
        '_builtin' => false //custom types only
    );

    $post_types = get_post_types($args, 'names', 'and');

    foreach($post_types as $post_type)
    {
        echo "<p>".$post_type."</p>";
    }
}
?>

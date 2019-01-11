<?php
/*
    This file is about custom taxonomies create and use.

    Default Taxonomies: category and tag
    Terms are instantions of each Taxonomy

    Taxonomies are used to group your posts

    Database Tables
    wp_terms holds all terms of all taxonomies
    wp_term_taxonomy holds relationship term-taxonomy
    wp_term_relationships holds the relationship term-post

    Overall functions 
*/

//core functions
//register on 'init' action hook
register_taxonomy();//register custom taxonomy
wp_tag_cloud( array('taxonomy' => 'tax_name'
                    'number'   => 5)); // return terms of a taxonomy
get_term_list($post_id,'tax_name');//get all terms of a post
$terms = the_terms('tax_name');//array of all terms for a taxonomy
is_taxonomy('tax_name');//boolean if exists

function prowp_define_product_type_taxonomy()
{

    $labels = array(
		'name'              => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Genres', 'textdomain' ),
		'all_items'         => __( 'All Genres', 'textdomain' ),
		'parent_item'       => __( 'Parent Genre', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Genre:', 'textdomain' ),
		'edit_item'         => __( 'Edit Genre', 'textdomain' ),
		'update_item'       => __( 'Update Genre', 'textdomain' ),
		'add_new_item'      => __( 'Add New Genre', 'textdomain' ),
		'new_item_name'     => __( 'New Genre Name', 'textdomain' ),
		'menu_name'         => __( 'Genre', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,//for allowing to perform queries on it
		'rewrite'           => true // allowing pretty permalinks
	);
    register_taxonomy('tax_name', 'post_type',$args);
}

add_action('init','prowp_define_product_type_taxonomy');


//Main Example
?>

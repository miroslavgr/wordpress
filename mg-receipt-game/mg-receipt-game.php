<?php 
/*
 *Plugin Name: Receipt Game
 */
    
       
function mg_rg_init_menu()
{
    
    //add top level menu for managing main registered table
    add_menu_page(
        'MG Receipt Game',//text used for <title> html tag
        'MG Receipt Game',//text isef for the menu name in Dashboard
        'manage_options',//minimum user capability requered to see menu, usually 'manage_options'
        'mg_main_menu',//uniqe slug name for the menu
        'mg_rg_main_menu_html'//function to display page content
        );
    
    //sub menu for possible winning prizes
    add_submenu_page(
        'mg_main_menu',
        'Prizes',
        'Prizes',
        'manage_options',//manage_options to be viewable only by administrators
        'mg_prizes',
        'mg_rg_prizes_html'
        );
    //sub menu for choosing winner and manage winners
    add_submenu_page(
        'mg_main_menu',
        'Winners',
        'Winners',
        'manage_options',//manage_options to be viewable only by administrators
        'mg_winners',
        'mg_rg_winners_html'
        );
}


add_action('admin_menu','mg_rg_init_menu');

function mg_rg_main_menu_html()
{
    echo "main page";   
}

function mg_rg_prizes_html()
{
    echo "prizes page";
}

function mg_rg_winners_html()
{
    echo "winners page";
}

function mg_rg_activate()
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . "mg_rg_register"; 
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id int NOT NULL AUTO_INCREMENT , 
    receipt int NOT NULL ,
    price float NOT NULL , 
    name varchar(255) NOT NULL , 
    email varchar(255) NOT NULL , 
    mobile int NOT NULL ,
     PRIMARY KEY (id), UNIQUE (receipt)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook(__FILE__,'mg_rg_activate'); //1st param is the main plugin file

?>

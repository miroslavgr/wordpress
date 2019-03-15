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
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
    //registered
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
    )$charset_collate";
    
    //prizes
   /* $table_name2 = $wpdb->prefix . "mg_rg_prizes";
    $charset_collate2 = $wpdb->get_charset_collate();
    
    $sql2 = "CREATE TABLE IF NOT EXISTS $table_name (
    id int NOT NULL AUTO_INCREMENT ,
    receipt int NOT NULL ,
    price float NOT NULL ,
    name varchar(255) NOT NULL ,
    email varchar(255) NOT NULL ,
    mobile int NOT NULL ,
     PRIMARY KEY (id), UNIQUE (receipt)
    )$charset_collate";*/
    
    //winners
    $table_name3 = $wpdb->prefix . "mg_rg_winners";
    $charset_collate3 = $wpdb->get_charset_collate();
    
    //to do add foreign key prize_id to prizes
    $sql3 = "CREATE TABLE IF NOT EXISTS $table_name3 (
    id int NOT NULL AUTO_INCREMENT ,
    name varchar(255) NOT NULL ,
    email varchar(255) NOT NULL ,
    mobile int NOT NULL ,
    prize_id int NOT NULL,
    PRIMARY KEY (id)
    )$charset_collate";
    
   //$bool = $wpdb->query($sql);
   
   dbDelta( $sql ); //registered
  // dbDelta( $sql2 ); //prizes
   dbDelta( $sql3 ); //winners
}
register_activation_hook(__FILE__,'mg_rg_activate'); //1st param is the main plugin file

//insert into table example
function jal_install_data() {
    global $wpdb;
    
    $welcome_name = 'Mr. WordPress';
    $welcome_text = 'Congratulations, you just completed the installation!';
    
    $table_name = $wpdb->prefix . 'liveshoutbox';
    
    $wpdb->insert(
        $table_name,
        array(
            'time' => current_time( 'mysql' ),
            'name' => $welcome_name,
            'text' => $welcome_text,
        )
        );
}

?>

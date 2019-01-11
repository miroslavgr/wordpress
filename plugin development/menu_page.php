<?php
/*
    Menu page, subpage, settings and options related code

    Overall functions used for creating Menu page and/or subpages for the plugin
*/
function overall()
{
	//creating top level menu page
	add_menu_page();//add top level menu page
	add_submenu_page();// add sub menu page to an existing top level menu

	//creating sub page of the existing menus
	add_options_page();//add submenu items to the Settings menu
	add_dashboard_page();//add submenu items to the Dashboard menu
	add_posts_page();//add submenu items to the Posts menu
	add_media_page();//add submenu items to the Media menu
	add_pages_page();//add submenu items to the Pages menu
	add_comments_page();//add submenu items to the Comments menu
	add_plugins_page();//add submenu items to the Plugins menu
	add_theme_page();//add submenu items to the Appearence menu
	add_users_page();//add submenu items to the Users page
	add_management_page();//add submenu items to the Tools menu

	/*
	Settings API and Options API
	The Settings API focuses on providing a way for developers to create forms and manage form data.
	Also handles the Nonces 

	The Options API focuses on managing data using a simple key/value system.

	Settings and Options add should be executed to 'admin_init' action hook

	skeleton of MENU HTML FUNCTIOn
	<div class="wrap">
	<form action="options.php" method="post">*/
	settings_fields('options_group');//execute it in the form to add nonces and security
	do_settings_sections('page');//execute callbacks of the all page sections and its fields
	submit_button('Save Settings');// add a native button
	//</form></div>

	//skeleton of function for register
	register_setting('options_group','options_name','sanitize_cb');// will add a new entry in $wpdb->prefix_options table
	add_settings_section('section_name','title_section','html_sec_cb','page');// add new section of settings with different header in the same group
	add_settings_field('field_name','title_field','html_field_cb','page','section_name');//add a setting to a particular section from a particular group
	//
	$options = get_option('options_name');//get settings in the callbacks




	//Options
	add_option('name','value/array');// registered again in $wpdb->prefix_options table
	update_option('option_name','value/array');// overrides the option and the create if not exist
	$option = get_option('option_name');// single or array, false if doesn't exist
	delete_option('option_name');
}
//Main example

//Start top level menu with submenus
function menu_page_func() {
	//top level menu page
	add_menu_page(
		'page_title',//text used for <title> html tag
		'menu_title',//text isef for the menu name in Dashboard
		'capability',//minimum user capability requered to see menu, usually 'manage_options'
		'menu_slug',//uniqe slug name for the menu
		'html_function_name',//function to display page content
		'img_url',//path to custom icfor for shadboard def: images/generic.png 
		int $position//position in the dashboard, default is at the bottom
	);
	
	//submenu page
	add_submenu_page(
		'parent_menu_slug',
		'page_title',
		'menu_title',
		'capability',//manage_options to be viewable only by administrators
		'menu_slug',
		'html_function_name'
	);
	
}
add_action('admin_menu','menu_page_func');
//End top level menu with submenus

//Start Sub menu page of existing menu
function options_sub_menu()
{
	add_options_page(
		'page_title',//text used for <title> html tag
		'menu_title',//text isef for the menu name in Dashboard
		'capability',//minimum user capability requered to see menu, usually 'manage_options'
		'menu_slug',//uniqe slug name for the menu
		'html_function_name'//function to display page content
	);
}
//End Sub menu page of existing menu

//Start Settings page example
//main menu front function
function html_menu_function_name()
{
	  if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    // check if the user have submitted the settings
    // wordpress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
    }
    ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 settings_fields( 'options_group' );
 do_settings_sections( 'page' );
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php

}

function register_settings()
{
	//register a setting in db
	register_setting('options_group','options_name','sanitize_cb');
	//add a section to a page name, not connected anyhow to register_settings()
	add_settings_section('section_name','title_section','html_section_cb','page');
	//add a filed to a section in a page, connected to section
	add_settings_field('text_field_id','title_field','html_text_field_cb','page','section_name');
	add_settings_field('pass_field_id','title_field','html_pass_field_cb','page','section_name');
}
add_action('admin_init','register_settings');
//sanitize function for a particular register_setting()
function sanitize_cb( $options_name ) {

	$options_name['text_field'] = ( ! empty( $options_name['text_field'] ) ) ? sanitize_text_field( $options_name['text_field'] ) : '';
	//$options_name['pass_field'] = ( ! empty( $options_name['pass_field'] ) ) ? sanitize_email( $options_name['pass_field'] ) : '';

	return $options_name;

}
//callbacks of sections and fields
function html_section_cb()
{
	?>
	<p>Here add description to section</p>
	<?php
}
function html_text_field_cb($args)
{
	$options = get_option('options_name');
    echo "<input id='text_field_id' name='options_name[text_field]' value='".$options['text_field']."'";
}
function html_pass_field_cb()
{
	$options = get_option('options_name');
	echo "<input id='pass_field_id' name='options_name[pass_field]' size='40' type='password' value='{$options['pass_field']}' />";
}
//End Settings page function



?>

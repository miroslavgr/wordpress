<?php
/*
    Menu page, subpage, settings and options related code

    Overall functions used for creating Menu page and/or subpages for the plugin
*/
//creating pages
add_menu_page();//add top level menu page
add_submenu_page();// add sub menu page to an existing top level menu

/*
Settings API and Options API
The Settings API focuses on providing a way for developers to create forms and manage form data.
The Options API focuses on managing data using a simple key/value system.

Settings and Options add should be executed to 'admin_init' action hook
*/
register_setting();// will add a new entry in $wpdb->prefix_options table
add_settings_section();// add new section of settings with different header in the same page
add_settings_field();//add a setting to a particular section
get_option('setting_name');//get a registered settings

//Options
add_option('name','value/array');// registered again in $wpdb->prefix_options table
get_option('option_name');// get an option
update_option('option_name','value/array');// overrides the option
delete_option('option_name');


//Main example
function menu_page_func() {
	add_menu_page(
		'page_title',
		'menu_title',
		'capability',
		'menu_slug',
		'html_function_name',
		'img_url',
		int $position
	);
	
	add_submenu_page(
		string $parent_slug,
		'page_title',
		'menu_title',
		'capability',
		'menu_slug',
		'html_function_name',
	);
	
}
add_action('admin_menu','menu_page_func');



?>
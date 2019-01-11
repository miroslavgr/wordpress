<?php
//https://make.wordpress.org/docs/
/*
    Main plugin development source
    Plugins must be organized with classes to
    prevent name collisions with other plugins

    There are 2 types of hooks
    Actions and Filters

    Similarities between both:
    Hooks are basically calling a callback function in the time of
    execution of the Hook. The execution can be anywhere in core code
    or in other plugins.
    Must add prefix when creating custom hooks to be uniqe within many plugins and themes
    Can give arguments to the callback functions

    Difference between both:
    
    Actions:
    These hooks are allowed to change the functionality and add data to the database
    Triggered by events
    Actions functions:*/
    do_action('hook_name');// create and execute custom action hook, optional parameters are arguemnts to callbacks
    add_action('hook_name','func_name', int prio, int numParams);// prio and numParams optional
    remove_action('hook_name','func_name'); // remove the callback from this hook
    remove_all_actions('hook_name'); // remove all callbaks from a hook
    current_action();// in case 2+ hooks are attached to 1 callback, can use for debugging purposes
    did_action();// in the callback func counter of how many times the hook has been executed
    function action_hooks()
    {
        //most used action hooks

        'init'//triggered after WP has finished loading 
        'admin_init'//same as init but only run on admin dashboard pages
        'admin_menu'//used for initializing new menus
        'user_register'//triggered when a new user is created
        'comment_post' // after any new comment is posted
        'publish_post'//triggered when a new post is published
        'create_category'//triggered when a new category is created
        'switch_theme'//triggered when you switch themes
        'admin_head'//triggered in the <head> section of the admin dashboard
        'wp_head'//triggered in the <head> section of your theme
        'wp_footer'//triggered in the footer section of your theme

    }

    /*
    Filetrs:
    These hooks must NOT have side effects (pure functions), must not change
    any functionality or add data.
    Filter Hooks are used to alter data before it is save the database or before to display it on the frontend
    Allow you to alter the conent( if any) , change it and return it.
    They must always return something without side effects
    Filters functions:*/
    apply_filters('hook_name');// create and execute custom filter hook, optional parameters are arguemnts to callbacks
    add_filter('hook_name','func_name', int prio, int numParams);// prio and numParams optional
    remove_filter('hook_name','func_name'); // remove the callback from this hook
    remove_all_filters('hook_name'); // remove all callbaks from a hook
    current_filter();// in case 2+ hooks are attached to 1 callback, can use for debugging purposes
    function filter_hooks()
    {
        //most used filter hooks

        //before display hooks
        'the_content' //applied to the content of any post of any post type
        'the_title' // applied to the title of any post of any post type
        'comment_text' // applied to the comment text before displaying
        'wp_title' // applied to the <title> header tag before displaying
        'the_permalink' // applied to the permalink url of a post

        //before save to database hooks
        'default_content'//alter the content b
    }
    /*
    Shortocodes:
    Shortocodes are essentially filters and must not have 
    side effects and always return a value.
    They are also similitar to HTML tags.In the meaning of
    can be self closed or if not can have text in between.
    Also can have attributes(params) like the html tags.
    Its very important to sanitaze the input and validate the output data.
    Must be attached to the 'init' action hook, in order to be created safely
    Shortocdes functions
    */
    function func_name($atts = [], $content = null, $tag = '')
    {
        if($content==NULL)
        //its self closing 
    }
    add_shortcode('shortcode_name', 'func_name');

    shortcode_exists('name');//true/false
    remove_shortcode('shortcode_name');//remove a shortcode

    /*
     Activation and Deactivation and Uninstall of the plugin has predifiend hooks
     Attach a callback on activation
     They can be used for example on deactivation to flush cache or permalinks
     Uninstall callback is used to remove options and custom tables created by the plugin
    */
    register_activation_hook(__FILE__,'func_name'); //1st param is the main plugin file
    register_deactivation_hook(__FILE__,'func_name');
    register_uninstall_hook(__FILE__,'func_name');// the preffered way is to create uninstall.php

    /*
    Security
    Sanitize the input and validate output data with the following functions

    Santize input link - https://developer.wordpress.org/plugins/security/securing-input/
    */
    sanitize_text_field('incoming text');
    sanitize_email()
    sanitize_file_name()
    
     //custom input escaping - https://developer.wordpress.org/plugins/security/securing-output/
     wp_kses();//validating incoming html for tags

    /*
        Validate otuput nature is the following
        esc_attr_e();
         1   2   3
         1 - esc_ : The prefix for the escaping functions
         2 - attr : The escaping context(attr,html,textarea,js,sql,url,url_raw)
         3 - _e : The optional translation suffix __ or _e

         attr - for anything inside attributes of a html tag, like value= esc_attr('text')
         textarea - for the content of a textearea tag <textarea> esc_textarea('text') </textarea>
         url - for href attribute  href= echo esc_url("url")
         js - <script>     var bwar = '<?php echo esc_js($text);?> '     </script>
    */
    esc_html();// Use this function anytime an HTML element encloses a section of data being displayed.
    esc_url();// Use this function on all URLs, including those in the src and href attributes of an HTML element.
    esc_js();// Use this function for inline Javascript.
    esc_attr();// Use this function on everything else that’s printed into an HTML element’s attribute.
    
   
    //Nonces - Using a number to verify the input is coming from the right people https://developer.wordpress.org/plugins/security/nonces/
    wp_nonce_filed();//use in a form to add nonce
    wp_nonce_url();//use to add a nonce in a url
    wp_verify_nonce();//use to verify the nonce after the response

    //WP core functions
    is_email();// will validate whether an email address is valid.
    term_exists();// checks whether a tag, category, or other taxonomy term exists.
    username_exists();// checks if username exists.
    validate_file();// will validate that an entered file path is a real path (but not whether the file exists).

    //PHP core functions
    isset();//Variables (includes arrays, objects, etc.)
    empty();//for checking whether a variable isn’t blank
    function_exists();//Functions
    class_exists();//Classes
    defined();//Constants
    in_array();//checking whether something exists in an array

    /*
        Internationalization

    */
    __('string','text_domain');//the string and text domain
    _e('string','text_domain');// internationalize and echo

    //path functions always use
    plugin_dir_path(__FILE__);//return string for the plugin dir
    plugin_url('images/icon.png',__FILE__); //return full path to a resource

    admin_url();//http://example.com/wp-admin
    site_url();//http://example.com
    home_url();
    includes_url();//wp-includes path
    content_url();//wp-content path
    wp_upload_dir();//upload directory

    //boolean Wordpress core funcs
    is_single();//for Post post type return true
    is_email();// will validate whether an email address is valid.
    term_exists();// checks whether a tag, category, or other taxonomy term exists.
    username_exists();// checks if username exists.
?>

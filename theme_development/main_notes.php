<?php

/*

    Template files
    Template partials
    header.php - get_header() - contains the header tag and start of body
    footer.php - get_footer() - contains footer tag and end of body
    sidebar.php - get_sidebar()
    search.php - get_search_form() - the search results template is used to display visitor's search results
    for custom template parts - get_template_part()

    index.php - required, the tail in the template hierarchy
    style.css - required, the main css file and the informational header of the theme
    comments.php - comments template
    front-page.php - template of Admin > settings > reading  front page
    home.php - front page by default
    singular.php - used for post when single.php not found and for page when page.php not fount
    single.php - single post template
    single-{post-type}.php - used for single custom post type post
    page.php - single page template
    page-{slug}.php - the slug is for the name of a page. for example page-about.php 
    category.php - the category template is used when visitors request posts by category
    tag.php - the tag template is used when visitors request posts by tag
    taxonomy.php - the taxonomy template for a term of a taxonomy
    author.php - when a visitor loads an author page
    date.php - The date/time template is used when posts are requested by date or time. For example, the pages generated with these slugs:
                http://example.com/blog/2014/
                http://example.com/blog/2014/05/
                http://example.com/blog/2014/05/26/
    archive.php -The archive template is used when visitors request posts by category,
                 author, or date. Note: this template will be overridden if more specific templates are present like category.php, author.php, and date.php.
    archive-{post-type}.php - for  custom post type archive if enabled on creating the post type
    attachment.php - used when viewing a single attachment like image,pdf or other, post type - attachment
    image.php - more specific than attachemnt.php for images
    404.php - the 404 template is used when WordPress cannot find a post, page, or other content that matches the visitor’s request.


    Template Tags - https://developer.wordpress.org/themes/references/list-of-template-tags/
*/
get_template_part('content','location');//content-location.php
bloginfo( 'name' );// the title of the website
//in the loop
the_title();//title of the post or other custom post type
the_content();
the_excerpt();
   /* Template Conditionals
*/
is_home();//Returns true if the current page is the homepage
is_admin();// Returns true if inside Administration Screen, false otherwise
is_single();// Returns true if the page is currently displaying a single post
is_page();// Returns true if the page is currently displaying a single page
is_page_template();//Can be used to determine if a page is using a specific template, for example: is_page_template('about-page.php')
is_category();//Returns true if page or post has the specified category, for example: is_category('news')
is_tag();//Returns true if a page or post has the specified tag
is_author();// Returns true if inside author’s archive page
is_search();// Returns true if the current page is a search results page
is_404();// Returns true if the current page does not exist
has_excerpt();// Returns true if the post or page has an excerpt

functions_exists();

//functions.php 
has_nav_menu();
register_nav_menus( array(
    'primary'   => __( 'Primary Menu', 'myfirsttheme' ),
    'secondary' => __( 'Secondary Menu', 'myfirsttheme' )
) );// register menus
wp_nav_menu(array('theme_location'=>'primary'));//get the primary menu in a template file

wp_enqueue_style('customfirst',get_template_directory_uri().'/css/awesome.css',array()); //add custom css to wp_head() hook
wp_enqueue_script('customfirst',get_template_directory_uri().'/js/awesome.js',true); // true for footer
?>

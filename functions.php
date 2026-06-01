<?php

// Load style sheets and scripts
function enqueue_styles_and_scripts() {

    wp_register_style('font-awesome', get_template_directory_uri() . '/node_modules/@fortawesome/fontawesome-free/css/all.css', array(), '5.15.3', 'all');
    wp_enqueue_style('font-awesome');

    wp_register_style('style', get_template_directory_uri() . '/dist/app.css', [], 'all');
    wp_enqueue_style('style');

    wp_enqueue_script('jquery');

    wp_register_script('bootstrap-js', get_template_directory_uri() . '/node_modules/bootstrap/dist/js/bootstrap.bundle.js', array('jquery'), '5.3.2', true); // Enqueue Bootstrap JS in the footer
    wp_enqueue_script('bootstrap-js');

    wp_register_script('script', get_template_directory_uri() . '/dist/app.js', array('jquery'), '1.0', true);
    wp_enqueue_script('script');
}

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

// Theme Options
add_theme_support('menus');

// Menus
register_nav_menus(
    array(
        'main-menu' => 'Main Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
    )
);

function my_projects()
{
    $labels = array(
        'name' => 'Projects',
        'singular_name' => 'Project',
        'name_admin_bar' => 'Project',
        'add_new' => 'Add New Project',
        'all_items' =>'View All Projects',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-admin-post',
        'hierarchical' => true,
        'supports' => array( 'title', 'editor', 'thumbnail')
    );

    register_post_type('projects',$args);

}

add_action('init','my_projects');

function technologies()
{
    $args = array(
        'labels' => array(
            'name' => 'Technologies',
            'singular_name' => 'Technology'
        ),
        'public' => true,
        'hierarchical' => true,
    );

    register_taxonomy('Technologies', array('projects'), $args);

}
add_action('init','technologies');
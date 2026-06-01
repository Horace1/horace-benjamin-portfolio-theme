<?php

// Load style sheets and scripts
function enqueue_styles_and_scripts(): void
{
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    wp_register_style('font-awesome', $theme_uri . '/node_modules/@fortawesome/fontawesome-free/css/all.css', array(), '5.15.3', 'all');
    wp_enqueue_style('font-awesome');

    wp_register_style('style', $theme_uri . '/dist/app.css', [], filemtime($theme_dir . '/dist/app.css'), 'all');
    wp_enqueue_style('style');

    wp_enqueue_script('jquery');

    wp_register_script('bootstrap-js', $theme_uri . '/node_modules/bootstrap/dist/js/bootstrap.bundle.js', array('jquery'), '5.3.2', true); // Enqueue Bootstrap JS in the footer
    wp_enqueue_script('bootstrap-js');

    wp_register_script('script', $theme_uri . '/dist/app.js', array('jquery'), filemtime($theme_dir . '/dist/app.js'), true);
    wp_enqueue_script('script');
}

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');

// Theme Options
add_theme_support('menus');

// Menus
register_nav_menus(
    array(
        'main-menu'   => 'Main Menu Location',
        'mobile-menu' => 'Mobile Menu Location',
        'footer-menu' => 'Footer Menu Location',
    )
);

function horacebenjamin_footer_menu_location() : string
{
    return has_nav_menu( 'footer-menu' ) ? 'footer-menu' : 'main-menu';
}

function my_projects() : void
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

function technologies() : void
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

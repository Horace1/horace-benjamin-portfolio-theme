<?php

// Load style sheets and scripts
function horacebenjamin_enqueue_styles_and_scripts(): void
{
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();
    $style_path = $theme_dir . '/dist/app.css';
    $script_path = $theme_dir . '/dist/app.js';
    $style_version = file_exists( $style_path ) ? filemtime( $style_path ) : wp_get_theme()->get( 'Version' );
    $script_version = file_exists( $script_path ) ? filemtime( $script_path ) : wp_get_theme()->get( 'Version' );

    wp_register_style( 'font-awesome', $theme_uri . '/node_modules/@fortawesome/fontawesome-free/css/all.css', array(), '5.15.3', 'all' );
    wp_enqueue_style( 'font-awesome' );

    wp_register_style( 'style', $theme_uri . '/dist/app.css', array(), $style_version, 'all' );
    wp_enqueue_style( 'style' );

    wp_enqueue_script( 'jquery' );

    wp_register_script( 'bootstrap-js', $theme_uri . '/node_modules/bootstrap/dist/js/bootstrap.bundle.js', array( 'jquery' ), '5.3.2', true );
    wp_enqueue_script( 'bootstrap-js' );

    wp_register_script( 'script', $theme_uri . '/dist/app.js', array( 'jquery' ), $script_version, true );
    wp_enqueue_script( 'script' );
}

add_action( 'wp_enqueue_scripts', 'horacebenjamin_enqueue_styles_and_scripts' );

// Theme Options
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

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

function horacebenjamin_register_projects_post_type() : void
{
    $labels = array(
        'name'          => 'Projects',
        'singular_name' => 'Project',
        'name_admin_bar' => 'Project',
        'add_new'       => 'Add New Project',
        'all_items'     => 'View All Projects',
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-admin-post',
        'hierarchical' => true,
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'projects', $args );

}

add_action( 'init', 'horacebenjamin_register_projects_post_type' );

function horacebenjamin_register_technologies_taxonomy() : void
{
    $args = array(
        'labels' => array(
            'name'          => 'Technologies',
            'singular_name' => 'Technology',
        ),
        'public'       => true,
        'hierarchical' => true,
    );

    register_taxonomy( 'technologies', array( 'projects' ), $args );

}
add_action( 'init', 'horacebenjamin_register_technologies_taxonomy' );

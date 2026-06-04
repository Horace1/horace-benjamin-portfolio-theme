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
        'show_in_rest' => true,
    );

    register_post_type( 'projects', $args );

}

add_action( 'init', 'horacebenjamin_register_projects_post_type' );

function horacebenjamin_register_projects_taxonomies() : void
{
    $taxonomies = array(
        'project_type' => array(
            'singular'     => 'Project Type',
            'plural'       => 'Project Types',
            'rewrite_slug' => 'project-type',
            'hierarchical' => true,
        ),
        'project_feature' => array(
            'singular'     => 'Project Feature',
            'plural'       => 'Project Features',
            'rewrite_slug' => 'project-feature',
            'hierarchical' => false,
        ),
        'technology' => array(
            'singular'     => 'Technology',
            'plural'       => 'Technologies',
            'rewrite_slug' => 'technology',
            'hierarchical' => false,
        ),
    );

    foreach ( $taxonomies as $taxonomy => $settings ) {
        register_taxonomy(
            $taxonomy,
            array( 'projects' ),
            array(
                'labels'            => array(
                    'name'                       => $settings['plural'],
                    'singular_name'              => $settings['singular'],
                    'search_items'               => 'Search ' . $settings['plural'],
                    'all_items'                  => 'All ' . $settings['plural'],
                    'parent_item'                => $settings['hierarchical'] ? 'Parent ' . $settings['singular'] : null,
                    'parent_item_colon'          => $settings['hierarchical'] ? 'Parent ' . $settings['singular'] . ':' : null,
                    'edit_item'                  => 'Edit ' . $settings['singular'],
                    'update_item'                => 'Update ' . $settings['singular'],
                    'add_new_item'               => 'Add New ' . $settings['singular'],
                    'new_item_name'              => 'New ' . $settings['singular'] . ' Name',
                    'separate_items_with_commas' => ! $settings['hierarchical'] ? 'Separate ' . strtolower( $settings['plural'] ) . ' with commas' : null,
                    'add_or_remove_items'        => ! $settings['hierarchical'] ? 'Add or remove ' . strtolower( $settings['plural'] ) : null,
                    'choose_from_most_used'      => ! $settings['hierarchical'] ? 'Choose from the most used ' . strtolower( $settings['plural'] ) : null,
                    'menu_name'                  => $settings['plural'],
                ),
                'public'            => true,
                'hierarchical'      => $settings['hierarchical'],
                'show_ui'           => true,
                'show_admin_column' => true,
                'show_in_rest'      => true,
                'rewrite'           => array(
                    'slug'       => $settings['rewrite_slug'],
                    'with_front' => false,
                ),
            )
        );
    }

    // Keep the previous taxonomy available for older project posts without showing duplicate admin controls.
    if ( ! taxonomy_exists( 'technologies' ) ) {
        register_taxonomy(
            'technologies',
            array( 'projects' ),
            array(
                'labels'       => array(
                    'name'          => 'Legacy Technologies',
                    'singular_name' => 'Legacy Technology',
                ),
                'public'       => false,
                'show_ui'      => false,
                'show_in_rest' => false,
                'hierarchical' => false,
                'rewrite'      => false,
            )
        );
    }
}
add_action( 'init', 'horacebenjamin_register_projects_taxonomies' );

function horacebenjamin_seed_project_taxonomy_terms() : void
{
    if ( get_option( 'horacebenjamin_project_taxonomy_terms_seeded' ) ) {
        return;
    }

    $default_terms = array(
        'project_type' => array(
            'SaaS Application',
            'Booking System',
            'CRM',
            'Customer Portal',
            'Automation',
            'AI Integration',
            'Dashboard',
            'E-commerce',
            'WordPress',
        ),
        'project_feature' => array(
            'Role-Based Access',
            'Real-Time Updates',
            'Reporting & Analytics',
            'Team Collaboration',
            'Payments',
            'Email Notifications',
            'File Uploads',
            'API Integration',
            'Booking Management',
            'Calendar Sync',
            'Stripe Integration',
            'AI Chat',
            'Document Processing',
            'Multi-Tenant',
        ),
        'technology' => array(
            'Laravel',
            'PHP',
            'JavaScript',
            'TypeScript',
            'Vue.js',
            'Livewire',
            'Alpine.js',
            'Inertia.js',
            'MySQL',
            'PostgreSQL',
            'WordPress',
            'Docker',
            'AWS',
            'Stripe',
            'OpenAI',
            'REST APIs',
        ),
    );

    foreach ( $default_terms as $taxonomy => $terms ) {
        foreach ( $terms as $term_name ) {
            if ( ! term_exists( $term_name, $taxonomy ) ) {
                wp_insert_term( $term_name, $taxonomy );
            }
        }
    }

    update_option( 'horacebenjamin_project_taxonomy_terms_seeded', 1, false );
}
add_action( 'init', 'horacebenjamin_seed_project_taxonomy_terms', 20 );

function horacebenjamin_migrate_legacy_project_technologies() : void
{
    if ( get_option( 'horacebenjamin_legacy_project_technologies_migrated' ) || ! taxonomy_exists( 'technologies' ) || ! taxonomy_exists( 'technology' ) ) {
        return;
    }

    $project_ids = get_posts(
        array(
            'post_type'              => 'projects',
            'post_status'            => 'any',
            'posts_per_page'         => -1,
            'fields'                 => 'ids',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        )
    );

    foreach ( $project_ids as $project_id ) {
        $legacy_terms = get_the_terms( $project_id, 'technologies' );

        if ( empty( $legacy_terms ) || is_wp_error( $legacy_terms ) ) {
            continue;
        }

        $technology_term_ids = array();

        foreach ( $legacy_terms as $legacy_term ) {
            $technology_term = term_exists( $legacy_term->name, 'technology' );

            if ( ! $technology_term ) {
                $technology_term = wp_insert_term(
                    $legacy_term->name,
                    'technology',
                    array(
                        'slug' => $legacy_term->slug,
                    )
                );
            }

            if ( ! is_wp_error( $technology_term ) && ! empty( $technology_term['term_id'] ) ) {
                $technology_term_ids[] = (int) $technology_term['term_id'];
            }
        }

        if ( ! empty( $technology_term_ids ) ) {
            wp_set_object_terms( $project_id, $technology_term_ids, 'technology', true );
        }
    }

    update_option( 'horacebenjamin_legacy_project_technologies_migrated', 1, false );
}
add_action( 'init', 'horacebenjamin_migrate_legacy_project_technologies', 30 );

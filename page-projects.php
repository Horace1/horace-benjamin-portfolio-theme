<?php
/*
Template Name: Projects Page
*/
get_header();

$project_stats = array(
    array(
        'icon'  => 'fa-regular fa-folder-open',
        'value' => '10+',
        'label' => 'Projects Completed',
    ),
    array(
        'icon'  => 'fa-solid fa-users',
        'value' => '8+',
        'label' => 'Happy Clients',
    ),
    array(
        'icon'  => 'fa-regular fa-calendar-days',
        'value' => '5+',
        'label' => 'Years Experience',
    ),
    array(
        'icon'  => 'fa-solid fa-rocket',
        'value' => '100%',
        'label' => 'Commitment',
    ),
);

$fallback_projects = array(
    array(
        'title'       => 'Operations Management Platform',
        'description' => 'A comprehensive platform to manage projects, tasks, team collaboration and reporting. Built with Laravel, Livewire and Alpine.js for a smooth and dynamic experience.',
        'features'    => array(
            'Role-based access and permissions',
            'Real-time task updates with Livewire',
            'Advanced reporting and analytics',
            'Team collaboration and file sharing',
        ),
        'terms'       => array( 'Laravel', 'Livewire', 'Alpine.js', 'MySQL' ),
        'type'        => 'Web Application',
        'featured'    => true,
        'visual'      => 'kanban',
        'date'        => 4,
    ),
    array(
        'title'       => 'Events & Registration Platform',
        'description' => 'A complete event management system to create, manage and promote events. Includes ticketing, attendee management and email notifications.',
        'features'    => array(
            'Event creation and ticket management',
            'Attendee registration and check-in',
            'Email notifications and reminders',
            'Reporting and analytics dashboard',
        ),
        'terms'       => array( 'Laravel', 'Vue.js', 'Inertia.js', 'MySQL', 'Stripe' ),
        'type'        => 'SaaS Platform',
        'featured'    => true,
        'visual'      => 'calendar',
        'date'        => 3,
    ),
    array(
        'title'       => 'Inventory Management System',
        'description' => 'An inventory management system for tracking stock levels, managing products, categories, suppliers and reporting stock movements.',
        'features'    => array(
            'Product and category management',
            'Stock-in and stock-out tracking',
            'Low stock alerts and reports',
            'RESTful APIs for data management',
        ),
        'terms'       => array( 'Laravel', 'MySQL', 'Bootstrap', 'APIs' ),
        'type'        => 'Admin System',
        'featured'    => false,
        'visual'      => 'inventory',
        'date'        => 2,
    ),
    array(
        'title'       => 'Digital Agency Theme (WordPress)',
        'description' => 'A custom WordPress theme and companion plugin built for digital agencies to showcase services, team members, testimonials and case studies.',
        'features'    => array(
            'Fully responsive and SEO friendly',
            'Custom block patterns and components',
            'Testimonials, services and portfolio sections',
            'Easy theme options via custom plugin',
        ),
        'terms'       => array( 'WordPress', 'ACF', 'Sass', 'PHP' ),
        'type'        => 'WordPress',
        'featured'    => false,
        'visual'      => 'agency',
        'date'        => 1,
    ),
);

$get_selected_terms = static function ( string $key ) : array {
    $raw_value = isset( $_GET[ $key ] ) ? wp_unslash( $_GET[ $key ] ) : array();
    $raw_values = is_array( $raw_value ) ? $raw_value : array( $raw_value );

    return array_values( array_filter( array_map( 'sanitize_title', $raw_values ) ) );
};

$selected_project_types = $get_selected_terms( 'project_type' );
$selected_technologies = $get_selected_terms( 'technology' );
$selected_project_features = $get_selected_terms( 'project_feature' );
$selected_sort = isset( $_GET['project_sort'] ) ? sanitize_key( wp_unslash( $_GET['project_sort'] ) ) : 'latest';
$selected_search = isset( $_GET['project_search'] ) ? sanitize_text_field( wp_unslash( $_GET['project_search'] ) ) : '';
$allowed_sort_values = array( 'latest', 'oldest', 'az', 'za' );

if ( ! in_array( $selected_sort, $allowed_sort_values, true ) ) {
    $selected_sort = 'latest';
}

$published_project_counts = wp_count_posts( 'projects' );
$has_published_projects = ! empty( $published_project_counts->publish );
$has_active_filters = ! empty( $selected_project_types ) || ! empty( $selected_technologies ) || ! empty( $selected_project_features ) || ! empty( $selected_search ) || 'latest' !== $selected_sort;

$project_terms = get_terms(
    array(
        'taxonomy'   => 'project_type',
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

$technology_terms = get_terms(
    array(
        'taxonomy'   => 'technology',
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

$feature_terms = get_terms(
    array(
        'taxonomy'   => 'project_feature',
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

$project_args = array(
    'post_type'      => 'projects',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'no_found_rows'  => true,
);

switch ( $selected_sort ) {
    case 'oldest':
        $project_args['orderby'] = 'date';
        $project_args['order'] = 'ASC';
        break;
    case 'az':
        $project_args['orderby'] = 'title';
        $project_args['order'] = 'ASC';
        break;
    case 'za':
        $project_args['orderby'] = 'title';
        $project_args['order'] = 'DESC';
        break;
    case 'latest':
    default:
        $project_args['orderby'] = 'date';
        $project_args['order'] = 'DESC';
        break;
}

$tax_query = array();

if ( ! empty( $selected_project_types ) ) {
    $tax_query[] = array(
        'taxonomy' => 'project_type',
        'field'    => 'slug',
        'terms'    => $selected_project_types,
    );
}

if ( ! empty( $selected_technologies ) ) {
    $tax_query[] = array(
        'taxonomy' => 'technology',
        'field'    => 'slug',
        'terms'    => $selected_technologies,
    );
}

if ( ! empty( $selected_project_features ) ) {
    $tax_query[] = array(
        'taxonomy' => 'project_feature',
        'field'    => 'slug',
        'terms'    => $selected_project_features,
    );
}

if ( ! empty( $tax_query ) ) {
    $project_args['tax_query'] = array_merge( array( 'relation' => 'AND' ), $tax_query );
}

$project_search_filter = null;

if ( '' !== $selected_search ) {
    global $wpdb;

    $project_search_filter = static function ( string $where ) use ( $wpdb, $selected_search ) : string {
        $search_like = '%' . $wpdb->esc_like( $selected_search ) . '%';

        return $where . $wpdb->prepare(
            " AND ({$wpdb->posts}.post_title LIKE %s OR {$wpdb->posts}.post_excerpt LIKE %s)",
            $search_like,
            $search_like
        );
    };

    add_filter( 'posts_where', $project_search_filter );
}

$project_query = new WP_Query( $project_args );

if ( null !== $project_search_filter ) {
    remove_filter( 'posts_where', $project_search_filter );
}

$get_term_names = static function ( int $post_id, string $taxonomy ) : array {
    $terms = get_the_terms( $post_id, $taxonomy );

    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return array();
    }

    return wp_list_pluck( $terms, 'name' );
};

$get_term_slugs = static function ( int $post_id, string $taxonomy ) : array {
    $terms = get_the_terms( $post_id, $taxonomy );

    if ( empty( $terms ) || is_wp_error( $terms ) ) {
        return array();
    }

    return wp_list_pluck( $terms, 'slug' );
};
?>

<main class="projects-page">
    <section class="projects-page-hero">
        <div class="container">
            <div class="projects-page-hero__grid">
                <div class="projects-page-hero__content">
                    <p class="projects-page__eyebrow">My Projects</p>
                    <h1>Software That Solves Real Business Problems</h1>
                    <p>Explore a collection of web applications, business systems and digital products built to solve operational challenges and improve the way organisations work. Each project demonstrates a focus on clean architecture, scalable development and delivering meaningful business outcomes.</p>
<!--                    <div class="projects-page-hero__stats" aria-label="Project statistics">-->
<!--                        --><?php //foreach ( $project_stats as $stat ) : ?>
<!--                            <div class="projects-page-stat">-->
<!--                                <i class="--><?php //echo esc_attr( $stat['icon'] ); ?><!--" aria-hidden="true"></i>-->
<!--                                <strong>--><?php //echo esc_html( $stat['value'] ); ?><!--</strong>-->
<!--                                <span>--><?php //echo esc_html( $stat['label'] ); ?><!--</span>-->
<!--                            </div>-->
<!--                        --><?php //endforeach; ?>
<!--                    </div>-->
                </div>
                <div class="projects-page-hero__visual" aria-hidden="true">
                    <div class="projects-dashboard">
                        <div class="projects-dashboard__sidebar">
                            <span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <div class="projects-dashboard__main">
                            <div class="projects-dashboard__top"></div>
                            <div class="projects-dashboard__cards">
                                <span></span><span></span><span></span>
                            </div>
                            <div class="projects-dashboard__chart">
                                <span></span><span></span><span></span><span></span><span></span><span></span>
                            </div>
                        </div>
                        <div class="projects-dashboard__panel">
                            <span></span><span></span><span></span><span></span>
                        </div>
                    </div>
                    <div class="projects-page-hero__dots"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="projects-page-list">
        <div class="container">
            <form class="projects-filter" method="get" action="<?php echo esc_url( get_permalink() ); ?>" aria-label="Project filters">
                <div class="projects-filter__field">
                    <span>Project Type</span>
                    <details class="projects-filter__multi" data-project-filter="type">
                        <summary>
                            <i class="fa-solid fa-grip" aria-hidden="true"></i>
                            <span data-project-filter-label>All Project Types</span>
                        </summary>
                        <div class="projects-filter__multi-menu">
                        <?php if ( ! empty( $project_terms ) && ! is_wp_error( $project_terms ) ) : ?>
                            <?php foreach ( $project_terms as $project_term ) : ?>
                                <label>
                                    <input type="checkbox" name="project_type[]" value="<?php echo esc_attr( $project_term->slug ); ?>" <?php checked( in_array( $project_term->slug, $selected_project_types, true ) ); ?>>
                                    <span><?php echo esc_html( $project_term->name ); ?></span>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </details>
                </div>
                <div class="projects-filter__field">
                    <span>Technologies</span>
                    <details class="projects-filter__multi" data-project-filter="technology">
                        <summary>
                            <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                            <span data-project-filter-label>All Technologies</span>
                        </summary>
                        <div class="projects-filter__multi-menu">
                        <?php if ( ! empty( $technology_terms ) && ! is_wp_error( $technology_terms ) ) : ?>
                            <?php foreach ( $technology_terms as $technology_term ) : ?>
                                <label>
                                    <input type="checkbox" name="technology[]" value="<?php echo esc_attr( $technology_term->slug ); ?>" <?php checked( in_array( $technology_term->slug, $selected_technologies, true ) ); ?>>
                                    <span><?php echo esc_html( $technology_term->name ); ?></span>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </details>
                </div>
                <div class="projects-filter__field">
                    <span>Features</span>
                    <details class="projects-filter__multi" data-project-filter="feature">
                        <summary>
                            <i class="fa-solid fa-list-check" aria-hidden="true"></i>
                            <span data-project-filter-label>All Features</span>
                        </summary>
                        <div class="projects-filter__multi-menu">
                        <?php if ( ! empty( $feature_terms ) && ! is_wp_error( $feature_terms ) ) : ?>
                            <?php foreach ( $feature_terms as $feature_term ) : ?>
                                <label>
                                    <input type="checkbox" name="project_feature[]" value="<?php echo esc_attr( $feature_term->slug ); ?>" <?php checked( in_array( $feature_term->slug, $selected_project_features, true ) ); ?>>
                                    <span><?php echo esc_html( $feature_term->name ); ?></span>
                                </label>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </details>
                </div>
                <label class="projects-filter__sort">
                    <span>Sort by:</span>
                    <select class="projects-filter__control" name="project_sort" data-project-filter="sort">
                        <option value="latest" <?php selected( $selected_sort, 'latest' ); ?>>Latest</option>
                        <option value="oldest" <?php selected( $selected_sort, 'oldest' ); ?>>Oldest</option>
                        <option value="az" <?php selected( $selected_sort, 'az' ); ?>>A-Z</option>
                        <option value="za" <?php selected( $selected_sort, 'za' ); ?>>Z-A</option>
                    </select>
                </label>
                <label class="projects-filter__search">
                    <span class="visually-hidden">Search projects</span>
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                    <input class="projects-filter__control" type="search" name="project_search" value="<?php echo esc_attr( $selected_search ); ?>" placeholder="Search projects..." data-project-filter="search">
                </label>
                <div class="projects-filter__actions">
                    <button class="projects-filter__submit" type="submit">Apply Filters</button>
                    <a class="projects-filter__clear" href="<?php echo esc_url( get_permalink() ); ?>">Clear Filters</a>
                </div>
            </form>

            <div class="projects-page-list__items" data-projects-list>
                <?php if ( $project_query->have_posts() ) : ?>
                    <?php while ( $project_query->have_posts() ) : $project_query->the_post(); ?>
                        <?php
                        $type_names = $get_term_names( get_the_ID(), 'project_type' );
                        $type_slugs = $get_term_slugs( get_the_ID(), 'project_type' );
                        $feature_names = $get_term_names( get_the_ID(), 'project_feature' );
                        $feature_slugs = $get_term_slugs( get_the_ID(), 'project_feature' );
                        $technology_names = $get_term_names( get_the_ID(), 'technology' );
                        $technology_slugs = $get_term_slugs( get_the_ID(), 'technology' );

                        if ( empty( $technology_names ) && taxonomy_exists( 'technologies' ) ) {
                            $technology_names = $get_term_names( get_the_ID(), 'technologies' );
                            $technology_slugs = $get_term_slugs( get_the_ID(), 'technologies' );
                        }

                        $features = ! empty( $type_names ) ? $type_names : $feature_names;
                        $live_demo_url = get_post_meta( get_the_ID(), 'live_demo_url', true );
                        $github_url = get_post_meta( get_the_ID(), 'github_url', true );
                        ?>
                        <article class="projects-list-card" data-project-card data-title="<?php echo esc_attr( strtolower( get_the_title() ) ); ?>" data-type="<?php echo esc_attr( implode( ' ', $type_slugs ) ); ?>" data-tech="<?php echo esc_attr( implode( ' ', $technology_slugs ) ); ?>" data-feature="<?php echo esc_attr( implode( ' ', $feature_slugs ) ); ?>" data-date="<?php echo esc_attr( get_the_date( 'U' ) ); ?>">
                            <div class="projects-list-card__media projects-list-card__media--image">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'large', array( 'class' => 'projects-list-card__image' ) ); ?>
                                <?php else : ?>
                                    <div class="projects-mini-ui projects-mini-ui--kanban" aria-hidden="true"></div>
                                <?php endif; ?>
                            </div>
                            <div class="projects-list-card__content">
                                <div class="projects-list-card__heading">
                                    <h2><?php echo esc_html( get_the_title() ); ?></h2>
                                    <?php if ( get_post_meta( get_the_ID(), 'featured_project', true ) ) : ?>
                                        <span>Featured</span>
                                    <?php endif; ?>
                                </div>
                                <p><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 36, '...' ) ); ?></p>
                                <ul class="projects-list-card__features">
                                    <?php foreach ( $features as $feature ) : ?>
                                        <li><?php echo esc_html( $feature ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <ul class="projects-list-card__tech">
                                    <?php foreach ( array_slice( $technology_names, 0, 6 ) as $term_name ) : ?>
                                        <li><?php echo esc_html( $term_name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="projects-list-card__actions">
                                <a class="projects-list-card__button projects-list-card__button--yellow" href="<?php echo esc_url( ! empty( $live_demo_url ) ? $live_demo_url : get_permalink() ); ?>" <?php echo ! empty( $live_demo_url ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                    Live Demo
                                    <i class="fa-solid fa-up-right-from-square" aria-hidden="true"></i>
                                </a>
                                <a class="projects-list-card__button" href="<?php echo esc_url( get_permalink() ); ?>">
                                    View Case Study
                                    <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                                </a>
                                <a class="projects-list-card__button" href="<?php echo esc_url( ! empty( $github_url ) ? $github_url : 'https://github.com/' ); ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-github" aria-hidden="true"></i>
                                    View Code 
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php elseif ( ! $has_published_projects && ! $has_active_filters ) : ?>
                    <?php foreach ( $fallback_projects as $fallback_project ) : ?>
                        <?php $fallback_slugs = array_map( 'sanitize_title', $fallback_project['terms'] ); ?>
                        <?php $fallback_feature_slugs = array_map( 'sanitize_title', $fallback_project['features'] ); ?>
                        <article class="projects-list-card" data-project-card data-title="<?php echo esc_attr( strtolower( $fallback_project['title'] ) ); ?>" data-type="<?php echo esc_attr( sanitize_title( $fallback_project['type'] ) ); ?>" data-tech="<?php echo esc_attr( implode( ' ', $fallback_slugs ) ); ?>" data-feature="<?php echo esc_attr( implode( ' ', $fallback_feature_slugs ) ); ?>" data-date="<?php echo esc_attr( $fallback_project['date'] ); ?>">
                            <div class="projects-list-card__media">
                                <div class="projects-mini-ui projects-mini-ui--<?php echo esc_attr( $fallback_project['visual'] ); ?>" aria-hidden="true">
                                    <span></span><span></span><span></span><span></span><span></span><span></span>
                                </div>
                            </div>
                            <div class="projects-list-card__content">
                                <div class="projects-list-card__heading">
                                    <h2><?php echo esc_html( $fallback_project['title'] ); ?></h2>
                                    <?php if ( $fallback_project['featured'] ) : ?>
                                        <span>Featured</span>
                                    <?php endif; ?>
                                </div>
                                <p><?php echo esc_html( $fallback_project['description'] ); ?></p>
                                <ul class="projects-list-card__features">
                                    <li><?php echo esc_html( $fallback_project['type'] ); ?></li>
                                </ul>
                                <ul class="projects-list-card__tech">
                                    <?php foreach ( $fallback_project['terms'] as $term_name ) : ?>
                                        <li><?php echo esc_html( $term_name ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="projects-list-card__actions">
                                <a class="projects-list-card__button projects-list-card__button--yellow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                                    Live Demo
                                    <i class="fa-solid fa-up-right-from-square" aria-hidden="true"></i>
                                </a>
                                <a class="projects-list-card__button" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>">
                                    View Case Study
                                    <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                                </a>
                                <a class="projects-list-card__button" href="https://github.com/" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-github" aria-hidden="true"></i>
                                    View Code 
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <p class="projects-page-list__empty <?php echo ( $has_published_projects || $has_active_filters ) && 0 === (int) $project_query->post_count ? 'is-visible' : ''; ?>" data-projects-empty>No projects match those filters.</p>

            <div class="projects-github-cta">
                <i class="fa-brands fa-github" aria-hidden="true"></i>
                <div>
                    <h2>Want to see more of my work?</h2>
                    <p>Check out my GitHub profile for more projects and contributions.</p>
                </div>
                <a class="btn btn-custom-yellow" href="https://github.com/" target="_blank" rel="noopener noreferrer">
                    View All Repositories
                    <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

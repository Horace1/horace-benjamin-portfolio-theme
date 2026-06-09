<?php
/**
 * Archive template.
 *
 * @package horacebenjaminportfolio
 */

get_header();

global $wpdb;

$posts_page_id        = (int) get_option( 'page_for_posts' );
$blog_url             = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );
$archive_title        = get_the_archive_title();
$archive_description  = get_the_archive_description();
$published_post_count = (int) wp_count_posts( 'post' )->publish;
$posts_per_page       = max( 1, (int) get_option( 'posts_per_page' ) );
$archive_month_limit  = max( 0, (int) apply_filters( 'hbp_archive_month_limit', 0 ) );
$recent_posts_limit   = max( 1, (int) apply_filters( 'hbp_archive_recent_posts_limit', $posts_per_page ) );
$sidebar_categories   = get_categories(
    array(
        'taxonomy'   => 'category',
        'hide_empty' => true,
        'orderby'    => 'name',
    )
);
$archive_limit_sql    = $archive_month_limit > 0 ? $wpdb->prepare( ' LIMIT %d', $archive_month_limit ) : '';
$archive_items        = $wpdb->get_results(
    "SELECT YEAR(post_date) AS year, MONTH(post_date) AS month, COUNT(ID) AS post_count
    FROM {$wpdb->posts}
    WHERE post_type = 'post'
    AND post_status = 'publish'
    GROUP BY YEAR(post_date), MONTH(post_date)
    ORDER BY post_date DESC" . $archive_limit_sql
);
$recent_posts         = get_posts(
    array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => $recent_posts_limit,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    )
);
$grouped_posts        = array();

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();

        $month_key = get_the_date( 'F Y' );

        if ( ! isset( $grouped_posts[ $month_key ] ) ) {
            $grouped_posts[ $month_key ] = array();
        }

        $grouped_posts[ $month_key ][] = get_post();
    }
}
?>

<main class="archive-page">
    <section class="archive-page-section">
        <div class="container">
            <div class="archive-page-layout">
                <div class="archive-page-main">
                    <nav class="archive-page-breadcrumb" aria-label="Breadcrumb">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                        <span aria-hidden="true">&gt;</span>
                        <a href="<?php echo esc_url( $blog_url ); ?>">Blog</a>
                        <span aria-hidden="true">&gt;</span>
                        <span><?php echo esc_html( wp_strip_all_tags( $archive_title ) ); ?></span>
                    </nav>

                    <header class="archive-page-header">
                        <h1><?php echo wp_kses_post( $archive_title ); ?></h1>
                        <?php if ( $archive_description ) : ?>
                            <div><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
                        <?php else : ?>
                            <p>Browse posts from this archive.</p>
                        <?php endif; ?>
                    </header>

                    <?php if ( ! empty( $grouped_posts ) ) : ?>
                        <div class="archive-month-list">
                            <?php foreach ( $grouped_posts as $month_label => $month_posts ) : ?>
                                <section class="archive-month-group">
                                    <div class="archive-month-heading">
                                        <h2><?php echo esc_html( $month_label ); ?></h2>
                                        <span><?php echo esc_html( count( $month_posts ) ); ?> posts</span>
                                    </div>

                                    <div class="archive-post-list">
                                        <?php foreach ( $month_posts as $archive_post ) : ?>
                                            <?php
                                            setup_postdata( $archive_post );

                                            $post_id         = get_the_ID();
                                            $post_categories = get_the_category( $post_id );
                                            $post_category   = ! empty( $post_categories ) ? $post_categories[0]->name : 'Blog';
                                            $post_read_time  = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) ) / 200 ) ) . ' min read';
                                            ?>
                                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post-card' ); ?>>
                                                <a class="archive-post-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                                                    <?php if ( has_post_thumbnail() ) : ?>
                                                        <?php the_post_thumbnail( 'medium_large', array( 'class' => 'archive-post-card__image' ) ); ?>
                                                    <?php else : ?>
                                                        <span class="blog-thumb blog-thumb--code" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
                                                    <?php endif; ?>
                                                </a>
                                                <div class="archive-post-card__body">
                                                    <span class="archive-post-card__category"><?php echo esc_html( $post_category ); ?></span>
                                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                    <div class="archive-post-card__meta">
                                                        <span><i class="fa-regular fa-calendar" aria-hidden="true"></i><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
                                                        <span aria-hidden="true">&bull;</span>
                                                        <span><i class="fa-regular fa-clock" aria-hidden="true"></i><?php echo esc_html( $post_read_time ); ?></span>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php endforeach; ?>
                                        <?php wp_reset_postdata(); ?>
                                    </div>
                                </section>
                            <?php endforeach; ?>
                        </div>

                        <?php
                        the_posts_pagination(
                            array(
                                'mid_size'           => 1,
                                'prev_text'          => '<i class="fa-solid fa-chevron-left" aria-hidden="true"></i><span class="visually-hidden">Previous</span>',
                                'next_text'          => '<span class="visually-hidden">Next</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i>',
                                'screen_reader_text' => 'Archive pagination',
                            )
                        );
                        ?>
                    <?php else : ?>
                        <div class="archive-month-list">
                            <section class="archive-month-group">
                                <div class="archive-month-heading">
                                    <h2>No posts found</h2>
                                    <span>0 posts</span>
                                </div>
                                <p>No posts were found for this archive.</p>
                            </section>
                        </div>
                    <?php endif; ?>

                    <section class="single-blog-cta archive-page-cta">
                        <span class="single-blog-cta__icon"><i class="fa-regular fa-paper-plane" aria-hidden="true"></i></span>
                        <div>
                            <h2>Have a project in mind?</h2>
                            <p>Let's work together to build something amazing.</p>
                        </div>
                        <a class="btn btn-custom-yellow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
                            Let's Talk
                            <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                        </a>
                    </section>
                </div>

                <aside class="archive-page-sidebar" aria-label="Blog sidebar">
                    <section class="blog-sidebar-card">
                        <h2>Search articles</h2>
                        <form class="blog-page-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <label class="visually-hidden" for="archive-blog-search">Search articles</label>
                            <input id="archive-blog-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="Search articles...">
                            <button type="submit" aria-label="Search">
                                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                            </button>
                        </form>
                    </section>

                    <section class="blog-sidebar-card">
                        <h2>Categories</h2>
                        <ul class="blog-topic-list">
                            <li>
                                <a href="<?php echo esc_url( $blog_url ); ?>"><span>All Posts</span><strong><?php echo esc_html( $published_post_count ); ?></strong></a>
                            </li>
                            <?php foreach ( $sidebar_categories as $sidebar_category ) : ?>
                                <?php $is_current_category = is_category( $sidebar_category->term_id ); ?>
                                <li>
                                    <a href="<?php echo esc_url( get_category_link( $sidebar_category ) ); ?>" <?php echo $is_current_category ? 'aria-current="page"' : ''; ?>>
                                        <span><?php echo esc_html( $sidebar_category->name ); ?></span>
                                        <strong><?php echo esc_html( $sidebar_category->count ); ?></strong>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>

                    <section class="blog-sidebar-card">
                        <h2>Archives</h2>
                        <ul class="blog-topic-list blog-archive-list">
                            <?php if ( ! empty( $archive_items ) ) : ?>
                                <?php foreach ( $archive_items as $archive_item ) : ?>
                                    <?php
                                    $archive_year       = (int) $archive_item->year;
                                    $archive_month      = (int) $archive_item->month;
                                    $is_current_archive = is_month() && (int) get_query_var( 'year' ) === $archive_year && (int) get_query_var( 'monthnum' ) === $archive_month;
                                    ?>
                                    <li>
                                        <a href="<?php echo esc_url( get_month_link( $archive_year, $archive_month ) ); ?>" <?php echo $is_current_archive ? 'aria-current="page"' : ''; ?>>
                                            <span><?php echo esc_html( date_i18n( 'F Y', mktime( 0, 0, 0, $archive_month, 1, $archive_year ) ) ); ?></span>
                                            <strong><?php echo esc_html( (int) $archive_item->post_count ); ?></strong>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li><span>No archives yet</span><strong>0</strong></li>
                            <?php endif; ?>
                        </ul>
                    </section>

                    <section class="blog-sidebar-card">
                        <h2>Recent Posts</h2>
                        <div class="single-recent-post-list">
                            <?php if ( ! empty( $recent_posts ) ) : ?>
                                <?php foreach ( $recent_posts as $recent_post ) : ?>
                                    <a class="single-recent-post" href="<?php echo esc_url( get_permalink( $recent_post ) ); ?>">
                                        <span class="single-recent-post__thumb">
                                            <?php if ( has_post_thumbnail( $recent_post ) ) : ?>
                                                <?php echo get_the_post_thumbnail( $recent_post, 'thumbnail' ); ?>
                                            <?php else : ?>
                                                <span class="blog-thumb blog-thumb--code" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
                                            <?php endif; ?>
                                        </span>
                                        <span>
                                            <strong><?php echo esc_html( get_the_title( $recent_post ) ); ?></strong>
                                            <time><?php echo esc_html( get_the_date( 'j F Y', $recent_post ) ); ?></time>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>No posts yet.</p>
                            <?php endif; ?>
                        </div>
                    </section>
                </aside>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

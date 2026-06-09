<?php
$selected_category = isset( $_GET['blog_category'] ) ? sanitize_text_field( wp_unslash( $_GET['blog_category'] ) ) : '';
$selected_search   = isset( $_GET['blog_search'] ) ? sanitize_text_field( wp_unslash( $_GET['blog_search'] ) ) : '';
$selected_sort     = isset( $_GET['blog_sort'] ) ? sanitize_text_field( wp_unslash( $_GET['blog_sort'] ) ) : 'latest';
$paged             = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );
$posts_per_page    = max( 1, (int) get_option( 'posts_per_page' ) );
$posts_page_id     = (int) get_option( 'page_for_posts' );
$blog_page_url     = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );

$fallback_posts = array(
    array(
        'category'  => 'Business Systems',
        'title'     => 'How Custom Software Can Save SMEs Thousands of Hours Per Year',
        'excerpt'   => 'Explore how tailored software solutions eliminate manual work, reduce errors and improve efficiency across your business.',
        'date'      => '12 June 2026',
        'read_time' => '5 min read',
        'style'     => 'workflow',
    ),
    array(
        'category'  => 'Laravel',
        'title'     => 'Building a Scalable Booking System with Laravel',
        'excerpt'   => 'A step-by-step guide to building a secure, feature-rich booking system using Laravel, queues and notifications.',
        'date'      => '5 June 2026',
        'read_time' => '8 min read',
        'style'     => 'calendar',
    ),
    array(
        'category'  => 'Vue.js',
        'title'     => 'Getting Started with Vue 3 Composition API',
        'excerpt'   => 'Learn how the Composition API works, when to use it and how it can help you write cleaner, more maintainable code.',
        'date'      => '29 May 2026',
        'read_time' => '6 min read',
        'style'     => 'vue',
    ),
    array(
        'category'  => 'WordPress',
        'title'     => 'WordPress Performance Optimisation: A Practical Checklist',
        'excerpt'   => 'Simple but effective steps to make your WordPress website faster, more secure and rank higher.',
        'date'      => '20 May 2026',
        'read_time' => '7 min read',
        'style'     => 'wordpress',
    ),
    array(
        'category'  => 'AI & Automation',
        'title'     => '5 Ways Automation Can Improve Your Business Processes',
        'excerpt'   => 'Discover practical ways to use AI and automation to save time, reduce costs and improve productivity.',
        'date'      => '12 May 2026',
        'read_time' => '6 min read',
        'style'     => 'workflow',
    ),
);

$category_args = array(
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'orderby'    => 'name',
);
$categories = get_categories( $category_args );
$published_post_count = (int) wp_count_posts( 'post' )->publish;
$archives = wp_get_archives(
    array(
        'type'            => 'monthly',
        'limit'           => 5,
        'show_post_count' => true,
        'echo'            => false,
        'format'          => 'custom',
        'before'          => '',
        'after'           => '',
    )
);

preg_match_all( '/<a[^>]+href=[\'"]([^\'"]+)[\'"][^>]*>(.*?)<\/a>(?:&nbsp;|\s)*\((\d+)\)/i', $archives, $archive_matches, PREG_SET_ORDER );

$blog_args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => $posts_per_page,
    'paged'               => $paged,
    'ignore_sticky_posts' => true,
);

if ( '' !== $selected_search ) {
    $blog_args['s'] = $selected_search;
}

if ( '' !== $selected_category ) {
    $blog_args['category_name'] = $selected_category;
}

if ( 'oldest' === $selected_sort ) {
    $blog_args['order'] = 'ASC';
} else {
    $blog_args['order'] = 'DESC';
}

$blog_query   = new WP_Query( $blog_args );
$has_real_posts = $blog_query->have_posts();
$recent_posts = get_posts(
    array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 4,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    )
);
?>

<main class="blog-page">
    <section class="blog-page-hero">
        <div class="container">
            <div class="blog-page-hero__grid">
                <div class="blog-page-hero__content">
                    <p class="blog-page__eyebrow">Blog</p>
                    <h1>Thoughts, tutorials and insights.</h1>
                    <p>Practical guides, lessons learned and insights from building web applications and business systems that make a difference.</p>
                </div>
                <div class="blog-page-hero__visual" aria-label="Article and code editor preview">
                    <div class="blog-page-hero__orb" aria-hidden="true"></div>
                    <div class="blog-page-hero__dots" aria-hidden="true"></div>
                    <div class="blog-page-laptop" aria-hidden="true">
                        <div class="blog-page-laptop__screen">
                            <span></span><span></span><span></span>
                            <div class="blog-page-laptop__image"></div>
                            <div class="blog-page-laptop__lines">
                                <i></i><i></i><i></i><i></i>
                            </div>
                            <div class="blog-page-laptop__code">
                                <strong>&lt;/&gt;</strong>
                                <code>1&nbsp;&nbsp;public function insights()</code>
                                <code>2&nbsp;&nbsp;return view('blog');</code>
                                <code>3&nbsp;&nbsp;$topics = ['Laravel'];</code>
                                <code>4&nbsp;&nbsp;echo $topic;</code>
                            </div>
                        </div>
                        <div class="blog-page-laptop__base"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-page-content">
        <div class="container">
            <form class="blog-page-toolbar" method="get" action="<?php echo esc_url( $blog_page_url ); ?>">
                <div class="blog-page-filter">
                    <label for="blog-category">Category:</label>
                    <select id="blog-category" name="blog_category" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                    <?php if ( ! empty( $categories ) ) : ?>
                        <?php foreach ( $categories as $category ) : ?>
                                <option value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( $selected_category, $category->slug ); ?>>
                                <?php echo esc_html( $category->name ); ?>
                                </option>
                        <?php endforeach; ?>
                    <?php else : ?>
                            <?php foreach ( array_unique( wp_list_pluck( $fallback_posts, 'category' ) ) as $topic_label ) : ?>
                                <option value="<?php echo esc_attr( sanitize_title( $topic_label ) ); ?>"><?php echo esc_html( $topic_label ); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </select>
                    <?php if ( '' !== $selected_search ) : ?>
                        <input type="hidden" name="blog_search" value="<?php echo esc_attr( $selected_search ); ?>">
                    <?php endif; ?>
                    <?php if ( '' !== $selected_sort ) : ?>
                        <input type="hidden" name="blog_sort" value="<?php echo esc_attr( $selected_sort ); ?>">
                    <?php endif; ?>
                </div>
                <div class="blog-page-sort">
                    <label for="blog-sort">Sort by:</label>
                    <?php if ( '' !== $selected_search ) : ?>
                        <input type="hidden" name="blog_search" value="<?php echo esc_attr( $selected_search ); ?>">
                    <?php endif; ?>
                    <?php if ( '' !== $selected_category ) : ?>
                        <input type="hidden" name="blog_category" value="<?php echo esc_attr( $selected_category ); ?>">
                    <?php endif; ?>
                    <select id="blog-sort" name="blog_sort" onchange="this.form.submit()">
                        <option value="latest" <?php selected( $selected_sort, 'latest' ); ?>>Latest</option>
                        <option value="oldest" <?php selected( $selected_sort, 'oldest' ); ?>>Oldest</option>
                    </select>
                </div>
            </form>

            <div class="blog-page-layout">
                <div class="blog-page-list">
                    <?php if ( $has_real_posts ) : ?>
                        <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                            <?php
                            $article_categories = get_the_category();
                            $article_category   = ! empty( $article_categories ) ? $article_categories[0]->name : 'Development';
                            $word_count         = str_word_count( wp_strip_all_tags( get_the_content() ) );
                            $read_time          = max( 1, (int) ceil( $word_count / 200 ) ) . ' min read';
                            ?>
                            <article class="blog-list-card">
                                <a class="blog-list-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium_large', array( 'class' => 'blog-list-card__image' ) ); ?>
                                    <?php else : ?>
                                        <span class="blog-thumb blog-thumb--code" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
                                    <?php endif; ?>
                                </a>
                                <div class="blog-list-card__body">
                                    <span class="blog-list-card__category"><?php echo esc_html( $article_category ); ?></span>
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <p><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 24, '...' ) ); ?></p>
                                    <div class="blog-list-card__meta">
                                        <span><i class="fa-regular fa-calendar" aria-hidden="true"></i><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
                                        <span><i class="fa-regular fa-clock" aria-hidden="true"></i><?php echo esc_html( $read_time ); ?></span>
                                        <span><i class="fa-regular fa-user" aria-hidden="true"></i>By Horace Benjamin</span>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php else : ?>
                        <?php foreach ( $fallback_posts as $fallback_post ) : ?>
                            <article class="blog-list-card">
                                <div class="blog-list-card__media">
                                    <span class="blog-thumb blog-thumb--<?php echo esc_attr( $fallback_post['style'] ); ?>" aria-hidden="true"><span></span><span></span><span></span><span></span></span>
                                </div>
                                <div class="blog-list-card__body">
                                    <span class="blog-list-card__category"><?php echo esc_html( $fallback_post['category'] ); ?></span>
                                    <h2><?php echo esc_html( $fallback_post['title'] ); ?></h2>
                                    <p><?php echo esc_html( $fallback_post['excerpt'] ); ?></p>
                                    <div class="blog-list-card__meta">
                                        <span><i class="fa-regular fa-calendar" aria-hidden="true"></i><?php echo esc_html( $fallback_post['date'] ); ?></span>
                                        <span><i class="fa-regular fa-clock" aria-hidden="true"></i><?php echo esc_html( $fallback_post['read_time'] ); ?></span>
                                        <span><i class="fa-regular fa-user" aria-hidden="true"></i>By Horace Benjamin</span>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if ( $blog_query->max_num_pages > 1 ) : ?>
                        <nav class="blog-page-pagination" aria-label="Blog pagination">
                            <?php
                            echo wp_kses_post(
                                paginate_links(
                                    array(
                                        'total'     => $blog_query->max_num_pages,
                                        'current'   => $paged,
                                        'prev_text' => '<i class="fa-solid fa-chevron-left" aria-hidden="true"></i>',
                                        'next_text' => '<i class="fa-solid fa-chevron-right" aria-hidden="true"></i>',
                                    )
                                )
                            );
                            ?>
                        </nav>
                    <?php elseif ( ! $has_real_posts ) : ?>
                        <nav class="blog-page-pagination" aria-label="Blog pagination">
                            <span class="page-numbers is-muted"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i>Previous</span>
                            <span class="page-numbers current">1</span>
                            <span class="page-numbers">2</span>
                            <span class="page-numbers">3</span>
                            <span class="page-numbers dots">...</span>
                            <span class="page-numbers">8</span>
                            <span class="page-numbers">Next<i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
                        </nav>
                    <?php endif; ?>
                </div>

                <aside class="blog-page-sidebar" aria-label="Blog sidebar">
                    <section class="blog-sidebar-card">
                        <h2>Search articles</h2>
                        <form class="blog-page-search" method="get" action="<?php echo esc_url( $blog_page_url ); ?>">
                            <label class="visually-hidden" for="blog-search">Search articles</label>
                            <input id="blog-search" type="search" name="blog_search" value="<?php echo esc_attr( $selected_search ); ?>" placeholder="Search articles...">
                            <button type="submit" aria-label="Search">
                                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                            </button>
                        </form>
                    </section>

                    <section class="blog-sidebar-card">
                        <h2>Categories</h2>
                        <ul class="blog-topic-list">
                            <li>
                                <a href="<?php echo esc_url( $blog_page_url ); ?>"><span>All Categories</span><strong><?php echo esc_html( $published_post_count ); ?></strong></a>
                            </li>
                            <?php if ( ! empty( $categories ) ) : ?>
                                <?php foreach ( $categories as $category ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( 'blog_category', $category->slug, $blog_page_url ) ); ?>">
                                            <span><?php echo esc_html( $category->name ); ?></span>
                                            <strong><?php echo esc_html( $category->count ); ?></strong>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php foreach ( array_count_values( wp_list_pluck( $fallback_posts, 'category' ) ) as $topic_label => $term_count ) : ?>
                                    <li><span><?php echo esc_html( $topic_label ); ?></span><strong><?php echo esc_html( $term_count ); ?></strong></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </section>

                    <section class="blog-sidebar-card">
                        <h2>Archives</h2>
                        <ul class="blog-topic-list blog-archive-list">
                            <?php if ( ! empty( $archive_matches ) ) : ?>
                                <?php foreach ( $archive_matches as $archive_match ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( $archive_match[1] ); ?>">
                                            <span><?php echo esc_html( wp_strip_all_tags( $archive_match[2] ) ); ?></span>
                                            <strong><?php echo esc_html( $archive_match[3] ); ?></strong>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li><span>No archives yet</span><strong>0</strong></li>
                            <?php endif; ?>
                        </ul>
                        <a class="blog-older-archives" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Older Archives <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
                    </section>

                    <section class="blog-sidebar-card">
                        <h2>Recent Comments</h2>
                        <p>No comments to show.</p>
                    </section>
                </aside>
            </div>

            <section class="single-blog-cta blog-page-cta">
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
    </section>
</main>

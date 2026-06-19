<?php
/**
 * Single blog post template.
 *
 * @package horacebenjaminportfolio
 */

get_header();

while ( have_posts() ) :
    the_post();

    $posts_page_id        = (int) get_option( 'page_for_posts' );
    $blog_url             = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );
    $categories           = get_the_category();
    $primary_category     = ! empty( $categories ) ? $categories[0]->name : 'Blog';
    $selected_search      = isset( $_GET['blog_search'] ) ? sanitize_text_field( wp_unslash( $_GET['blog_search'] ) ) : '';
    $word_count           = str_word_count( wp_strip_all_tags( get_the_content() ) );
    $read_time            = max( 1, (int) ceil( $word_count / 200 ) );
    $post_tags            = get_the_tags();
    $published_post_count = (int) wp_count_posts( 'post' )->publish;
    $category_args        = array(
        'taxonomy'   => 'category',
        'hide_empty' => true,
        'orderby'    => 'name',
    );
    $sidebar_categories   = get_categories( $category_args );
    $archives             = wp_get_archives(
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
    $recent_posts         = get_posts(
        array(
            'post_type'           => 'post',
            'post_status'         => 'publish',
            'posts_per_page'      => 5,
            'post__not_in'        => array( get_the_ID() ),
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        )
    );

    preg_match_all( '/<a[^>]+href=[\'"]([^\'"]+)[\'"][^>]*>(.*?)<\/a>(?:&nbsp;|\s)*\((\d+)\)/i', $archives, $archive_matches, PREG_SET_ORDER );
    ?>

    <main class="single-article-page">
        <section class="single-article-section">
            <div class="container">
                <div class="single-article-layout">
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article-main' ); ?>>
                        <nav class="single-article-breadcrumb" aria-label="Breadcrumb">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                            <span aria-hidden="true">&gt;</span>
                            <a href="<?php echo esc_url( $blog_url ); ?>">Blog</a>
                            <span aria-hidden="true">&gt;</span>
                            <span><?php echo esc_html( get_the_title() ); ?></span>
                        </nav>

                        <p class="single-article-eyebrow"><?php echo esc_html( $primary_category ); ?></p>
                        <h1><?php the_title(); ?></h1>
                        <div class="single-article-excerpt">
                            <?php if ( has_excerpt() ) : ?>
                                <p><?php echo esc_html( get_the_excerpt() ); ?></p>
                            <?php else : ?>
                                <p><?php echo esc_html( wp_trim_words( get_the_content(), 24, '.' ) ); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <figure class="single-blog-featured-image">
                                <?php the_post_thumbnail( 'full' ); ?>
                            </figure>
                        <?php endif; ?>
                        <div class="single-article-meta">
                            <span><i class="fa-regular fa-calendar" aria-hidden="true"></i><?php echo esc_html( get_the_date( 'j F Y' ) ); ?></span>
                            <span><i class="fa-regular fa-clock" aria-hidden="true"></i><?php echo esc_html( $read_time ); ?> min read</span>
                            <span><i class="fa-regular fa-user" aria-hidden="true"></i>By Horace Benjamin</span>
                        </div>

                        <div class="single-article-divider"></div>

                        <div class="single-article-content">
                            <?php the_content(); ?>
                        </div>

                        <div class="single-article-share">
                            <h2>Share this article</h2>
                            <div>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode( get_permalink() ); ?>&text=<?php echo rawurlencode( get_the_title() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on X">
                                    <i class="fa-brands fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn">
                                    <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode( get_permalink() ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook">
                                    <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
                                </a>
                                <a href="<?php echo esc_url( get_permalink() ); ?>" aria-label="Copy article link">
                                    <i class="fa-solid fa-link" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        <section class="single-blog-cta single-article-cta">
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
                    </article>

                    <aside class="single-article-sidebar" aria-label="Blog sidebar">
                        <section class="blog-sidebar-card">
                            <h2>Search articles</h2>
                            <form class="blog-page-search" method="get" action="<?php echo esc_url( $blog_url ); ?>">
                                <label class="visually-hidden" for="single-blog-search">Search articles</label>
                                <input id="single-blog-search" type="search" name="blog_search" value="<?php echo esc_attr( $selected_search ); ?>" placeholder="Search articles...">
                                <button type="submit" aria-label="Search">
                                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                                </button>
                            </form>
                        </section>

                        <section class="blog-sidebar-card">
                            <h2>Categories</h2>
                            <ul class="blog-topic-list">
                                <li>
                                    <a href="<?php echo esc_url( $blog_url ); ?>"><span>All Categories</span><strong><?php echo esc_html( $published_post_count ); ?></strong></a>
                                </li>
                                <?php foreach ( $sidebar_categories as $sidebar_category ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( add_query_arg( 'blog_category', $sidebar_category->slug, $blog_url ) ); ?>">
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
                            <a class="blog-older-archives" href="<?php echo esc_url( $blog_url ); ?>">Older Archives <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i></a>
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

                        <section class="blog-sidebar-card">
                            <h2>Tags</h2>
                            <div class="single-article-tags">
                                <?php if ( ! empty( $post_tags ) ) : ?>
                                    <?php foreach ( $post_tags as $post_tag ) : ?>
                                        <a href="<?php echo esc_url( get_tag_link( $post_tag ) ); ?>"><?php echo esc_html( $post_tag->name ); ?></a>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>No tags yet.</p>
                                <?php endif; ?>
                            </div>
                        </section>
                    </aside>
                </div>
            </div>
        </section>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>

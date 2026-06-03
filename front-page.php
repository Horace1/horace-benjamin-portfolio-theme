<?php
get_header();

$services = array(
    array(
        'icon'        => 'fa-solid fa-window-restore',
        'title'       => 'Web Application Development',
        'description' => 'Custom web applications built with Laravel, Vue.js and modern tools.',
    ),
    array(
        'icon'        => 'fa-solid fa-chart-line',
        'title'       => 'Admin Dashboards & Systems',
        'description' => 'Powerful admin panels and dashboards to manage your business.',
    ),
    array(
        'icon'        => 'fa-solid fa-code-branch',
        'title'       => 'API Development & Integration',
        'description' => 'RESTful APIs and third-party integrations to extend your platforms.',
    ),
    array(
        'icon'        => 'fa-brands fa-wordpress',
        'title'       => 'WordPress Development',
        'description' => 'Custom themes, plugins and sites tailored to your needs.',
    ),
    array(
        'icon'        => 'fa-solid fa-table-cells',
        'title'       => 'Database Design & Optimisation',
        'description' => 'Well-structured databases built for performance and scalability.',
    ),
    array(
        'icon'        => 'fa-solid fa-screwdriver-wrench',
        'title'       => 'Maintenance & Support',
        'description' => 'Ongoing support and improvements to keep your systems running.',
    ),
);

$portfolio_stats = array(
    array(
        'icon'  => 'fa-solid fa-code',
        'value' => '10+',
        'label' => 'Projects Completed',
    ),
    array(
        'icon'  => 'fa-regular fa-face-smile',
        'value' => '8+',
        'label' => 'Happy Clients',
    ),
    array(
        'icon'  => 'fa-regular fa-star',
        'value' => '5+',
        'label' => 'Years Experience',
    ),
    array(
        'icon'  => 'fa-solid fa-mug-saucer',
        'value' => '100%',
        'label' => 'Commitment',
    ),
);
?>
<section class="home-hero">
    <div class="container">
        <div class="home-hero__grid">
            <div class="home-hero__content">
                <p class="home-hero__eyebrow">Full-Stack Developer</p>
                <h1>I build scalable web applications that solve real business problems.</h1>
                <p class="home-hero__intro">Specialising in Laravel, Vue.js and modern web technologies. I build fast, secure and user-friendly systems that help businesses streamline operations and grow.</p>
                <div class="home-hero__actions" aria-label="Primary actions">
                    <a class="btn btn-custom-yellow home-hero__button" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" title="View My Projects">
                        View My Projects
                        <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                    </a>
                    <a class="btn home-hero__button home-hero__button--outline" href="<?php echo esc_url( get_template_directory_uri() . '/assets/files/Horace-Benjamin-CV.pdf' ); ?>" title="Download CV" download>
                        Download CV
                        <i class="fa-solid fa-download" aria-hidden="true"></i>
                    </a>
                    <a class="btn home-hero__button home-hero__button--outline" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Contact Me">
                        Contact Me
                        <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="home-hero__portrait" aria-label="Portrait of Horace Benjamin">
                <div class="home-hero__portrait-ring" aria-hidden="true"></div>
                <div class="home-hero__dots" aria-hidden="true"></div>
                <div class="home-hero__photo">
                    <svg class="bd-placeholder-img rounded-circle" width="300" height="300" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Horace Benjamin" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Horace Benjamin</title>
                        <rect width="100%" height="100%" fill="#F7CF26"></rect>
                        <image href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/me.jpg' ); ?>" width="100%" height="100%" preserveAspectRatio="xMidYMid slice"/>
                    </svg>
                </div>
                <div class="home-hero__stat">
                    <strong>5+</strong>
                    <span>Years Experience</span>
                </div>
            </div>
            <div class="home-hero__tech">
                <p class="home-hero__tech-title">Tech Stack</p>
                <ul class="home-hero__tech-list" aria-label="Tech stack">
                    <li><i class="fa-brands fa-laravel" aria-hidden="true"></i>Laravel</li>
                    <li><i class="fa-brands fa-vuejs" aria-hidden="true"></i>Vue.js</li>
                    <li><i class="fa-brands fa-php" aria-hidden="true"></i>PHP</li>
                    <li><i class="fa-solid fa-database" aria-hidden="true"></i>MySQL</li>
                    <li><i class="fa-brands fa-js" aria-hidden="true"></i>JavaScript</li>
                    <li><i class="fa-brands fa-wordpress" aria-hidden="true"></i>Wordpress</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="about-services" id="about_me">
    <div class="container">
        <div class="about-services__grid">
            <div class="about-services__about">
                <p class="section-eyebrow">About Me</p>
                <h2>Full-stack developer based in Sheffield, UK.</h2>
                <p class="about-services__intro">I create robust web applications and digital solutions that are performant, secure and easy to use. From dashboards and internal tools to full business platforms, I focus on clean code, great UX and long-term value.</p>
                <ul class="about-services__checks" aria-label="Development values">
                    <li><i class="fa-solid fa-check" aria-hidden="true"></i>Clean, maintainable and scalable code</li>
                    <li><i class="fa-solid fa-check" aria-hidden="true"></i>Strong focus on user experience</li>
                    <li><i class="fa-solid fa-check" aria-hidden="true"></i>Clear communication and reliable delivery</li>
                    <li><i class="fa-solid fa-check" aria-hidden="true"></i>Always learning, always improving</li>
                </ul>
                <a class="btn about-services__button" href="<?php echo esc_url( home_url( '/about/' ) ); ?>" title="More About Me">
                    More About Me
                    <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                </a>
            </div>
            <div class="about-services__services">
                <p class="section-eyebrow">What I Do</p>
                <h2>Services I Provide</h2>
                <div class="service-card-grid" aria-label="Services I provide">
                    <?php foreach ( $services as $service ) : ?>
                        <article class="service-card">
                            <div class="service-card__head">
                                <span class="service-card__icon"><i class="<?php echo esc_attr( $service['icon'] ); ?>" aria-hidden="true"></i></span>
                                <h3><?php echo esc_html( $service['title'] ); ?></h3>
                            </div>
                            <p><?php echo esc_html( $service['description'] ); ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="projects-showcase" id="portfolio">
    <div class="container">
        <div class="projects-showcase__header">
            <div>
                <p class="section-eyebrow">Featured Projects</p>
                <h2>Projects &amp; Case Studies</h2>
            </div>
            <a class="btn projects-showcase__all" href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" title="View All Projects">
                View All Projects
                <span class="project-card__arrow" aria-hidden="true"></span>
            </a>
        </div>
        <?php
            $project_args = array(
                'post_type'      => 'projects',
                'posts_per_page' => 4,
                'order'          => 'ASC',
                'no_found_rows'  => true,
            );
            $project_query = new WP_Query( $project_args );
        ?>
        <div class="projects-showcase__grid">
            <?php while ( $project_query->have_posts() ) : $project_query->the_post(); ?>
                <?php
                    $project_terms = get_the_terms( get_the_ID(), 'technologies' );
                    $project_index = $project_query->current_post + 1;
                    $live_demo_url = get_post_meta( get_the_ID(), 'live_demo_url', true );
                ?>
                <article class="project-card">
                    <a class="project-card__media project-card__media--<?php echo esc_attr( $project_index ); ?>" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'large', array( 'class' => 'project-card__image' ) ); ?>
                        <?php else : ?>
                            <span class="project-card__mockup" aria-hidden="true">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="project-card__body">
                        <h3><?php echo esc_html( get_the_title() ); ?></h3>
                        <div class="project-card__summary">
                            <?php echo wp_kses_post( wpautop( wp_trim_words( get_the_content(), 22, '...' ) ) ); ?>
                        </div>
                        <ul class="project-card__tech" aria-label="Technologies used">
                            <?php if ( ! empty( $project_terms ) && ! is_wp_error( $project_terms ) ) : ?>
                                <?php foreach ( $project_terms as $project_term ) : ?>
                                    <li><?php echo esc_html( $project_term->name ); ?></li>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <li>Laravel</li>
                                <li>Livewire</li>
                                <li>Alpine.js</li>
                            <?php endif; ?>
                        </ul>
                        <div class="project-card__actions">
                            <?php if ( ! empty( $live_demo_url ) ) : ?>
                                <a class="project-card__demo" href="<?php echo esc_url( $live_demo_url ); ?>" target="_blank" rel="noopener noreferrer">Live Demo</a>
                            <?php else : ?>
                                <a class="project-card__demo" href="<?php echo esc_url( get_permalink() ); ?>">Live Demo</a>
                            <?php endif; ?>
                            <a class="project-card__case" href="<?php echo esc_url( get_permalink() ); ?>">
                                View Case Study
                                <span class="project-card__arrow" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</section>
<section class="stats-strip" aria-label="Portfolio statistics">
    <div class="container">
        <div class="stats-strip__grid">
            <?php foreach ( $portfolio_stats as $stat ) : ?>
                <div class="stats-strip__item">
                    <span class="stats-strip__icon"><i class="<?php echo esc_attr( $stat['icon'] ); ?>" aria-hidden="true"></i></span>
                    <div>
                        <strong><?php echo esc_html( $stat['value'] ); ?></strong>
                        <span><?php echo esc_html( $stat['label'] ); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="blog-insights" id="blog">
    <div class="container">
        <div class="blog-insights__header">
            <div>
                <p class="section-eyebrow">Latest Insights</p>
                <h2>From the Blog</h2>
            </div>
            <?php
                $posts_page_id = (int) get_option( 'page_for_posts' );
                $blog_url = $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/blog/' );
            ?>
            <a class="btn blog-insights__all" href="<?php echo esc_url( $blog_url ); ?>" title="View All Articles">
                View All Articles
                <span class="project-card__arrow" aria-hidden="true"></span>
            </a>
        </div>
        <?php
            $blog_args = array(
                'post_type'      => 'post',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
                'ignore_sticky_posts' => true,
                'no_found_rows'  => true,
            );
            $blog_query = new WP_Query( $blog_args );
            $fallback_articles = array(
                array(
                    'category' => 'Laravel',
                    'title' => 'Building Role-Based Access Control in Laravel',
                    'summary' => 'A step-by-step guide to implementing secure role and permission systems in your Laravel applications.',
                    'meta' => 'May 12, 2024',
                    'read_time' => '6 min read',
                ),
                array(
                    'category' => 'Vue.js',
                    'title' => 'Building Dynamic Interfaces with Vue 3',
                    'summary' => 'Tips and best practices for building fast, reactive and maintainable Vue.js applications.',
                    'meta' => 'Apr 28, 2024',
                    'read_time' => '5 min read',
                ),
                array(
                    'category' => 'Development',
                    'title' => 'My Laravel Development Workflow',
                    'summary' => 'Tools, packages and habits that help me build better, faster and more reliable applications.',
                    'meta' => 'Apr 10, 2024',
                    'read_time' => '7 min read',
                ),
                array(
                    'category' => 'Performance',
                    'title' => 'Optimizing Laravel Applications for Production',
                    'summary' => 'Learn practical techniques for improving performance with caching, queues, database optimization, and deployment best practices.',
                    'meta' => 'Mar 22, 2024',
                    'read_time' => '8 min read',
                ),
            );
        ?>
        <div class="blog-insights__grid">
                <?php $blog_cards_rendered = 0; ?>
                <?php if ( $blog_query->have_posts() ) : ?>
                    <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                        <?php
                            $blog_cards_rendered++;
                            $article_categories = get_the_category();
                            $article_category = ! empty( $article_categories ) ? $article_categories[0]->name : 'Development';
                            $word_count = str_word_count( wp_strip_all_tags( get_the_content() ) );
                            $read_time = max( 1, (int) ceil( $word_count / 200 ) );
                        ?>
                        <article class="blog-card">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="blog-card__link" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
                                <span class="blog-card__category"><?php echo esc_html( $article_category ); ?></span>
                                <h3><?php echo esc_html( get_the_title() ); ?></h3>
                                <p><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: get_the_content(), 20, '...' ) ); ?></p>
                                <span class="blog-card__meta">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
                                    <span aria-hidden="true">&bull;</span>
                                    <span><?php echo esc_html( $read_time ); ?> min read</span>
                                </span>
                            </a>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                <?php for ( $fallback_index = $blog_cards_rendered; $fallback_index < 4; $fallback_index++ ) : ?>
                    <?php if ( isset( $fallback_articles[ $fallback_index ] ) ) : ?>
                        <?php $fallback_article = $fallback_articles[ $fallback_index ]; ?>
                        <article class="blog-card">
                            <div class="blog-card__link">
                                <span class="blog-card__category"><?php echo esc_html( $fallback_article['category'] ); ?></span>
                                <h3><?php echo esc_html( $fallback_article['title'] ); ?></h3>
                                <p><?php echo esc_html( $fallback_article['summary'] ); ?></p>
                                <span class="blog-card__meta">
                                    <span><?php echo esc_html( $fallback_article['meta'] ); ?></span>
                                    <span aria-hidden="true">&bull;</span>
                                    <span><?php echo esc_html( $fallback_article['read_time'] ); ?></span>
                                </span>
                            </div>
                        </article>
                    <?php endif; ?>
                <?php endfor; ?>
        </div>
    </div>
</section>
<section class="cta-banner">
    <div class="container">
        <div class="cta-banner__inner">
            <span class="cta-banner__icon" aria-hidden="true">
                <i class="fa-solid fa-rocket"></i>
            </span>
            <div class="cta-banner__text">
                <h2>Have a project in mind?</h2>
                <p>I'm available for freelance and contract work. Let's build something great together.</p>
            </div>
            <a class="btn cta-banner__btn btn-custom-yellow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Let's Talk">
                Let's Talk
                <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>
<?php get_footer() ?>

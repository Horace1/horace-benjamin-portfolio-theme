<?php
/**
 * Template for the About page.
 *
 * Template Name: About Page
 *
 * @package horacebenjaminportfolio
 */

get_header();

$work_with_items = array(
    'Founders building their first product',
    'Teams overwhelmed by manual processes',
    'Businesses ready to scale and improve operations',
);

$what_i_do_items = array(
    array(
        'icon'        => 'fa-solid fa-laptop',
        'title'       => 'Web Applications',
        'description' => 'Custom, scalable and user-friendly web applications.',
    ),
    array(
        'icon'        => 'fa-solid fa-gear',
        'title'       => 'Automation',
        'description' => 'Streamline workflows and eliminate repetitive manual work.',
    ),
    array(
        'icon'        => 'fa-solid fa-puzzle-piece',
        'title'       => 'Integrations',
        'description' => 'Connect your tools and platforms for seamless operations.',
    ),
    array(
        'icon'        => 'fa-regular fa-chart-bar',
        'title'       => 'Dashboards & Reports',
        'description' => 'Turn data into clear insights that support better decisions.',
    ),
    array(
        'icon'        => 'fa-solid fa-cube',
        'title'       => 'SaaS & Platforms',
        'description' => 'Build and scale SaaS products and customer-facing platforms.',
    ),
    array(
        'icon'        => 'fa-solid fa-headset',
        'title'       => 'Support & Optimisation',
        'description' => 'Ongoing support, improvements and performance optimisation.',
    ),
);

$work_steps = array(
    array(
        'icon'        => 'fa-solid fa-magnifying-glass',
        'title'       => 'Discover',
        'description' => 'Understand your goals, challenges and business needs.',
    ),
    array(
        'icon'        => 'fa-regular fa-clipboard',
        'title'       => 'Plan',
        'description' => 'Define the solution, architecture and timeline.',
    ),
    array(
        'icon'        => 'fa-solid fa-pencil',
        'title'       => 'Design',
        'description' => 'Create intuitive interfaces and smooth user experiences.',
    ),
    array(
        'icon'        => 'fa-solid fa-code',
        'title'       => 'Build',
        'description' => 'Develop with clean, scalable code and AI-accelerated workflows.',
    ),
    array(
        'icon'        => 'fa-solid fa-rocket',
        'title'       => 'Deliver & Support',
        'description' => 'Launch, monitor and continuously improve.',
    ),
);
?>

<section class="about-page-hero">
    <div class="container">
        <div class="about-page-hero__grid">
            <div class="about-page-hero__content">
                <p class="home-hero__eyebrow">About Me</p>
                <h1>Building software that helps businesses work smarter.</h1>
                <p class="about-page-hero__intro">I'm a software developer based in Sheffield, helping businesses build web applications, automate workflows, and create systems that improve efficiency and support growth.</p>
                <p class="about-page-hero__location">
                    <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                    <span>Sheffield, United Kingdom</span>
                </p>
            </div>
            <div class="home-hero__portrait about-page-hero__portrait" aria-label="Portrait of Horace Benjamin">
                <div class="home-hero__portrait-ring" aria-hidden="true"></div>
                <div class="home-hero__dots" aria-hidden="true"></div>
                <div class="home-hero__photo">
                    <svg class="bd-placeholder-img rounded-circle" width="300" height="300" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Horace Benjamin" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Horace Benjamin</title>
                        <rect width="100%" height="100%" fill="#F7CF26"></rect>
                        <image href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/me.jpg' ); ?>" width="100%" height="100%" preserveAspectRatio="xMidYMid slice"/>
                    </svg>
                </div>
                <div class="home-hero__stat about-page-hero__stat">
                    <strong>5+</strong>
                    <span>Years Experience</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-page-story">
    <div class="container">
        <div class="about-page-story__strip">
            <div class="about-page-story__main">
                <p class="section-eyebrow">Audience</p>
                <h2>Who I Work With</h2>
                <p>I work with startups, SMEs and growing businesses that need custom software, automation or better systems to operate more efficiently.</p>
            </div>
            <div class="about-page-story__audiences" aria-label="Who I work with">
                <?php foreach ( $work_with_items as $item ) : ?>
                    <article class="about-page-story__audience-card">
                        <span><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                        <p><?php echo esc_html( $item ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="about-page-services">
    <div class="container">
        <div class="about-page-services__layout">
            <div class="about-page-services__intro">
                <p class="section-eyebrow">Solutions I Build</p>
                <h2>What I Do</h2>
                <p>I design and build web solutions and systems that solve real business challenges and support growth.</p>
            </div>
            <div class="about-page-services__grid" aria-label="What I do">
                <?php foreach ( $what_i_do_items as $item ) : ?>
                    <article class="about-page-services__card">
                        <span><i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i></span>
                        <h3><?php echo esc_html( $item['title'] ); ?></h3>
                        <p><?php echo esc_html( $item['description'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="about-page-journey">
    <div class="container">
        <p class="section-eyebrow">Work Overview</p>
        <div class="about-page-journey__strip">
            <div class="about-page-journey__intro">
                <h2>How I Work</h2>
                <p>A clear, collaborative process from idea to impact.</p>
            </div>
            <div class="about-page-journey__timeline" aria-label="How I work">
                <?php foreach ( $work_steps as $index => $step ) : ?>
                    <article class="about-page-journey__step">
                        <span class="about-page-journey__marker" aria-hidden="true">
                            <i class="<?php echo esc_attr( $step['icon'] ); ?>"></i>
                        </span>
                        <h3><?php echo esc_html( ( $index + 1 ) . '. ' . $step['title'] ); ?></h3>
                        <p><?php echo esc_html( $step['description'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="cta-banner about-page-cta">
    <div class="container">
        <div class="cta-banner__inner">
            <span class="cta-banner__icon" aria-hidden="true">
                <i class="fa-solid fa-rocket"></i>
            </span>
            <div class="cta-banner__text">
                <h2>Let's discuss your next software project.</h2>
                <p>I'm always open to discussing new opportunities and exciting projects.</p>
            </div>
            <a class="btn cta-banner__btn btn-custom-yellow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Get In Touch">
                Get In Touch
                <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>

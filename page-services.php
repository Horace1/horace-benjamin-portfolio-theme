<?php
/**
 * Template for the Services page.
 *
 * Template Name: Services Page
 *
 * @package horacebenjaminportfolio
 */

get_header();

$service_values = array(
    array(
        'icon'  => 'fa-solid fa-desktop',
        'label' => 'Modern Technologies',
    ),
    array(
        'icon'  => 'fa-solid fa-shield-halved',
        'label' => 'Clean & Scalable Code',
    ),
    array(
        'icon'  => 'fa-regular fa-clock',
        'label' => 'On-time Delivery',
    ),
    array(
        'icon'  => 'fa-solid fa-headset',
        'label' => 'Ongoing Support',
    ),
);

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

$industries = array(
    array(
        'icon'        => 'fa-solid fa-rocket',
        'title'       => 'Startups',
        'description' => 'Helping founders build and launch new products with confidence.',
    ),
    array(
        'icon'        => 'fa-solid fa-briefcase',
        'title'       => 'Professional Services',
        'description' => 'Internal systems, client portals and workflow automation.',
    ),
    array(
        'icon'        => 'fa-solid fa-cart-shopping',
        'title'       => 'E-commerce Businesses',
        'description' => 'Better customer experiences, integrations and operational tools.',
    ),
    array(
        'icon'        => 'fa-solid fa-chart-line',
        'title'       => 'Agencies',
        'description' => 'Custom platforms, dashboards and white-label solutions.',
    ),
    array(
        'icon'        => 'fa-solid fa-people-group',
        'title'       => 'Membership Organisations',
        'description' => 'Member portals, subscriptions and content management.',
    ),
    array(
        'icon'        => 'fa-solid fa-location-dot',
        'title'       => 'Local Businesses',
        'description' => 'Booking systems, customer management and automation.',
    ),
);
?>

<section class="services-page-hero">
    <div class="container">
        <div class="services-page-hero__grid">
            <div class="services-page-hero__content">
                <p class="home-hero__eyebrow">My Services</p>
                <h1>Web solutions that help your business grow.</h1>
                <p class="services-page-hero__intro">I build secure, scalable and user-friendly applications and platforms tailored to your business goals.</p>
                <ul class="services-page-hero__values" aria-label="Service values">
                    <?php foreach ( $service_values as $value ) : ?>
                        <li>
                            <i class="<?php echo esc_attr( $value['icon'] ); ?>" aria-hidden="true"></i>
                            <span><?php echo esc_html( $value['label'] ); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="services-page-hero__visual" aria-label="Laptop showing a business dashboard">
                <div class="services-page-hero__orb" aria-hidden="true"></div>
                <div class="home-hero__dots services-page-hero__dots" aria-hidden="true"></div>
                <div class="services-page-laptop" aria-hidden="true">
                    <div class="services-page-laptop__screen">
                        <div class="services-page-laptop__camera"></div>
                        <div class="services-page-laptop__sidebar">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="services-page-laptop__dashboard">
                            <div class="services-page-laptop__topline">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="services-page-laptop__cards">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="services-page-laptop__chart">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="services-page-laptop__panel"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="services-page-list">
    <div class="container">
        <div class="services-page-section-head">
            <p class="section-eyebrow">How I Help</p>
            <h2>Services I Provide</h2>
            <p>From idea to deployment, I provide end-to-end development services to bring your vision to life.</p>
        </div>
        <div class="services-page-list__grid" aria-label="Services I provide">
            <?php foreach ( $services as $service ) : ?>
                <article class="services-page-card">
                    <div class="services-page-card__head">
                        <span class="services-page-card__icon">
                            <i class="<?php echo esc_attr( $service['icon'] ); ?>" aria-hidden="true"></i>
                        </span>
                        <h3><?php echo esc_html( $service['title'] ); ?></h3>
                    </div>
                    <p><?php echo esc_html( $service['description'] ); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="services-page-industries">
    <div class="container">
        <div class="services-page-industries__layout">
            <div class="services-page-industries__intro">
                <p class="section-eyebrow">Who I Work With</p>
                <h2>Industries I Help</h2>
                <p>I work with a wide range of businesses and organisations to build solutions that solve real problems and drive growth.</p>
            </div>
            <div class="services-page-industries__grid" aria-label="Industries I help">
                <?php foreach ( $industries as $industry ) : ?>
                    <article class="services-page-industry">
                        <span>
                            <i class="<?php echo esc_attr( $industry['icon'] ); ?>" aria-hidden="true"></i>
                        </span>
                        <h3><?php echo esc_html( $industry['title'] ); ?></h3>
                        <p><?php echo esc_html( $industry['description'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<section class="cta-banner services-page-cta">
    <div class="container">
        <div class="cta-banner__inner">
            <span class="cta-banner__icon" aria-hidden="true">
                <i class="fa-regular fa-paper-plane"></i>
            </span>
            <div class="cta-banner__text">
                <h2>Have a project in mind?</h2>
                <p>Let's work together to build something amazing.</p>
            </div>
            <a class="btn cta-banner__btn btn-custom-yellow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" title="Let's Talk">
                Let's Talk
                <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>

<?php
/**
 * Template for the Contact page.
 *
 * Template Name: Contact Page
 *
 * @package horacebenjaminportfolio
 */

get_header();

$connect_links = array(
    array(
        'icon'        => 'fa-brands fa-github',
        'title'       => 'GitHub',
        'description' => 'Check out my code and open source contributions',
        'href'        => 'https://github.com/horace1',
    ),
    array(
        'icon'        => 'fa-brands fa-linkedin',
        'title'       => 'LinkedIn',
        'description' => 'Let\'s connect and grow our professional network',
        'href'        => 'https://linkedin.com/in/horace-benjamin-78214353',
    ),
);

?>

<main class="contact-page">
    <section class="contact-page-hero">
        <div class="container">
            <div class="contact-page-hero__grid">
                <div class="contact-page-hero__content">
                    <p class="home-hero__eyebrow">Get In Touch</p>
                    <h1>Let's build something great together.</h1>
                    <p class="contact-page-hero__intro">Have a project in mind or want to discuss an opportunity? I'm always open to new ideas and exciting collaborations.</p>

                </div>

                <div class="contact-page-hero__visual" aria-label="Contact illustration with paper airplane and availability card">
                    <div class="home-hero__dots contact-page-hero__dots" aria-hidden="true"></div>
                    <div class="contact-page-hero__orb" aria-hidden="true"></div>
                    <div class="contact-page-illustration" aria-hidden="true">
                        <div class="contact-page-plane-panel">
                            <div class="contact-page-plane-panel__top">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="contact-page-plane-panel__content">
                                <span class="contact-page-plane-panel__line contact-page-plane-panel__line--one"></span>
                                <span class="contact-page-plane-panel__line contact-page-plane-panel__line--two"></span>
                                <div class="contact-page-plane">
                                    <span class="contact-page-plane__trail contact-page-plane__trail--one"></span>
                                    <span class="contact-page-plane__trail contact-page-plane__trail--two"></span>
                                    <svg class="contact-page-plane__svg" viewBox="0 0 420 260" role="img" aria-label="Paper airplane">
                                        <defs>
                                            <linearGradient id="contact-plane-main" x1="40" y1="60" x2="360" y2="190" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#ffffff"/>
                                                <stop offset="0.54" stop-color="#e9eef5"/>
                                                <stop offset="1" stop-color="#c4cfdb"/>
                                            </linearGradient>
                                            <linearGradient id="contact-plane-fold" x1="195" y1="118" x2="278" y2="224" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#f8fafc"/>
                                                <stop offset="1" stop-color="#9aa8b8"/>
                                            </linearGradient>
                                            <linearGradient id="contact-plane-shadow-wing" x1="66" y1="142" x2="210" y2="226" gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#d6dee8"/>
                                                <stop offset="1" stop-color="#7d8b9b"/>
                                            </linearGradient>
                                        </defs>
                                        <path class="contact-page-plane__shadow-shape" d="M82 216 C142 190 238 188 304 211 C255 238 139 241 82 216Z"/>
                                        <path class="contact-page-plane__lower-wing" d="M34 132 L196 153 L111 224 Z"/>
                                        <path class="contact-page-plane__main-wing" d="M34 132 L392 26 L196 153 Z"/>
                                        <path class="contact-page-plane__fold-wing" d="M196 153 L392 26 L258 226 Z"/>
                                        <path class="contact-page-plane__tail-fold" d="M34 132 L111 224 L128 165 Z"/>
                                        <path class="contact-page-plane__crease" d="M196 153 L258 226"/>
                                        <path class="contact-page-plane__outline" d="M34 132 L392 26 L258 226 L196 153 L111 224 Z"/>
                                    </svg>
                                    <span class="contact-page-plane__shadow"></span>
                                </div>
                            </div>
                        </div>
                        <div class="contact-page-floating contact-page-floating--mail">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                    </div>
                    <aside class="contact-page-availability">
                        <i class="fa-solid fa-rocket" aria-hidden="true"></i>
                        <strong>Available for</strong>
                        <span>freelance projects,<br>contract work<br>and full&#8209;time&nbsp;opportunities.</span>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-page-body">
        <div class="container">
            <div class="contact-page-body__grid">
                <section class="contact-page-panel" aria-labelledby="contact-form-heading">
                    <p class="section-eyebrow">Start A Conversation</p>
                    <h2 id="contact-form-heading">Send Me a Message</h2>
                    <p class="contact-page-panel__intro">Fill out the form and I'll get back to you as soon as possible.</p>
                    <div class="contact-page-form contact-page-form--wpforms">
                        <?php echo do_shortcode( '[wpforms id="15" title="false" description="false"]' ); ?>
                    </div>
                </section>

                <section class="contact-page-panel contact-page-connect" aria-labelledby="connect-heading">
                    <p class="section-eyebrow">Social Links</p>
                    <h2 id="connect-heading">Other Ways to Connect</h2>
                    <div class="contact-page-connect__links">
                        <?php foreach ( $connect_links as $link ) : ?>
                            <a class="contact-page-connect__link" href="<?php echo esc_url( $link['href'] ); ?>" <?php echo 0 === strpos( $link['href'], 'https://' ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                <span class="contact-page-connect__icon">
                                    <i class="<?php echo esc_attr( $link['icon'] ); ?>" aria-hidden="true"></i>
                                </span>
                                <span>
                                    <strong><?php echo esc_html( $link['title'] ); ?></strong>
                                    <small><?php echo esc_html( $link['description'] ); ?></small>
                                </span>
                                <i class="fa-solid fa-arrow-right-long" aria-hidden="true"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>

                </section>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

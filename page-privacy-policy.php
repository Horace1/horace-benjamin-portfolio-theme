<?php
/**
 * Template for the Privacy Policy page.
 *
 * Template Name: Privacy Policy Page
 *
 * @package horacebenjaminportfolio
 */

get_header();

$last_updated = '9 June 2026';

$policy_sections = array(
    array(
        'icon'  => 'fa-regular fa-user',
        'title' => '1. Information I collect',
        'text'  => 'I may collect personal information when you submit a contact form, email me directly, request information about my services, or interact with this website. This may include your name, email address, phone number, company name, message details, and any other information you choose to provide.',
    ),
    array(
        'icon'  => 'fa-solid fa-list-check',
        'title' => '2. How I use your information',
        'text'  => 'I use your information to respond to enquiries, discuss potential projects or services, provide freelance development or consultancy services, improve this website and my services, and keep basic business records.',
    ),
    array(
        'icon'  => 'fa-regular fa-envelope',
        'title' => '3. Contact forms',
        'text'  => 'If you submit a contact form, the information you provide will be used only to respond to your enquiry. I do not sell or share your personal information for marketing purposes.',
    ),
    array(
        'icon'  => 'fa-solid fa-cookie-bite',
        'title' => '4. Cookies and analytics',
        'text'  => 'This website may use cookies or analytics tools to understand how visitors use the site and improve performance. You can disable cookies in your browser settings.',
    ),
    array(
        'icon'  => 'fa-solid fa-shield-halved',
        'title' => '5. Who I share your data with',
        'text'  => 'I do not sell your personal data. I may share information only where necessary with trusted service providers, such as website hosting, email, analytics, or professional advisers.',
    ),
    array(
        'icon'  => 'fa-regular fa-clock',
        'title' => '6. How long I keep your information',
        'text'  => 'I only keep personal information for as long as necessary to respond to enquiries, manage client relationships, meet legal obligations, or maintain business records.',
    ),
    array(
        'icon'  => 'fa-regular fa-circle-user',
        'title' => '7. Your rights',
        'text'  => 'Under UK data protection law, you may have the right to access, correct, delete, restrict, or object to the use of your personal data. You can also withdraw consent where consent is the lawful basis for processing.',
    ),
);
?>

<main class="privacy-policy-page">
    <section class="privacy-policy-hero">
        <div class="container">
            <h1>Privacy Policy</h1>
            <p>
                <i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
                <span>Last updated: <?php echo esc_html( $last_updated ); ?></span>
            </p>
        </div>
    </section>

    <section class="privacy-policy-content">
        <div class="container">
            <p class="privacy-policy-intro">At Horace Benjamin, I respect your privacy and am committed to protecting any personal information you share with me through this website.</p>

            <div class="privacy-policy-list">
                <?php foreach ( $policy_sections as $section ) : ?>
                    <article class="privacy-policy-item">
                        <div class="privacy-policy-item__icon" aria-hidden="true">
                            <i class="<?php echo esc_attr( $section['icon'] ); ?>"></i>
                        </div>
                        <div class="privacy-policy-item__body">
                            <h2><?php echo esc_html( $section['title'] ); ?></h2>
                            <p><?php echo esc_html( $section['text'] ); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>

                <article class="privacy-policy-item privacy-policy-item--contact">
                    <div class="privacy-policy-item__icon" aria-hidden="true">
                        <i class="fa-regular fa-message"></i>
                    </div>
                    <div class="privacy-policy-item__body">
                        <h2>8. Contact</h2>
                        <p>For privacy-related questions, contact:</p>
                    </div>
                    <address class="privacy-policy-contact">
                        <strong>Horace Benjamin</strong>
                        <span><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Sheffield, United Kingdom</span>
                        <a href="mailto:horacebenjamin84@googlemail.com"><i class="fa-solid fa-envelope" aria-hidden="true"></i> horacebenjamin84@googlemail.com</a>
                    </address>
                </article>

                <article class="privacy-policy-item privacy-policy-item--complaints">
                    <div class="privacy-policy-item__icon" aria-hidden="true">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div class="privacy-policy-item__body">
                        <h2>9. Complaints</h2>
                        <p>You also have the right to complain to the Information Commissioner's Office if you are unhappy with how your personal data is handled.</p>
                    </div>
                    <a class="privacy-policy-ico" href="https://www.ico.org.uk/" target="_blank" rel="noopener noreferrer" aria-label="Information Commissioner's Office website">
                        <strong>ico.</strong>
                        <span>Information Commissioner's Office<br>www.ico.org.uk</span>
                    </a>
                </article>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

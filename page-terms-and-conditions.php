<?php
/**
 * Template for the Terms & Conditions page.
 *
 * Template Name: Terms & Conditions Page
 *
 * @package horacebenjaminportfolio
 */

get_header();

$last_updated = '9 June 2026';

$terms_sections = array(
    array(
        'icon'  => 'fa-regular fa-user',
        'title' => '1. Services',
        'text'  => array(
            'I provide freelance web development, consultancy and related services as described on this website.',
            'The scope of work, deliverables, timelines and fees will be agreed in writing before any work begins.',
        ),
    ),
    array(
        'icon'  => 'fa-regular fa-file-lines',
        'title' => '2. Quotes & Proposals',
        'text'  => array(
            'All quotes and proposals are valid for 30 days from the date issued, unless stated otherwise.',
            'I reserve the right to revise a quote if the project scope changes.',
        ),
    ),
    array(
        'icon'  => 'fa-regular fa-credit-card',
        'title' => '3. Payment Terms',
        'text'  => array(
            'Unless otherwise agreed in writing, payment terms are 50% upfront and 50% on completion.',
            'Payment is due within 7 days of invoice unless a different terms is agreed.',
            'Late payments may result in delays or suspension of work.',
        ),
    ),
    array(
        'icon'  => 'fa-regular fa-clock',
        'title' => '4. Revisions & Changes',
        'text'  => array(
            'The project includes a reasonable number of revisions as agreed in the proposal.',
            'Additional changes or requests outside the agreed scope may incur extra fees and affect timelines.',
        ),
    ),
    array(
        'icon'  => 'fa-solid fa-code',
        'title' => '5. Intellectual Property',
        'text'  => array(
            'Upon full payment, I grant you a non-exclusive licence to use the final deliverables for your business.',
            'I retain the right to showcase the work in my portfolio unless you request otherwise in writing.',
        ),
    ),
    array(
        'icon'  => 'fa-regular fa-shield',
        'title' => '6. Third-Party Services',
        'text'  => array(
            'I may use third-party tools, services or plugins to deliver a project. I am not responsible for any changes, downtime or issues caused by third-party providers.',
        ),
    ),
    array(
        'icon'  => 'fa-solid fa-database',
        'title' => '7. Client Responsibilities',
        'text'  => array(
            'You agree to provide all necessary content, access, information and feedback in a timely manner.',
            'Delays in providing this may impact timelines and results.',
        ),
    ),
    array(
        'icon'  => 'fa-regular fa-circle-xmark',
        'title' => '8. Limitation of Liability',
        'text'  => array(
            'I will always do my best to deliver high-quality work. However, I am not liable for any indirect, incidental or consequential losses arising from the use of this website or services.',
        ),
    ),
    array(
        'icon'  => 'fa-solid fa-lock',
        'title' => '9. Confidentiality',
        'text'  => array(
            'I will keep any confidential information shared during a project private and will not share it with third parties except where required to deliver the service.',
        ),
    ),
    array(
        'icon'  => 'fa-solid fa-scale-balanced',
        'title' => '10. Governing Law',
        'text'  => array(
            'These terms and conditions are governed by the laws of England and Wales.',
            'Any disputes will be subject to the exclusive jurisdiction of the courts of England and Wales.',
        ),
    ),
    array(
        'icon'  => 'fa-solid fa-pencil',
        'title' => '11. Changes to These Terms',
        'text'  => array(
            'I may update these terms and conditions from time to time. The latest version will always be available on this page.',
        ),
    ),
);
?>

<main class="privacy-policy-page terms-conditions-page">
    <section class="privacy-policy-hero">
        <div class="container">
            <h1>Terms &amp; Conditions</h1>
            <p>
                <i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
                <span>Last updated: <?php echo esc_html( $last_updated ); ?></span>
            </p>
        </div>
    </section>

    <section class="privacy-policy-content">
        <div class="container">
            <p class="privacy-policy-intro">Welcome to the website of Horace Benjamin ("I", "me", "my"). By using this website or engaging my services, you agree to the following terms and conditions. Please read them carefully.</p>

            <div class="privacy-policy-list">
                <?php foreach ( $terms_sections as $section ) : ?>
                    <article class="privacy-policy-item">
                        <div class="privacy-policy-item__icon" aria-hidden="true">
                            <i class="<?php echo esc_attr( $section['icon'] ); ?>"></i>
                        </div>
                        <div class="privacy-policy-item__body">
                            <h2><?php echo esc_html( $section['title'] ); ?></h2>
                            <?php foreach ( $section['text'] as $paragraph ) : ?>
                                <p><?php echo esc_html( $paragraph ); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>

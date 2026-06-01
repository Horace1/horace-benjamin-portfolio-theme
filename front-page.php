<?php get_header() ?>
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
                    <a class="btn home-hero__button home-hero__button--outline" href="<?php echo get_template_directory_uri(); ?>/assets/files/Horace-Benjamin-CV.pdf" title="Download CV" download>
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
                        <image href="<?php echo get_template_directory_uri(); ?>/assets/images/me.jpg" width="100%" height="100%" preserveAspectRatio="xMidYMid slice" />
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
<section class="py-5 mb-4" id="about_me">
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <?php get_template_part( 'template-partials/section','content' ); ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>My Skills</h2>
                    <div class="skills">
                        <div class="skills__section">
                            <h5 class="skills__heading">Frontend</h5>
                            <div class="skills__group">
                                <div class="skills__row">
                                    <div class="skills__skill"><i class="fa-brands fa-html5"></i> HTML 5</div>
                                    <div class="skills__skill"><i class="fa-brands fa-css3-alt"></i> CSS 3</div>
                                </div>
                                <div class="skills__row">
                                    <div class="skills__skill"><i class="fa-brands fa-js"></i> JavaScript</div>
                                    <div class="skills__skill"><i class="fa-brands fa-sass"></i> Sass</div>
                                 </div>
                                <div class="skills__row">
                                    <div class="skills__skill"><i class="fa-brands fa-vuejs"></i> Vue.js</div>
                                </div>
                            </div>
                        </div>
                        <div class="skills__section">
                            <h5 class="skills__heading">Backend</h5>
                            <div class="skills__group">
                                <div class="skills__row">
                                    <div class="skills__skill"><i class="fa-brands fa-php"></i> PHP</div>
                                    <div class="skills__skill"><i class="fa-brands fa-laravel"></i> Laravel</div>
                                </div>
                                <div class="skills__row">
                                    <div class="skills__skill"><i class="fa-solid fa-database"></i> MySQL</div>
                                </div>
                            </div>
                        </div>
                        <div class="skills__section">
                            <h5 class="skills__heading">Tools & Platforms</h5>
                            <div class="skills__group">
                                <div class="skills__row">
                                    <div class="skills__skill"><i class="fa-brands fa-git"></i> Git</div>
                                    <div class="skills__skill"><i class="fa-brands fa-github"></i> GitHub</div>
                                </div>
                                <div class="skills__row">
                                    <div class="skills__skill"><i class="fa-brands fa-bitbucket"></i> Bitbucket</div>
                                    <div class="skills__skill"><i class="fa-brands fa-sourcetree"></i> SourceTree</div>
                                </div>
                                <div class="skills__row">
                                    <div class="skills__skill"><i class="fa-brands fa-wordpress"></i> WordPress</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-bg-two py-5" id="portfolio">
    <div class="pt-4">
        <h2 class="text-center text-white">My Portfolio</h2>
        <p class="text-center text-white">Here are some personal projects from my GitHub</p>
    </div><!-- /.row -->
    <div class="container">
        <?php
            $args = array(
                'post_type'      => 'Projects',
                'posts_per_page' => 4,
                'order'          => 'ASC',
            );
            $loop = new WP_Query($args);
        ?>
        <div class="row pt-5 pb-4">
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                    <div class="h-100 p-5 text-bg-dark rounded-3">
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                    </div>
                </div><!-- /.col-lg-6 -->
            <?php endwhile; ?>
        </div><!-- /.row -->
        <div class="row pt-4">
            <div class="col-12">
                <div class="text-center">
                    <a class="btn btn-custom-yellow btn-lg text-center" href="https://github.com/horace1" target="_blank" title="View GitHub Portfolio"><i class="fa-brands fa-github"></i> View my GitHub Repositories</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 mb-4" id="contact_me">
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Contact Me</h2>
                    <p>Feel free to contact me</p>
                    <ul class="list-unstyled">
                        <li class="mb-2 fs-5"><i class="fa-solid fa-mobile-screen"></i> 07932212729</li>
                        <li class="mb-2 fs-5"><i class="fa-solid fa-envelope"></i> horacebenjamin84@googlemail.com</li>
                        <li class="mb-2 fs-5"><i class="fa-brands fa-linkedin"></i> linkedin.com/in/horace-benjamin-78214353</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-lg-0 mt-md-0 mt-5">
                    <h2>Contact Form</h2>
                    <?php echo do_shortcode('[wpforms id="15"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>

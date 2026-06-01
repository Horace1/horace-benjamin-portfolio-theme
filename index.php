<?php get_header(); ?>

<main class="py-5">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5' ); ?>>
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <h1>Page not found</h1>
            <p>Sorry, nothing was found here.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>

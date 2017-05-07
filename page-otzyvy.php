<?php
get_header(); ?>

<div class="feedbacks">
    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; else: ?>
            <p>Извините, ничего не найдено.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>

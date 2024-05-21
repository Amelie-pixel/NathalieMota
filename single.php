<!-- Ajout des informations du header -->
<?php get_header(); ?>

<!-- Ajout des informations par defaut-->
<main class="wrap">
  <section class="content-area content-full-width">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="article-full">
        <header>
          <h2><?php the_title(); ?></h2>
        </header>
       <?php the_content(); ?>
      </article>
<?php endwhile; else : ?>
      <article>
        <p>Sorry, no post was found!</p>
      </article>
<?php endif; ?>
  </section>
</main>
<!-- Ajout des informations du footer -->
<?php get_footer(); ?>
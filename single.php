<?php get_header(); ?>

<?php mogo_set_post_views(get_the_ID()); ?>

<div class="container my-5">
  <?php the_content(); ?>

  <?php comments_template(); ?>
</div>

<?php get_footer(); ?>
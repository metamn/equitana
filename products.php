<?php get_header(); ?>

<div id="content category" class="column span-24 last">
  <h1><?php if(function_exists('bcn_display')) { bcn_display(); } ?></h1>
  <div id="col-1" class="column span-8 last">
    <?php get_sidebar(); ?>
  </div>
  <div id="col-2" class="column span-16 last">
  </div>
</div>

<?php get_footer(); ?>

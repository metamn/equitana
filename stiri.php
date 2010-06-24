<?php get_header(); ?>

<div id="content" class="stiri column span-24 last">  
  <?php if (have_posts()) :	while (have_posts()) : the_post(); ?>    
    <?php the_permalink(); ?>
  <?php 
    endwhile;      
    include "navigation.php";  
  else :
    include "not-found.php";
  endif; ?>    
</div>


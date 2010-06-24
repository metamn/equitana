<?php get_header(); ?>

<div id="content" class="meta column span-24 last">  
  <?php if (have_posts()) :	while (have_posts()) : the_post();    
      include "product-single.php";   
    endwhile;
    echo '<div class="clearfix"></div>';      
    include "navigation.php";  
  else :
    include "not-found.php";
  endif; ?>    
</div>

<?php get_footer(); ?>

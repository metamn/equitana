<?php get_header(); ?>

<div id="content" class="meta column span-24 last">  
  <?php if (have_posts()) :	while (have_posts()) : the_post(); ?>
      <div id="product" class="thumb column span-8 last">    
        <?php include "product-single.php";  ?> 
      </div> 
    <?php endwhile;
    echo '<div class="clearfix"></div>';      
    include "navigation.php";  
  else :
    include "not-found.php";
  endif; ?>    
</div>

<?php get_footer(); ?>

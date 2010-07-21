<?php get_header(); ?>

<div id="content" class="meta column span-24 last"> 
  <h1><?php single_cat_title(); ?></h1> 
  <?php 
    $i = 0;
    if (have_posts()) :	
      while (have_posts()) : the_post(); ?>
        <div id="product" class="thumb column span-7 prepend-1 last">    
          <?php include "product-single.php";  ?> 
        </div>
        <?php 
          $i = $i + 1;
          if (($i % 3) == 0) {
            echo '<hr/>';
          }
        ?> 
      <?php endwhile;
    
      echo '<div class="clearfix"></div>';      
      include "navigation.php";  
    
    else :
      include "not-found.php";
    endif; ?>    
</div>

<?php get_footer(); ?>


<div id="title">
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
    <h3><?php the_title(); ?></h3>
  </a>
</div>
<div id="shopping">
  <?php 
    $product_id = get_post_meta($post->ID, 'product_id', single);
    if ($product_id) {        
      echo wpsc_display_products_page('product_id='.$product_id);         
    }      
  
  ?>
  
</div>


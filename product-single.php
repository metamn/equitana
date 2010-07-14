<div id="product" class="column span-8 last">
  <div id="image">
    <?php 
      $imgs = post_attachements($post->ID);
      if (is_array($imgs)) {
        foreach ($imgs as $img) {
          $medium = wp_get_attachment_image_src($img->ID, 'medium');          
        }
      }      
    ?>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
      <img src="<?php echo $medium[0]?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
    </a>
  </div>
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
    <h3><?php the_title(); ?></h3>
  </a>
  <div id="shopping">
    <?php 
      $product_id = get_post_meta($post->ID, 'product_id', single);
      if ($product_id) {        
        echo wpsc_display_products_page('product_id='.$product_id);         
      }      
    ?>
  </div>
</div>

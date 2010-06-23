<div <?php post_class() ?>>
  <h1 id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
  </h1>
  
  <div class="entry">
    <?php the_content('Detalii &rarr;') ?>
  </div>
  
  <div class="shopping">
    <?php 
      $product_id = get_post_meta($post->ID, 'product_id', single);
      echo "product_id = " . $product_id . '<br/>';
      if ($product_id) {        
        echo wpsc_display_products_page('product_id='.$product_id);         
      }      
    ?>
  </div>

  <p class="postmetadata">
    Publicat <?php the_time('l, j F, Y') ?>  
    <br/>
    <?php the_tags('Etichete: ', ', ', '<br />'); ?> 
    Categorii <?php the_category(', ') ?> | 
    <?php edit_post_link('Modificare articol', '', ' | '); ?>  
    <?php comments_popup_link('Fara comentarii &#187;', '1 comentariu &#187;', '% comentarii &#187;'); ?>
  </p>
</div>

<div <?php post_class() ?>>
  <div class='block'>
    <div id='shopping' class='column span-5 last'>
      <?php 
        $product_id = get_post_meta($post->ID, 'product_id', single);
        if ($product_id) {        
          echo wpsc_display_products_page('product_id='.$product_id);         
        }      
      ?>
    </div>
    <div id="info" class='column span-10 last'>
      <h1 id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h1>
      <div class='excerpt'>
        <?php the_excerpt(); ?>
      </div>    
      <p class="postmetadata">
        <?php the_time('l, j F, Y'); ?> &bull; 
        <?php the_tags(__('Tags') . ': ', ', ', ' &bull; '); ?> 
        <?php the_category(', ') ?> &bull; 
        <?php edit_post_link(__('Edit'), '', ' &bull; '); ?>  
        <?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?>
      </p>    
    </div>
  </div>
  <hr/>  
</div>

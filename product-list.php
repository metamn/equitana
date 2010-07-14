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
      <h4 id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
      </h4>
      <div class='excerpt'>
        <?php the_excerpt(); ?>
      </div>    
      <p class="postmetadata">
        <?php _e('Published on:') . the_time('l, j F, Y'); ?>

        <br/>
        <?php the_tags(__('Tags') . ': ', ', ', '<br />'); ?> 
        <?php _e("Categories") . ': ' . the_category(', ') ?> | 
        <?php edit_post_link(__('Edit'), '', ' | '); ?>  
        <?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?>
      </p>    
    </div>
  </div>
  <hr/>  
</div>

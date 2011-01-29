<div <?php post_class() ?>>
  <div class='block'>
    <div id="info" class='column span-9 append-1 last'>
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
    <div id='shopping' class='column span-6 last'>
      
      <?php 
        $product_id = get_post_meta($post->ID, 'product_id', single);
        if ($product_id) {        
          echo wpsc_display_products_page('product_id='.$product_id);         
        } else { 
          // get the post image
          $imgs = post_attachements($id);
          $img = $imgs[0];
          $medium = wp_get_attachment_image_src($img->ID, 'medium'); 
          if ($medium) { ?>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
              <img src="<?php echo $medium[0] ?>" alt="<?php the_title_attribute(); ?>" /></a>
          <?php }
        }
      ?>
    </div>    
  </div>
  <hr/>  
</div>

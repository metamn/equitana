<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

	<div id="content" class="single column span-24 last">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		  <h1><?php the_title(); ?></h1>		  
		  <div class='block'>
		    <div id="images" class="column span-17">		      
		      images here .... 
		    </div>
		    <div id="shopping" class="column span-6 last">
		      <?php 
            $product_id = get_post_meta($post->ID, 'product_id', single);
            if ($product_id) {        
              echo wpsc_display_products_page('product_id='.$product_id);         
            }      
          ?>
		    </div>
		  </div>
			
			<div class="block">
			  <div id="info" class="column span-17">
			    <?php the_content(); ?>
			    <?php comments_template(); ?>
			  </div>		   
			  <div id="meta" class="column span-6 last">
			    <ul class="postmeta">
			      <li><?php _e('Published on:') . the_time('l, j F, Y'); ?></li>
			      <li><?php the_tags(__('Tags') . ': ', ', ', ''); ?></li>   
			      <li><?php _e("Categories") . ': ' . the_category(', ') ?></li>
			      <li><?php _e("Send trackbacks to:")?> <a href="<?php trackback_url(); ?>" rel="trackback">Trackback URL</a></li>
			      <li><?php post_comments_feed_link(__('Comments (RSS)')); ?></li>
			      <li><?php edit_post_link(__('Edit'),'','')?></li>
			    </ul>
		      
          <div id="recommended">    
          <?php
              $related_posts = MRP_get_related_posts($post->ID, true);
              if ($related_posts) { ?>        
                <h3>Produse similare</h3>
                <?php foreach ($related_posts as $post) {
                  setup_postdata($post); ?>
                  <div id="product" class="thumb">            
                    <?php include "product-single.php"; ?>
                  </div>
                <?php }
              } 
          ?>
          </div>
          <div class='clearfix'></div>				
			  </div>   
			</div>				  
		  
		</div>

    
	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>

<?php get_footer(); ?>

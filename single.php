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
			<div class="alignleft"><?php previous_post_link('&laquo; %link', '%title', true) ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;', '%title', true) ?></div>
		</div>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
		  <h1><?php the_title(); ?></h1>		  
		  <div class='block'>
		    <div id="info" class="column span-17">		
		      <div id="thecontent">      
		        <?php the_content(); ?>
		      </div>
		      <div id="thecomments">
			      <?php comments_template(); ?>
			     </div>
		    </div>
		    <div id="side" class="column span-6 last">
		      <?php 
            $product_id = get_post_meta($post->ID, 'product_id', single);
            if ($product_id) {        
              echo wpsc_display_products_page('product_id='.$product_id);         
            }      
          ?>
                   
                    
          <ul class="postmeta">
			      <li><?php _e('Published on:') . the_time('l, j F, Y'); ?></li>
			      <li><?php the_tags(__('Tags') . ': ', ', ', ''); ?></li>   
			      Categorii: <li><?php the_category(', ') ?></li>
			      <li><?php _e("Send trackbacks to:")?> <a href="<?php trackback_url(); ?>" rel="trackback">Trackback URL</a></li>
			      <li><?php post_comments_feed_link(__('Comments (RSS)')); ?></li>
			      <li><?php edit_post_link(__('Edit'),'','')?></li>
			    </ul>
		      
		      
		      <ul class="share">
            <li><?php include "share-twitter.php" ?></li>
            <li><?php include "share-facebook.php" ?> <?php include "share-facebook-like.php" ?></li>
            <li><g:plusone size="medium"></g:plusone></li>
          </ul>          
          <script type="text/javascript">
            window.___gcfg = {lang: 'ro'};

            (function() {
              var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
              po.src = 'https://apis.google.com/js/plusone.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();
          </script>
          
		      
		      
          <div id="recommended">    
            <?php
                $related_posts = MRP_get_related_posts($post->ID, true);
                if ($related_posts) { ?>        
                  <h3 class="title">Produse similare</h3>
                  <?php foreach ($related_posts as $post) {
                    setup_postdata($post); ?>
                    <div id="product" class="thumb">            
                      <?php include "product-single.php"; ?>
                    </div>
                  <?php }
                } 
            ?>
          </div>
		    </div>
		  </div>			
		</div>
		
		    
	<?php endwhile; else:

      include "not-found.php";		

  endif; ?>

	</div>

<?php get_footer(); ?>

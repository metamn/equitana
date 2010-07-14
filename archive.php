<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<?php 
  
  if (is_category(wpml_id(STIRI))) {
    include "stiri.php";
  } elseif (is_category(wpml_id(PROMO)) || is_category(wpml_id(TOPSALES)) || is_category(wpml_id(NOUTATI))) {
    include "meta.php";
  } else { ?>
    
    <div id="content" class="archive column span-24-last">  
	  <?php 
	    $is_product = is_product_category(is_category());
	    if ($is_product) { ?>
        <div id="col-1" class="column span-8 last">	          
          <?php get_sidebar(); ?>
        </div>
        <div id="col-2" class="column span-16 last">
      <?php } ?>
      
		  <?php if (have_posts()) : ?>

     	  <?php 
     	    if (is_category()) { 
     	      if ($is_product) { ?>
     	        <div class="breadcrumb">
     	          <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
     	          <div class="alignright">
     	            <span class='ui-icon ui-icon-search'/></span>
                  <a class="advanced-search" href="<?php bloginfo('home'); ?>/cautare-avansata">Cautare avansata</a> 
     	          </div>
     	        </div>
     	      <?php } else { ?> 
     	        <h2><?php printf(__("You are currently browsing the archives for the %s category."), single_cat_title() ); ?></h2>
     	      <?php }
		      } elseif( is_tag() ) { ?>
		        <h2><?php echo __("Archives") . " > " . single_cat_title(); ?></h2>   	  
	        <?php } elseif (is_author()) { 
	          $userdata = get_userdatabylogin(get_query_var('author_name')); ?>
		        <h2><?php _e("View posts by this author"); ?> 
		          <?php echo $userdata->display_name; ?>
		        </h2>
     	    <?php } else { ?>
		        <h2><?php if(function_exists('bcn_display')) { bcn_display(); } ?></h2>
     	  <?php } ?>

		    
		    <?php 
		    
		      while (have_posts()) : the_post();
            include "product-list.php";
		      endwhile;
          
          include "navigation.php";
	    
	    else :
        include "not-found.php";
	    endif; ?>
	    
	   <?php if ($is_product) { ?> 
	      <div class="breadcrumb">
          <?php if(function_exists('bcn_display')) { bcn_display(); } ?>
          <div class="alignright">
            <span class='ui-icon ui-icon-search'/></span>
            <a class="advanced-search" href="<?php bloginfo('home'); ?>/cautare-avansata">Cautare avansata</a> 
          </div>
        </div>
	    </div>
	   <?php } ?>
  </div>
<?php } ?>

<?php get_footer(); ?>

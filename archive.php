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
          <?php 
            include "breadcrumb.php";            
            if (have_posts()) : while (have_posts()) : the_post();
                include "product-list.php";
		          endwhile;
		          include "navigation.php";
		          include "breadcrumb.php"; 
		        else :
              include "not-found.php";
	          endif;
          ?>
        </div>
        
      <?php } else { ?>
      
        <?php include "navigation.php"; ?>
      
        <div class="block">
          <div id="posts" class="column span-17">      
            <?php if (have_posts()) : 
              if (is_category()) {
                echo '<h2>' . printf(__("You are currently browsing the archives for the %s category."), single_cat_title()) . '</h2>';
              } elseif( is_tag() ) {
                echo '<h2>';
                single_cat_title();
                echo '</h2>';
              } elseif (is_author()) { 
	              $userdata = get_userdatabylogin(get_query_var('author_name'));
		            echo '<h2>' . _e("View posts by this author") . $userdata->display_name . '</h2>';
		          } else {
		            echo '<h2>';
		            if (function_exists('bcn_display')) { bcn_display(); } 
		            echo '</h2>';
		          }
		          
		          while (have_posts()) : the_post();
                include "product-list.php";
		          endwhile;                      
	          else :
              include "not-found.php";
	          endif; ?>	      
	        </div>
	        <div id="side" class="column span-6 last">
	          <?php include "blog-sidebar.php"; ?>
	        </div>
	      </div>
	      
	      <?php include "navigation.php"; ?>
	      
	   <?php } ?>	    
    </div>
    
  <?php } ?>

<?php get_footer(); ?>

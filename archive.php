<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>


<?php   
  if (is_category(wpml_id(PROMO)) || is_category(wpml_id(TOPSALES)) || is_category(wpml_id(NOUTATI))) {
    include "meta.php";
  } else { 
  
    $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);
    #$subs = explode("&", $params);		  	
	  #$tmp = explode("=", $subs[0]);  // for apache
	  #$tmp = explode("=", $subs[1]);
	  
	  $tmp = explode("=", $params);
	  $view = $tmp[1];
    if ($view) {
      $orig = get_query_var('cat');
      query_posts(array('category__and' => array($orig, $view)));
      $is_product_with_brand = true;
    }
  ?>
    
    <div id="content" class="archive column span-24-last">  
	  <?php 
	    $is_product = is_product_and_brand_category(is_category());
	    if ($is_product || $is_product_with_brand) { ?>
        <div id="col-1" class="column span-7 last">	          
          <?php get_sidebar(); ?>
        </div>
        <div id="col-2" class="column span-17 last">
          <?php 
            include "breadcrumb.php";            
            
            if (is_category(get_brand_category_ids())) { ?>            
              <div class="brand-subcats block">
                <?php
                $cat_name = single_cat_title('', false);
                $cats = brand_categories($cat_name);
                $i = 0;              
                foreach ($cats as $c) {
                  $cat = get_category($c); 
                  $l = get_bloginfo('home') . "/category/" . $cat->slug; 
                  $link = $l . "/?view=" . get_query_var('cat');
                  ?>
                  <div class="item row-<?php echo ($i%4)?>">
                    <a href="<?php echo $link ?>"><?php echo $cat->cat_name; ?></a>
                  </div>
                <?php 
                  $i += 1;
                } ?>
              </div>
            <?php } ?>            
              
            
            <?php if (have_posts()) {              
              while (have_posts()) : the_post();                
                include "product-list.php";
		          endwhile;
		          include "navigation.php";
		          include "breadcrumb.php"; 
		        } else {
              include "not-found.php";
	          }
          ?>
        </div>
        
      <?php } else { ?>
      
        <?php include "navigation.php"; ?>
      
        <div class="block">
          <div id="posts" class="column span-17">      
            <?php if (have_posts()) : 
              if (is_category()) {
                echo '<h2>';
                echo single_cat_title();
                echo '</h2>';
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

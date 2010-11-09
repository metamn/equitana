<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<?php 
		  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);	
		  $subs = explode("&", $params);
		  
		  $tmp = explode("=+", $subs[0]);
		  $cod = $tmp[1];
		  		  
		  $tmp = explode("=+", $subs[1]);
		  $text = $tmp[1];
		  		  
		  $tmp = explode("=", $subs[2]);
		  $price = $tmp[1];
		  		  
		  $cats = "";
		  $i = 0;
		  foreach ($subs as $sub) {
		    if ($i > 3) {
		      $tmp = explode("=", $sub);
		      $cats .= $tmp[1] . ",";
		    }
		    $i = $i + 1;
		  }	  				  
?>

<div id="content" class="search-results column span-24 last">
  
    <div id="search-results-header" class="block">
      <h2 class="pagetitle">Rezultate cautare</h2>
      <table>
        <tr><td>Cod produs:</td><td>
          <?php if (!($cod == '+')) { echo $cod; }  ?>
        </td></tr>
        <tr><td>Expresia cautata:</td><td>
          <?php if (!($text == '+')) { echo $text; }  ?>
        </td></tr>
        <tr><td>Cautare dupa pret:</td><td> <?php echo $price; ?></td></tr>
        <tr><td>Categorii produse:</td><td> 
          <?php
            $categories = array();  
            if ($cats) {
              $categories = explode(",", $cats);
              foreach ($categories as $cat) {
                echo get_cat_name($cat) . ', ';
              }
            } 
          ?>
        </td></tr>          
      </table>
    </div>
    
    <div id="search-results-items">
      <?php 
        $allsearch = &new WP_Query("s=$s&showposts=-1"); 
        if ($allsearch->have_posts()) { 
          $counter = 1;
          while ($allsearch->have_posts()) : $allsearch->the_post(); update_post_caches($posts); 
            if (advanced_search($post, $price, $categories, $cod)) { 
              $klass = 'col-' .($counter % 3);
              $counter += 1; ?>
              <div id="product" class="thumb column span-7 prepend-1 last <?php echo $klass ?>">
                <?php include "product-single.php"; ?>                        
              </div>
            <?php }
          endwhile;              
          echo '<div class="clearfix"></div>';                           
          
          if ($counter == 1) {
            include "not-found.php";
          }
          
        } else {
          include "not-found.php";
        } ?>	
    </div>    
    
 
</div>

<?php get_footer(); ?>

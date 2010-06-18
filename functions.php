<?php 

// Constants

define("META", 3);
define("PRODUCTS", 7);
define("TOPSALES", 4);
define("PROMO", 5);
define("NOUTATI", 8);
define("STIRI", 6);


// get category ids for all product categories and subcategories
// - returns an array
function get_product_category_ids() {
  $ret = array();
  $ret[] = PRODUCTS;
  $cats = get_categories('child_of='.PRODUCTS);
  if ($cats) {
    foreach ($cats as $c) {
      echo $c->cat_ID . ' * ';
      $ret[] = $c->cat_ID; 
    }
  }
  return $ret;
}


?>

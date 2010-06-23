<?php 

// Constants
// ---------

define("META", 3);
define("PRODUCTS", 7);
define("TOPSALES", 4);
define("PROMO", 5);
define("NOUTATI", 8);
define("STIRI", 6);



// Shopping cart
// -------------

// Get the post ID from the product ID
function post_id($product_id) {
  $posts = get_posts("posts_per_page=1&meta_key=product_id&meta_value=" . $product_id);
  if ($posts) {
    foreach ($posts as $post) {
      $id = $post->ID;
    }
  } else {
    $id = 0;
  }
  return $id;
}


// checks if the current request is for a product category
// - $is_category = the value of is_category() fucntion
// - returns a bool
function is_product_category($is_category) {
  $ret = false;
  if ($is_category) {
    $product_ids = get_product_category_ids();
	  if (is_category($product_ids)) {
      $ret = true;
    }
  }
  return $ret;
}

// get category ids for all product categories and subcategories
// - returns an array
function get_product_category_ids() {
  $ret = array();
  $ret[] = PRODUCTS;
  $cats = get_categories('child_of='.PRODUCTS);
  if ($cats) {
    foreach ($cats as $c) {      
      $ret[] = $c->cat_ID; 
    }
  }
  return $ret;
}


?>

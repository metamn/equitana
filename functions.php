<?php 


// Constants
// ---------

define("META", 3);
define("PRODUCTS", 7);
define("TOPSALES", 4);
define("PROMO", 5);
define("NOUTATI", 8);
define("STIRI", 6);
define("BRANDURI", 24);





// Shopping cart
// -------------

// Get shopping cart contents 
function get_cart_info() {

}

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

// Get post attachements
function post_attachements($post_id) {  
  $args = array(
	  'post_type' => 'attachment',
	  'numberposts' => null,
	  'post_status' => null,
	  'post_parent' => $post_id,
	  'orderby' => 'date',
	  'order' => 'ASC'
  ); 
  $attachments = get_posts($args);
  return $attachments;
}



// Product navigation
// ------------------

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
  
  $prod = wpml_id(PRODUCTS);
  $brands = wpml_id(BRANDURI);
    
  $ret[] = $prod;
  $cats = get_categories('child_of='.$prod);
  if ($cats) {
    foreach ($cats as $c) {      
      $ret[] = $c->cat_ID; 
    }
  }
  
  $ret[] = $brands;
  $cats = get_categories('child_of='.$brands);
  if ($cats) {
    foreach ($cats as $c) {      
      $ret[] = $c->cat_ID; 
    }
  }
  return $ret;
}


// Getting the ID of an internationalized post, page, category or tag
function wpml_id($id) {
  if (function_exists('icl_object_id')) {
    return icl_object_id($id, 'category', true);
  }
  else {
    return $id;
  }
}



// Common wordpress
// ----------------


// Used in advanced search
function create_radio_button_for_category($cat_id, $name) {
  $ret = "";
  $cats = get_categories('child_of='.$cat_id);
  foreach ($cats as $cat) {
    $ret .= '<input type="radio" name="' . $name . '" value="' . $cat->cat_ID . '"/>';
    $ret .= $cat->name;
    $ret .= '<br/>';
  }
  return $ret;
}
function create_check_box_for_category($cat_id, $name) {
  $ret = "";
  $cats = get_categories('child_of='.$cat_id);
  foreach ($cats as $cat) {
    $ret .= '<input type="checkbox" name="' . $name . '" value="' . $cat->cat_ID . '"/>';
    $ret .= $cat->name;
    $ret .= '<br/>';
  }
  return $ret;
}

// Checks if search results fit advanced search parameters
function advanced_search($post, $price, $categories) {  
  // Category checking first
  if ($categories) {
    if (in_category($categories, $post)) {
      $ret = true;
    } else {
      $ret = false;
    }    
  } else {
    $ret = true;
  }
  
  // Price checking
  if ($ret) {
    if ($price) {
      $product_price = product_price($post->ID);
      if ($product_price) {
        // splitting $price
        $tmp = explode('-', $price);
        $lower = (int)$tmp[0];
        if (!$tmp[1]) {
          $tmp[1] = 10000;
        }
        $higher = (int)$tmp[1];
         
        if ($product_price >= $lower && $product_price <= $higher) {
          $ret = true;
        } else {
          $ret = false;
        }       
      } else {
        $ret = false;
      }      
    } else {
      $ret = true;
    }
  }  
  return $ret;
}




// Common wordpress
// ----------------

// Styling comments
// - documentation @ http://codex.wordpress.org/Template_Tags/wp_list_comments
function styled_comments($comment, $args, $depth){
  $GLOBALS['comment'] = $comment; ?>
  
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="block">
      <div class="comment-author vcard column span-4 last">
         <?php echo get_avatar($comment, $size='96',$default='<path_to_url>' ); ?>
         <br/>
         <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
      </div>
      <div class="column last">
        <?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.') ?></em>
          <br />
        <?php endif; ?>
        
        <div class="comment-body">
          <?php comment_text() ?>
        </div>
        
        <div class="comment-meta commentmetadata">
          <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s la %2$s'), get_comment_date(),  get_comment_time()) ?></a>
          <?php edit_comment_link(__('(Modificare)'),'  ','') ?>
          <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>        
      </div>
    </div>
<?php  
}

?>

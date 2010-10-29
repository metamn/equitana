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
define("INFORMATII", 161);





// Shopping cart
// -------------

// Get shopping cart contents 
function get_cart_info() {

}

function sku($product_id) {
  if ($product_id) {
    global $wpdb;
    $sku = $wpdb->get_var("SELECT `sku` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
    return $sku;
  } 
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


// Returns categories in which a Brand has products
// - input: the category name of the brand
// - algorithm:
//   1. get all posts for the Brand
//   2. collect all categories of these posts into an array
//   3. intersect the array with the array of all product categories
// - returns an array of category ids
function brand_categories($brand_name) {
  $brand_products = get_posts("numberposts=-1&category_name=".$brand_name);
  if ($brand_products) {  
    
    // collecting categories
    $collector = array();
    foreach ($brand_products as $p) {
      $id = $p->ID;
      if (in_category(wpml_id(PRODUCTS), $id)) {
        $cats = get_the_category($id);
        foreach ($cats as $c) {
          $collector[] = $c->cat_ID;
        }
      }
    }
    
    // get all product categories
    $prods = get_product_category_ids();
    unset($prods[0]); // Remove the Product parent category
    return array_unique(array_intersect(array_unique($collector), $prods));
  } 
}


// checks if the current request is for a product category or a brand category
// - $is_category = the value of is_category() fucntion
// - returns a bool
function is_product_and_brand_category($is_category) {
  $ret = false;
  if ($is_category) {
    $product_ids = get_product_and_brand_category_ids();
	  if (is_category($product_ids)) {
      $ret = true;
    }
  }
  return $ret;
}

// get category ids for all product categories and subcategories
// - returns an array
function get_product_and_brand_category_ids() {
  $ret = array();  
  return array_merge(get_product_category_ids(), get_brand_category_ids());
}


// get category ids for all product categories and subcategories
// - returns an array
function get_product_category_ids() {
  $ret = array();
  
  $brands = wpml_id(PRODUCTS);
    
  $ret[] = $brands;
  $cats = get_categories('child_of='.$brands);
  if ($cats) {
    foreach ($cats as $c) {      
      $ret[] = $c->cat_ID; 
    }
  }
  return $ret;
}


// get category ids for all brand categories and subcategories
// - returns an array
function get_brand_category_ids() {
  $ret = array();
  
  $brands = wpml_id(BRANDURI);
    
  $ret[] = $brands;
  $cats = get_categories('child_of='.$brands);
  if ($cats) {
    foreach ($cats as $c) {      
      $ret[] = $c->cat_ID; 
    }
  }
  return $ret;
}



// Multilanguage
// -------------

// Translate strings
function t($string) {

  $en = array(
    "Nu avem imagini" => "Image not available",
    "Cantitate:" => "Quantity",
    "Pret vechi:" => "Old price",
    "Pret:" => "Price",  
    "Adauga la cos" => "Add to cart",
    "Cos cumparaturi" => "Checkout",
    "Actualizare cos..." => "Updating cart...",
    "Momentan nu este disponibil." => "Currently not available",
    "Cod produs:" => "SKU:",    
    "Produse " => "Products ",
    " din categoria " => " from category ",
    "Cautare avansata" => "Advanced search",
    "Protectia consumatorilor" => "Customer protection",
    "Informatii" => "Informations",
    "Creat de" => "Created by",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => ""
  );
  
  $hu = array(
    "Nu avem imagini" => "A kép nem elérhető",
    "Cantitate:" => "Mennyiség:",
    "Pret vechi:" => "Régi ár",
    "Pret:" => "Új ár",  
    "Adauga la cos" => "Kosárba tesz",
    "Cos cumparaturi" => "Vásárol",
    "Actualizare cos..." => "Kosár frissitése...",
    "Momentan nu este disponibil." => "Jelenleg nem elérhető",
    "Cod produs:" => "Termékkód",    
    "Produse " => "Márka: ",
    " din categoria " => ", kategória: ",
    "Cautare avansata" => "Összetett keresés",
    "Protectia consumatorilor" => "Fogyasztóvédelem",
    "Informatii" => "Információk",
    "Creat de" => "Készitette a",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => ""
  );

  switch (ICL_LANGUAGE_CODE) {
    case 'en':
      return $en[$string];
      break;
    case 'hu':
      return $hu[$string];
      break;
    default:
      return $string;
  }
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
function wpml_page_id($id) {
  if (function_exists('icl_object_id')) {
    return icl_object_id($id, 'page', true);
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
         <?php printf(__('<p class="fn">%s</p>'), get_comment_author_link()) ?>
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

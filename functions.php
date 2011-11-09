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
define("STIRISTARTPAGE", 537);
define("MICAPUBLICITATE", 536); 



// Sponsorship
//


// Getting the sponsor of a post
function sponsor_post($main_category){
  $ret = '';
  
  $slug = $main_category.'-parteneri';
  
  $posts = get_posts('numberposts=1&category_name='.$slug);
  if ($posts) {
    foreach ($posts as $p) {
      $ret = $p;
      break; 
    }
  }
    
  return $ret;
}

// Get the main category of a page
// - used in header
// - if used in sidebar it doesn't works!
function page_name($is_category, $is_single, $post_id) {
  $page_name = '&nbsp;';
    
  if ($is_category) {
    $page_name = single_cat_title('', false);
  } elseif ($is_single) {
      $cat_id = category_id($is_category, $is_single, $post_id);      
      if (!($cat_id == 0)) {
        $page_name = get_cat_name($cat_id);         
      } 
  } elseif (is_home()) { 
    $page_name = "";
  }
  return str_replace(" ", "-", $page_name);
}


// Getting the category id if there is any
// - used to determine which category to display in the header
function category_id($is_cat, $is_single, $post_id) {
  $cat_id = 0;
  if ($is_cat) {
    return get_query_var('cat');
  } else if ($is_single) {
      $collection_categories = get_categories('child_of=' . wpml_id(PRODUCTS));
      $cats = array();
      foreach ($collection_categories as $cc) {
        $cats[] = $cc->cat_ID; 
      }
      $post_categories = get_the_category($post_id);
      foreach ($post_categories as $pc) {
        if (in_array($pc->cat_ID, $cats)) {
          $cat_id = $pc->cat_ID;
        }	        
      }	     
  }
  return $cat_id;
}





// Shopping cart
// -------------


// Display product thumbs in thickbox
// $id: post id
function product_thumbs($id) {
  $ret = "";
  
  $imgs = post_attachements($id);
  if (count($imgs) > 0) { 
    $i = 0;
    $ret .= "<div id='images' class='block'>"; 
    foreach ($imgs as $img) {
      if ($i > 0) {
        $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
        $large = wp_get_attachment_image_src($img->ID, 'large'); 
        if ($thumb[0]) { 
          $ret .= "<div class='item'>";
          $ret .= "<a href='" . $large[0] . "'  class='thickbox' rel='images-". $id . "'>"  ;
          $ret .= "<img class='noborder' src='". $thumb[0] . "' />";
          $ret .= "</a></div>";
        }                
      }
      $i += 1;
    } 
    $ret .= "</div>";
  } 
  return $ret;
}

// Get the wspc product id 
// Input: post_id - the wp id of the post
function product_id($post_id) {
  $id = get_post_meta($post_id, 'product_id', true);
  return $id;
}

// Get the product price directly from the post
function product_price($post_id) {  
  $product_id = product_id($post_id); 
  if ($product_id) {
    global $wpdb;
    $price = $wpdb->get_var("SELECT `price` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
    return $price;
  }  
}

// Get the stock
function product_stock($product_id) {
  
}

// Get shopping cart contents 
function get_cart_info() {

}

function sku($product_id) {
  if ($product_id) {
    global $wpdb;
    $sku = $wpdb->get_var("SELECT `meta_value` FROM `".$wpdb->prefix."wpsc_productmeta` WHERE `product_id`=".$product_id." AND `meta_key`='sku' LIMIT 1");
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


// checking if an user has all mandatory fields completed or not
// - used in checkout
// - the unserialize format help: http://blog.tanist.co.uk/files/unserialize/index.php
function check_profile_info($id) {
  global $wpdb;
  $query = "SELECT `meta_value` FROM `".$wpdb->prefix."usermeta` WHERE `user_id`=".$id." AND `meta_key`='wpshpcrt_usr_profile' LIMIT 1"; 
  $info = $wpdb->get_var($query);
  
   
  $ret = false;
  if ($info) {
    $i = unserialize($info);
    if ($i[2] && $i[4] && $i[5] && $i[17] && $i[8]) { 
      $ret = true; 
    }
  } 
  
  return $ret;
}

// Getting current URL
// - used by shopping cart 
// - replaced by a simple call to the checkout page
function curPageURL() {
  $pageURL = bloginfo('home') . '/shop/cos-cumparaturi';
  return $pageURL;
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




// Common wordpress
// ----------------


// Query for multiple posts
// - the query string has the syntax of the query_posts WP function
function query_posts2($query_string) {
  $q = new WP_Query($query_string);
  return $q;
}

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
function advanced_search($post, $price, $categories, $sku) {  
  
  // SKU checking 
  if ($sku) {
    $p = product_id($post->ID);
    $val = sku($p);
    if ($val == $sku) {
      $ret = true;
    } else {
      $ret = false;
    }    
  } else {
    $ret = true;
  }
  
  if ($ret) {
    // Category checking 
    if ($categories) {
      if (in_category($categories, $post)) {
        $ret = true;
      } else {
        $ret = false;
      }    
    } else {
      $ret = true;
    }
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



// Styling comments
// - documentation @ http://codex.wordpress.org/Template_Tags/wp_list_comments
function styled_comments($comment, $args, $depth){
  $GLOBALS['comment'] = $comment; ?>
  
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="block">
      <div class="comment-author vcard column span-4 last">
         <?php echo get_avatar($comment, $size='48',$default='<path_to_url>' ); ?>
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



// Multilanguage
// -------------

// Translate strings
function t($string) {

  $en = array(
    "Nu avem imagini" => "Image not available",
    "Cantitate:" => "Quantity:",
    "Pret vechi:" => "Old price:",
    "Pret:" => "Price:",  
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
    "Pret" => "Price",
    "Produs" => "Product",
    "Cantitate" => "Quantity",
    "Livrare" => "Delivery",
    "Actualizare" => "Update",
    "Renunta" => "Remove",
    "Inca nu aveti cont?" => "Not a registered user yet?",
    "Trebuie sa va inregistrati mai intai pentru a cumpara de la noi." => "First you should sign up to continue shopping.",
    "Procedura de inregistrare este foarte simpla, aveti nevoie numai de o adresa e-mail." => "Signing up is simple, we need just an e-mail address from you.",
    "Intrare in cont / inregistrare cont" => "Login / Register",
    "Cont cumparaturi" => "Shopping information",
    "Nume utilizator:" => "User name:",
    "Adresa email:" => "Email:",
    "Istoric comenzi" => "Shopping history",
    "Detalii facturare/livrare" => "Billing / Shipping address",
    "Iesire din cont" => "Logout",
    "Modificare cont utilizator" => "Edit user information",
    "Va rugam verificati daca datele sunt corecte in formularul de mai jos" => "Please check the information in the form below",
    "Campurile marcate cu * sunt obligatorii." => "Fields marked with * are mandatory.",
    "Datele sunt corecte, trimit imediat comanda" => "All information is ok, make purchase",
    "Adresa de livrare este acelasi ca adresa de facturare?" => "Shipping address is same as billing address?",
    "Trimitere comanda" => "Make purchase",
    "Cosul Dvs. este gol. Va rugam vizitati sectiunea" => "Your cart is empty. Please visit the ",
    "Produse" => "shop",
    "Comanda Dvs. a fost trimis cu succes. In curand veti primi un e-mail de confirmare." => "Your order has been sent. Soon we will send you a confirmation email.",
    "Prieteni" => "Friends",
    "Arhiva" => "Archive",
    "Navigare etichete" => "Tags",
    "Comentarii" => "Recent comments",
    "" => ""
  );
  
  $hu = array(
    "Nu avem imagini" => "A kép nem elérhető",
    "Cantitate:" => "Mennyiség:",
    "Pret vechi:" => "Régi ár:",
    "Pret:" => "Új ár:",  
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
    "Pret" => "Ár",
    "Produs" => "Termék",
    "Cantitate" => "Mennyiség",
    "Livrare" => "Szállitás",
    "Actualizare" => "Jóváhagy",
    "Renunta" => "Kivesz",
    "Inca nu aveti cont?" => "Még nem regisztrált?",
    "Trebuie sa va inregistrati mai intai pentru a cumpara de la noi." => "A regisztráció elegedhetetlen a vásárláshoz.",
    "Procedura de inregistrare este foarte simpla, aveti nevoie numai de o adresa e-mail." => "",
    "Intrare in cont / inregistrare cont" => "Bejelentkezés / Regisztráció",
    "Cont cumparaturi" => "A vásárló adatai",
    "Nume utilizator:" => "Felhasználónév:",
    "Adresa email:" => "Email cim:",
    "Istoric comenzi" => "Multbeli vásárlások",
    "Detalii facturare/livrare" => "Számlázási cim",
    "Iesire din cont" => "Kijelentkezés",
    "Modificare cont utilizator" => "Személyes adatok módositása",
    "Va rugam verificati daca datele sunt corecte in formularul de mai jos" => "Kérjül ellenőrizze az alábbi adatok helyességét",
    "Campurile marcate cu * sunt obligatorii." => "A csillagal jelölt adatokat kötelező megadni.",
    "Datele sunt corecte, trimit imediat comanda" => "Az adatok rendben, elküldöm a megrendelést",
    "Adresa de livrare este acelasi ca adresa de facturare?" => "A kiszállitási cim azonos a számlázási cimmel",
    "Trimitere comanda" => "Megrendelés küldése",
    "Cosul Dvs. este gol. Va rugam vizitati sectiunea" => "Az Ön kosara üres. Kérjük látogassa meg ",
    "Produse" => "üzletünket",
    "Comanda Dvs. a fost trimis cu succes. In curand veti primi un e-mail de confirmare." => "",
    "Prieteni" => "Barátaink",
    "Arhiva" => "Arhivum",
    "Navigare etichete" => "Cimkék",
    "Comentarii" => "Hozzászólások",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
    "" => "",
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






?>

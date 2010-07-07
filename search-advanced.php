<?php
/*
Template Name: Advanced Search Page
*/
?>

<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>


<div id="content" class="advanced-search column span-24 last">
  <div id="col-1" class="column span-8 last">	          
    <?php get_sidebar(); ?>
  </div>
  
  <div id="col-2" class="column span-16 last">  
  <h2>Cautare</h2>
  
  <div class="block">
    <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">         
      <div id="left" class="column span-6 append-1 last">
        <dl>
          <dt><label for="term">Expresia cautata:</label></dt>
          <dd><input type="text" value=" " name="s" id="s" /></dd>
          
          <dt><label for="price">Cautare dupa pret:</label></dt>
          <dd><?php include "search_price.php" ?></dd>
          
          <input type="hidden" name="is-search" value="1" />
                           
          <dt><label for="term">Categorii produse:</label></dt>
          <dd><?php echo create_check_box_for_category(PRODUCTS, "category[]")?></dd>
                    
          <dt><label for="term">Cautare dupa branduri:</label></dt>
          <dd><?php echo create_check_box_for_category(BRANDURI, "category-brand[]")?></dd>
          
          <dt><label for="term">Produse promotionale si populare</label></dt>
          <dd><?php echo create_check_box_for_category(META, "category-promo[]")?></dd>
        </dl>
        <input type="submit" id="searchsubmit" value="Cautare" />
      </div>
      
      <div id="right" class="column span-6 prepend-1 last">                       
        <input type="submit" id="searchsubmit" value="Cautare" />            
      </div>
    </form>      
  </div> 
  </div>               
</div>  
  
<?php get_footer(); ?>




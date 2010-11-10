<?php
/*
 * Template Name: Advanced Search Page
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>


<div id="content" class="advanced-search column span-24 last">   
  <h2>Cautare avansata</h2>
  <div id="col-1" class="column span-12 ">
    <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">         
      <div id="left" class="column span-8 last">
        <dl>
          <dt><label for="term">Cod produs:</label></dt>
          <dd><input type="text" value=" " name="c" id="c" /></dd>
          
          <dt><label for="term">Nume produs:</label></dt>
          <dd><input type="text" value=" " name="s" id="s" /></dd>
          
          <dt><label for="price">Cautare dupa pret:</label></dt>
          <dd><?php include "search_price.php" ?></dd>
          
          <input type="hidden" name="is-search" value="1" />
                           
          <dt><label for="term">Categorii produse:</label></dt>
          <dd><?php echo create_check_box_for_category(wpml_id(PRODUCTS), "category[]")?></dd>
                    
          <dt><label for="term">Cautare dupa branduri:</label></dt>
          <dd><?php echo create_check_box_for_category(wpml_id(BRANDURI), "category-brand[]")?></dd>
          
          <dt><label for="term">Produse promotionale si populare</label></dt>
          <dd><?php echo create_check_box_for_category(wpml_id(META), "category-promo[]")?></dd>
        </dl>
        <input type="submit" id="searchsubmit" value="Cautare" />
      </div>
      
      <div id="right" class="column span-3 last">                       
        <input type="submit" id="searchsubmit" value="Cautare" />            
      </div>
    </form>      
  </div>
  <div id="col-2" class="column span-12 last">
    <div class="tags">
      <?php wp_tag_cloud('number=0'); ?>
    </div>
  </div>     
</div>  
  
<?php get_footer(); ?>




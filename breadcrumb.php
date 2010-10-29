<div class="breadcrumb">
  <?php 
    if ($view) {
      echo t("Produse ") . get_cat_name($view) . t(" din categoria ") . get_cat_name($orig);      
    } else {
      if(function_exists('bcn_display')) { bcn_display(); }
    }
  ?>
  <div class="alignright">
    <span class='ui-icon ui-icon-search'/></span>
    <a class="advanced-search" href="<?php bloginfo('home'); ?>/cautare-avansata"><?php echo t("Cautare avansata")?></a> 
  </div>
</div>

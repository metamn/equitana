<div class="not-found">
  <?php 
    echo '<h2>' . __("Sorry, no posts matched your criteria.") . '</h2>';
    get_search_form();     
  ?>
  
  <div>
    <span class='ui-icon ui-icon-search'/></span>
    <a class="advanced-search" href="<?php bloginfo('home'); ?>/cautare-avansata"><?php echo t("Cautare avansata")?></a> 
  </div>
  
</div>

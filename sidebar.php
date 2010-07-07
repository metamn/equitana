<div id="sidebar">

  <h3>Categorii produse</h3>
  <ul class="categories root">
    <?php wp_list_categories("child_of=".PRODUCTS."&title_li="); ?>
  </ul>  
  
  <h3>Distribuim marcile</h3>
  <ul class="branduri root">
    <?php 
      $cats = get_categories("child_of".BRANDURI);
      if ($cats) {
        foreach ($cats as $c) {
          $logo = get_cat_icon('echo=false&cat='.$c->cat_ID); 
          echo '<li>'.$logo.'</li>';
        }
      }
    ?>
  </ul>        
</div>
<div class='triangle'></div> 



<div id="sidebar">

  
  <?php 
    $cat = wpml_id(PRODUCTS);
    $title = get_cat_name($cat);
  ?>
  <h3><?php echo $title ?></h3>
  <ul class="categories root">
    <?php wp_list_categories("child_of=".$cat."&title_li="); ?>
  </ul>  
  
  
  <?php 
    $cat = wpml_id(BRANDURI);
    $title = get_cat_name($cat);
  ?>
  <h3><?php echo $title ?></h3>
  <ul class="branduri root">
    <?php 
      $cats = get_categories("child_of=".$cat);
      if ($cats) {
        foreach ($cats as $c) {
          //$logo = get_cat_icon('echo=false&cat='.$c->cat_ID);
          echo '<li><a href="'.get_category_link($c->cat_ID).'">'.$c->cat_name.'</a></li>';
        }
      }
    ?>
  </ul>        
</div>
<div class='triangle'></div> 



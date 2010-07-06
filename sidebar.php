<div id="sidebar">
  
  
<?php  
echo '<ul>';
foreach(get_categories("orderby=name&order=ASC") as $category) {
  // Get the icon in a variable
  $my_icon = get_cat_icon('echo=false&cat='.$category->cat_ID);
  // Display a list with icons and the category names
  echo '<li>'.$my_icon.' '.$category->cat_name.'<i><font color="#AAA">'.$category->description.'</font></i></li>';
}
echo '</ul>';
?>
  
  <ul>
    <li id="collapscat-3" class="widget widget_collapscat">   
      <h4>Categorii produse</h4>   
      <ul id="widget-collapscat-3-top" class="collapsing categories list">
      <?php
        $options = array(
          'showPostCount' => false,
          'inExclude' => 'include',
          'inExcludeCats' => PRODUCTS,
          'showPosts' => false,
          'expand' => '0',
          'animate' => true,
          'showTopLevel' => false,
          'expandCatPost' => false,
          'debug' => '0'
        ); 
        collapsCat($options); 
      ?>
      </ul>
    </li>
  </ul> 
       
</div>
<div class='triangle'></div> 



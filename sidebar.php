<div id="sidebar">
  <ul>
    <li id="collapscat-3" class="widget widget_collapscat">   
      <h3>Categorii produse</h3>   
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

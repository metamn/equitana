<div id="sidebar">
  <ul>
    <li id="collapscat-3" class="widget widget_collapscat">      
      <ul id="widget-collapscat-3-top" class="collapsing categories list">
      <?php
        $options = array(
          'showPostCount' => false,
          'inExclude' => 'include',
          'inExcludeCats' => PRODUCTS,
          'showPosts' => false,
          'expand' => '0',
          'animate' => true,
          'showTopLevel' => false
        ); 
        collapsCat($options); 
      ?>
      </ul>
    </li>
  </ul>   
</div>
<div class='triangle'></div> 

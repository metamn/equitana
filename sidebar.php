<div id="sidebar">
  <div id="categories">
    <h2>Categorii produse</h2>
    <ul id="collapsible-list">
      <?php wp_list_categories("child_of=" . PRODUCTS . '&hide_empty=0&title_li='); ?>
    </ul>
  </div>
</div>

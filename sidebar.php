<div id="sidebar">
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
  <?php global $wpsc_query; ?> 
    <ul class='wpsc_categories'>
			<?php wpsc_start_category_query(array('category_group'=>get_option('wpsc_default_category'), 'show_thumbnails'=> get_option('show_category_thumbnails'))); ?>
					<li>
						<?php wpsc_print_category_image(32, 32); ?>
						
						<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link"><?php wpsc_print_category_name();?></a>
						<?php if(get_option('wpsc_category_description')) :?>
							<?php wpsc_print_category_description("<div class='wpsc_subcategory'>", "</div>"); ?>				
						<?php endif;?>
						
						<?php wpsc_print_subcategory("<ul>", "</ul>"); ?>
					</li>
			<?php wpsc_end_category_query(); ?>
		</ul>
</div>
<div class='triangle'></div> 

<div class="navigation block">
  <?php if(function_exists('wp_paginate')) {
    wp_paginate();
  } else { ?>
    <div class="alignleft"><?php next_posts_link(__('&laquo; Previous Page')) ?></div>
    <div class="alignright"><?php previous_posts_link(__('Next Page &raquo;')) ?></div>
  <?php } ?> 
</div>



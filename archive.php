<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<?php 
  
  if (is_category(STIRI)) {
    include "stiri.php";
  } elseif (is_category(PROMO) || is_category(TOPSALES) || is_category(NOUTATI)) {
    include "meta.php";
  } else { ?>

	<div id="content archive" class="column span-24-last">  
	  <?php 
	    $has_sidebar = 0;
	    if (is_category()) {
	      $products = get_product_category_ids();
	      if (is_category($products)) { 
	        $has_sidebar = 1; ?>
	        <div id="col-1" class="column span-7 last append-1">	          
            <?php get_sidebar(); ?>
          </div>
          <div id="col-2" class="column span-16 last">
      <?php } } ?>
      
		  <?php if (have_posts()) : ?>

   	  <?php 
   	    if (is_category()) { 
   	      if ($has_sidebar) { ?>
   	        <h2><?php if(function_exists('bcn_display')) { bcn_display(); } ?></h2>
   	      <?php } else { ?> 
   	        <h2>Articole din categoria &#8216;<?php single_cat_title(); ?>&#8217;</h2>
   	      <?php }
		    } elseif( is_tag() ) { ?>
		      <h2>Articole etichetate cu &#8216;<?php single_tag_title(); ?>&#8217;</h2>   	  
	      <?php } elseif (is_author()) { ?>
		      <h2>Articole create de </h2>
   	    <?php } else { ?>
		      <h2><?php if(function_exists('bcn_display')) { bcn_display(); } ?></h2>
   	  <?php } ?>

  

		  <div class="navigation">
			  <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			  <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		  </div>

		  <?php while (have_posts()) : the_post(); ?>
		  <div <?php post_class() ?>>
				  <h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				  <small><?php the_time('l, F jS, Y') ?></small>

				  <div class="entry">
					  <?php the_content() ?>
				  </div>

				  <p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>

			  </div>

		  <?php endwhile; ?>

		  <div class="navigation">
			  <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			  <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		  </div>
	  <?php else :

		  if ( is_category() ) { // If this is a category archive
			  printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		  } else if ( is_date() ) { // If this is a date archive
			  echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		  } else if ( is_author() ) { // If this is a category archive
			  $userdata = get_userdatabylogin(get_query_var('author_name'));
			  printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		  } else {
			  echo("<h2 class='center'>No posts found.</h2>");
		  }
		  get_search_form();

	  endif;
  ?>
	 <?php if ($has_sidebar) { ?> 
	  </div>
	 <?php } ?>
</div>

<?php } ?>

<?php get_footer(); ?>

<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

	<div id="content" class="page column span-24 last">	  
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			  <h1><?php the_title(); ?></h1>
			  <div class="entry">
				  <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
				  <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>				
			  </div>			
		  </div>
	    <?php 
	      if (comments_open()) {comments_template();}  ?>
	  <?php endwhile; else: 
	    include "not_found.php";
	  endif; ?>
	</div>

<?php get_footer(); ?>

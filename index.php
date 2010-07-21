<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div id="content" class="blog column span-24 last">
	
	  <?php include "navigation.php"; ?>
    <div class="block">	
	    <div id="posts" class="column span-17">
	      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>	  

		      <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			      <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			        <small> <?php the_time('l, j F, Y'); ?> <!-- by <?php the_author() ?> --></small>
			      </h1>
			
			      <div class="entry">
				      <?php the_content('Read the rest of this entry &raquo;'); ?>
			      </div>
			      <p class="postmetadata">
			        <?php the_tags(__('Tags') . ': ', ', ', '<br/>'); ?> 
			        <?php _e("Categories") . ': ' . the_category(', ') ?> | 
			        <?php edit_post_link(__('Edit'), '', ' | '); ?>  			        
			        <?php comments_popup_link(__('No Comments'), __('1 Comment'), __('% Comments')); ?>
			       </p>
		      </div>		

	      <?php endwhile; 	      	        	
	      else:
            include "not-found.php";		
        endif; ?>
      </div>
      
      <div id="side" class="column span-6 last">
        <?php include "blog-sidebar.php"; ?>
      </div>
    </div>
    <?php include "navigation.php"; ?>

	</div>

<?php get_footer(); ?>

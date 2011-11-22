<?php
/**
 Template Name: Blogroll 
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

	<div id="content" class="page column span-24 last">	  
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			  <h1><?php the_title(); ?></h1>
			  <?php 
			    $info = wpml_page_id(INFORMATII);
			    if ( is_page('informatii') || $post->post_parent == $info || in_array( $info, $post->ancestors) ) { ?>
			    <ul class="inline-list">
			      <?php wp_list_pages('child_of='.$info.'&title_li='); ?>
			    </ul>
			    <br/>
			  <?php } ?>
			  <div class="entry block">
				  <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
				  <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>				
			  
			    <div id="blogroll" class="inline-list">
			      <ul>
			      <?php 
			        $bookmarks = get_bookmarks(); 
			        foreach ( $bookmarks as $bm ) { ?>
                <li><a href="<?php echo $bm->link_url ?>" title="<?php echo $bm->link_name ?>">
                  <img src="<?php echo $bm->link_description ?>" />
                  </a></li>
              <?php }
			      ?> 
			      </ul>
			    </div>
			  </div>
			  			
		  </div>
	    <?php 
	      if (comments_open()) {comments_template();}  ?>
	  <?php endwhile; else: 
	    include "not_found.php";
	  endif; ?>
	</div>

<?php get_footer(); ?>

<?php
  /*
  Template Name: Startpage
   * @package WordPress
   * @subpackage Default_Theme
   */

  get_header();
?>

<?php 
  
  $news = query_posts2('posts_per_page=5&cat='.wpml_id(STIRISTARTPAGE));
?>


<div id="content" class="startpage column span-24-last">
  <div id="news">
    <?php if ($news->have_posts()) {
      while ($news->have_posts()) : $news->the_post(); update_post_caches($posts); 
        $cats = get_the_category($post->ID);
        $klass = " ";
        foreach ($cats as $c) {
          $klass .= $c->slug . " ";
        }
      ?>
        <div id="item" class="opacity <?php echo $klass ?>">
          <span class="title link"><?php the_title(); ?></span>
          <p class="date"><?php the_time('l, j F, Y'); ?></p>
          <div id="image" class="hidden">
            <?php
              $imgs = post_attachements($id);
              $img = $imgs[0];  
              $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
              $image = $thumb[0];
              if ($image) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
                  <img src="<?php echo $image ?>" />
                </a>
              <?php }
            ?>
          </div>
          <div id="excerpt" class="hidden">
            <?php the_excerpt(); ?>
          </div>
        </div>
      <?php endwhile;
    }?>
  </div>
</div>

<?php get_footer(); ?>

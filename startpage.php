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
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
              <?php the_excerpt(); ?>
            </a>
          </div>
        </div>
      <?php endwhile;
    }?>
  </div>
</div>

<div id="share" class="column span-24 last">
  <div id="col-1" class="column span-7">
    <h4>Ultimele stiri si noutati pe Twitter</h4>
    <a href="https://twitter.com/equitana_ro" class="twitter-follow-button" data-show-count="false">Follow @equitana_ro</a>
<script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
    <!--
    <h4>Prietenii nostri pe <a href="http://www.twitter.com/equitana_ro"><img src="http://twitter-badges.s3.amazonaws.com/twitter-b.png" alt="Equitana pe Twitter"/></a></h4>
    <script type="text/javascript" src="http://twitter-friends-widget.googlecode.com/files/jquery.twitter-friends-1.0.min.js"></script>
    <div class="twitter-friends" options="{
       username:'equitana_ro'
       ,header:'<a href=\'_tp_\'><img src=\'_ti_\'/></a><h4>_fo_ prieteni</h4>'
       ,user_animate:'width'
       ,users:50
       ,user_image:32
    }"></div>
    -->    
  </div>

  <div id="col-2" class="column prepend-1 span-7 append-1">
    <!--
    <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FEquitana%2F297597436931450&amp;width=292&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:258px;" allowTransparency="true"></iframe>   
    -->
    
    <h4>Promotii si surprize pe Facebook!</h4>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-like" data-href="http://www.facebook.com/pages/Equitana/297597436931450" data-send="true" data-layout="button_count" data-width="250" data-show-faces="false"></div>
  </div>
  
  <div id="col-3" class="column span-7 last">
    <form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=Equitana', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
    <input type="text" autocomplete="off" value="Adresa dvs. de e-mail" name="email" class="text">
    <input type="hidden" value="Equitana" name="uri"/>
    <input type="hidden" name="loc" value="en_US"/>
    <input type="submit" value="Inscriere la newsletter" />
    </form>
  </div>
  
</div>

<?php get_footer(); ?>

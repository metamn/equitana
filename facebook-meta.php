<meta property="fb:admins" content="csbartus"/>

<?php if (is_single()) { 
  $imgs = post_attachements($post->ID);
  if ($imgs) {
    $img = $imgs[0];  
    $medium = wp_get_attachment_image_src($img->ID, 'medium');  
  }  
?>  
  <meta property="og:title" content="<?php the_title(); ?>" />
  <!-- All in One Seo pack takes post excerpt as content, this is a hack-->
  <meta name="description" content="<?php the_title(); ?>" />
  <meta property="og:type" content="product" />
  <?php if ($medium) { ?>
    <meta property="og:image" content="<?php echo $medium[0] ?>" />
  <?php } else { ?>
    <meta property="og:image" content="<?php bloginfo('home') ?>/wp-content/themes/equitana/img/logo.png" />  
  <?php } ?>
  <meta property="og:url" content="<?php the_permalink(); ?>" />
  <meta property="og:site_name" content="<?php bloginfo('name') ?>" />

<?php } elseif (is_home()) { ?>
  <meta property="og:title" content="<?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>" />
  <meta property="og:type" content="blog" />
  <meta property="og:image" content="<?php bloginfo('home') ?>/wp-content/themes/equitana/img/logo.png" />
  <meta property="og:url" content="<?php bloginfo('home') ?>" />
  <meta property="og:site_name" content="<?php bloginfo('name') ?>" />

<?php } elseif (is_front_page()) { ?>
  <meta property="og:title" content="<?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>" />
  <meta property="og:type" content="website" />
  <meta property="og:image" content="<?php bloginfo('home') ?>/wp-content/themes/equitana/img/logo.png" />
  <meta property="og:url" content="<?php bloginfo('home') ?>" />
  <meta property="og:site_name" content="<?php bloginfo('name') ?>" />


<?php } ?>

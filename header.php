<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title>
		  <?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>		  
		</title>
		
		
    <!-- Blueprint -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/blueprint/print.css" type="text/css" media="print">	
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <!-- jQuery Theme -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/smoothness/jquery-ui-1.8.2.custom.css" type="text/css" media="screen, projection">		
    
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/equitana.css" type="text/css" media="screen" />		
		
		<!-- jQuery -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<!-- init all jquery functions -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.init.js"></script>
        
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php wp_head(); ?>
	</head>
	<body>
	  <div class="container"> <!-- closed in footer -->
	    
	    <div id="header" class="column span-24 last">
	      <div id="logo" class="column span-18 last">
	        <a href="<?php bloginfo('home') ?>" alt="<?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>" title="<?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>">
	          <img src="<?php bloginfo('stylesheet_directory') ?>/img/logo.png" alt="<?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>" />
	        </a>
	      </div>
	      
	      <div id="navigation" class="column span-6 last">
	        <div class="inner">
	          
	          <div id="languages">
	            <!--<?php do_action('icl_language_selector'); ?>-->
	          </div>
	          
	          <div id="search">
	            <?php get_search_form(); ?>
	          </div>	                    
	        </div>
	      </div>
	    </div>	
	    
	    <div id="menu" class="column span-24 last">
	      <div id="items" class="column span-18 last">
	        <ul class="inline-list">
	          <?php 	          
	            if (is_product_and_brand_category(is_category())) {
                wp_list_categories('current_category=' . PRODUCTS . '&orderby=slug&order=ASC&exclude=' . META . '&include=' . NOUTATI . ',' . PROMO . ',' . TOPSALES . ',' . PRODUCTS . '&title_li='); 	          
	            } else {
	              wp_list_categories('orderby=slug&order=ASC&exclude=' . META . '&include=' . NOUTATI . ',' . PROMO . ',' . TOPSALES . ',' . PRODUCTS . '&title_li='); 
              }	      
              
              if (is_home()) {
                $blog = "current-cat";
              }     
              if (is_page('forum')) {
                $forum = "current-cat";
              }
	           ?>           
            <li class="<?php echo $forum; ?>"><a href="<?php echo get_category_link(wpml_id(MICAPUBLICITATE)); ?>" alt="Mica publicitate pe Equitana" title="Mica publicitate pe Equitana">Mica publicitate</a></li>	        
            <li class="<?php echo $blog; ?>"><a href="<?php bloginfo('home'); ?>/blog" alt="Blogul Equitana" title="Blogul Equitana">Blog</a></li>
          </ul>
        </div>          
        
        <div id="icons" class="column span-6 last">
          <ul class="inline-list">
            <li class="noncat last user">
              <?php if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                if (($current_user instanceof WP_User)) { ?>	                                
                  <span class="ui-icon ui-icon-person"/></span>
                  <a class="user" href="<?php bloginfo('home'); ?>/cont-cumparaturi" alt="Cont cumparaturi" title="Cont cumparaturi"><?php echo $current_user->display_name; ?></a>                  
              <?php } } else { ?>
                <a href="<?php echo wp_login_url(get_bloginfo('url'))?>" alt="Intrare / inregistrare cont" title="Intrare / inregistrare cont">
                  <span class="ui-icon ui-icon-person"/></span>
                </a>
              <?php } ?>
            </li>
            <li class="noncat cart">
              <a href="<?php bloginfo('home'); ?>/cos-cumparaturi" alt="Cos cumparaturi" title="Cos cumparaturi"><span class="ui-icon ui-icon-cart"/></span></a>
              <span class="cart-content">(<?php echo wpsc_cart_item_count() ?>)</span>
            </li>          
            <li class="noncat info">
              <a href="<?php bloginfo('home'); ?>/informatii" alt="Informatii" title="Informatii"><span class="ui-icon ui-icon-info"/></span></a> 
            </li>
          </ul>
        </div>	       
	    </div>
	    		  	
	    

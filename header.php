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
	      <div id="logo" class="column span-12 last">
	        <a href="<?php bloginfo('home') ?>" alt="<?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>" title="<?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>">
	          <img src="<?php bloginfo('stylesheet_directory') ?>/img/logo.gif" alt="<?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>" />
	        </a>
	      </div>
	      
	      <div id="navigation" class="column span-12 last">
	        <div id="inner">
	          <a href="<?php bloginfo('home'); ?>/#info" alt="Informatii" title="Informatii"><span class="ui-icon ui-icon-info"/></span></a> 
		        &nbsp;
		        <a href="<?php bloginfo('home'); ?>/cos-cumparaturi" alt="Cos cumparaturi" title="Cos cumparaturi"><span class="ui-icon ui-icon-cart"/></span></a>
		        &nbsp;
		        <a href="<?php bloginfo('home'); ?>/#wptouch-search" alt="Cautare" title="Cautare"><span class="ui-icon ui-icon-search"/></span></a>
	        </div>
	      </div>
	    </div>	
	    
	    <div id="menu">
	      <?php wp_list_categories(); ?> 
	    </div>
	    		  	
	    

<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

<hr />
<div id="footer" class="column span-24 last">
  <div id="col-1" class="column span-12 last">
	  <p>
		  Copyright 2010 <?php bloginfo('name'); ?>.		   		  
	  </p>
	</div>
	<div id="col-2" class="column span-12 last">
	  <p>
	    <a href="<?php bloginfo('home'); ?>/informatii/credite"><?php echo t("Informatii")?></a>. 
	    <a href="<?php bloginfo('home'); ?>/informatii/protectia-consumatorilor"><?php echo t("Protectia consumatorilor")?></a>. 
	    <br/>	     
	    <?php echo t("Creat de")?> <a href="http://clair.ro">clair.ro</a>
	  </p>
	</div>
</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19985602-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type =
'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();

</script>




</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
<?php /* "Just what do you think you're doing Dave?" */ ?>

		<?php wp_footer(); ?>
</body>
</html>

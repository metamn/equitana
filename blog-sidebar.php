<h3 class="title"><?php echo t("Comentarii"); ?></h3>
<ul><?php get_recent_comments(); ?></ul>


<h3 class="title"><?php echo t("Navigare etichete"); ?></h3>
<?php wp_tag_cloud('format=list');?>

<h3 class="title"><?php echo t("Arhiva"); ?></h3>
<ul class="archives">  
  <?php wp_get_archives();?>
</ul>

<h3 class="title"><?php echo t("Prieteni"); ?></h3>
<?php wp_list_bookmarks(); ?>  
        
        

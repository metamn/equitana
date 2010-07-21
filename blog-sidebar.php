<h3 class="title">Comentarii</h3>
<ul><?php get_recent_comments(); ?></ul>


<h3 class="title">Navigare etichete</h3>
<?php wp_tag_cloud('format=list');?>

<h3 class="title">Arhiva</h3>
<ul class="archives">  
  <?php wp_get_archives();?>
</ul>

<h3 class="title">Prieteni</h3>
<?php wp_list_bookmarks(); ?>  
        
        

<div class="not-found">
  <?php 
    if ( is_category() ) { // If this is a category archive
	    printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
    } else if ( is_date() ) { // If this is a date archive
	    echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
    } else if ( is_author() ) { // If this is a category archive
	    $userdata = get_userdatabylogin(get_query_var('author_name'));
	    printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
    } else {
	    echo("<h2 class='center'>No posts found.</h2>");
    }
    get_search_form();
  ?>
</div>

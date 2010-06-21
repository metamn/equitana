$(document).ready(function() { 

  // highlights the current product category  
  highlight_active_sidebar_links();
  
}); 


// highlights the current product category  
function highlight_active_sidebar_links() {
  var current_href = window.location.href;
  $("#sidebar a.self").each(function(){
    var self_href = $(this).attr("href");
    if (self_href == current_href) {
      $(this).addClass("current-cat");
      $(this).prev().children().addClass("current-span");
      $(this).before("<span class='highlight-cat'>&nbsp;</span>");
      $(this).after("<div class='triangle-left'></div><div class='triangle-right'></div>")          
    }
  });
}

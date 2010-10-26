$(document).ready(function() { 

  // Highlighting the current category
  // hide all
  $("#sidebar ul.categories ul.children").hide();
  // show first children
  $("#sidebar ul.categories li.current-cat").children().show();
  // show all parents
  $("#sidebar ul.categories li.current-cat").parents().show();
  
  
  // highlighting the current post 
  $('.post').mouseover(function() {
    $(this).addClass('post-active');
  }).mouseout(function(){
    $(this).removeClass('post-active');
  });


}); 




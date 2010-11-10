$(document).ready(function() { 

  // Highlighting a news item on startpage
  $('#content.startpage #item span.title').click(function() {
    $(this).parent().toggleClass('opacity');
    $(this).toggleClass('bold');
    $(this).next().slideToggle(200); 
    $(this).next().next().slideToggle(200); 
  });
  
  


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




$(document).ready(function() { 

  
  // highlighting the current post 
  $('.post').mouseover(function() {
    $(this).addClass('post-active');
  }).mouseout(function(){
    $(this).removeClass('post-active');
  });


}); 




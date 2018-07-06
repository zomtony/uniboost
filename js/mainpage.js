//when the page is loading, the function has already been prepared.
//in the index.php page, the slide function for the pictures.
$(document).ready(function(){
  $('.carousel[data-type="multi"] .item').each(function(){
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
    
    for (var i=0;i<4;i++) {
      next=next.next();
      if (!next.length) {
          next = $(this).siblings(':first');
      }
      
      next.children(':first-child').clone().appendTo($(this));
    }
  });
});


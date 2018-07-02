//when the page is loading, the function has already been prepared.
//in the index.php page, the slide function for the recipes pictures.
$(document).ready(function(){
    if(sessionStorage.getItem("choosePostType") != null){
      document.getElementById("choosePostType").value = sessionStorage.getItem("choosePostType");
    }
  
    if(sessionStorage.getItem("chooseSchool") != null){
      document.getElementById("chooseSchool").value = sessionStorage.getItem("chooseSchool");
  
    }
    
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
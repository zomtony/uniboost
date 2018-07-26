var dataRate;
var dataComment;

$(document).ready(function(){ 

  //  $('.btn-1').addClass('rate-btn-hover');

    dataRate = 'ratef=0';

    $('.rate-btn').hover(function(){
      $('.rate-btn').removeClass('rate-btn-hover');
      var therate = $(this).attr('id');
      for (var i = therate; i >= 0; i--) {
        $('.btn-'+i).addClass('rate-btn-hover');
      };
    });
                            
    $('.rate-btn').click(function(){    
      var therate = $(this).attr('id');
      dataRate = 'ratef='+therate; 
      $('.rate-btn').removeClass('rate-btn-active');
        for (var i = therate; i >= 0; i--) {
          $('.btn-'+i).addClass('rate-btn-active');
        };
    });
  });

  function userSubmit(){
    var commentf = document.getElementById('commentf').value;
    dataComment = 'commentf=' + commentf;
    sendData = dataRate + '&' + dataComment;
    $.ajax({
      method : "POST",
      url : "/component/starRating/php/addRatingAndComment.php",
      data: sendData,
      success:function(data){
        $.ajax({
          url:"/component/comment/php/fetchComment.php",
          method:"POST",
          success:function(data){
              $('#display_comment').html(data);
          }
        })
      }
    })
  }
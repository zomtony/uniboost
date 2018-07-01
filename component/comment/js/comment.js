$(document).ready(function(){

    load_comment();

    function load_comment(){
        $.ajax({
            url:"/component/comment/php/fetchComment.php",
            method:"POST",
            success:function(data){
                $('#display_comment').html(data);
            }
        })
    }
});
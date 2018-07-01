<?php
    class rating {

        function showRating($ratePre, $rateValue, $rateTimes){
            echo    "<div class='result-container'>
                        <div class='rate-bg' style='width:" . $ratePre . "%'></div>
                        <div class='rate-stars'></div>
                        <p class='rating-padding rate-font-size'>(" .  $rateTimes . ")</p>
                    </div>";
        }

        function userRating(){
            echo    "<div class='rate'>
                        <div id='1' class='btn-1 rate-btn'></div>
                        <div id='2' class='btn-2 rate-btn'></div>
                        <div id='3' class='btn-3 rate-btn'></div>
                        <div id='4' class='btn-4 rate-btn'></div>
                        <div id='5' class='btn-5 rate-btn'></div>
                    </div>
                    <textarea name='commentf' class='form-control form-rounded margin-top-m' id='commentf' placeholder='说说你对老师的看法' rows='5'></textarea>";
        }

    }

?>




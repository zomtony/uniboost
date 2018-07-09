<?php

    class getPostTime {
        public function timeAgo($currectTime, $postTime){
            $minute = 60;
            $hour = 60 * $minute;
            $day = 24 * $hour;
            $week = 7 * $day;
            $month = 4 * $week;

            $currectTime  = strtotime($currectTime); 
            $postTime  = strtotime($postTime); 
       
            $secondsAgo = $currectTime - $postTime;

            if($secondsAgo < $minute){
                $quotient = $secondsAgo;
                $unit = "秒";
            }elseif($secondsAgo < $hour){
                $quotient = $secondsAgo / $minute;
                $unit = "分钟";
            }elseif($secondsAgo < $day){
                $quotient = $secondsAgo / $hour;
                $unit = "小时";
            }elseif($secondsAgo < $week){
                $quotient = $secondsAgo / $day;
                $unit = "天";
            }
            elseif($secondsAgo < $month){
                $quotient = $secondsAgo / $week;
                $unit = "周";
            }else{
                $quotient = $secondsAgo / $month;
                $unit = "月";
            }
            return  floor($quotient) . $unit . "前";
        }


        public function checkIfCanPost($currectTime, $postTime){
            $currectTime  = strtotime($currectTime); 
            $postTime  = strtotime($postTime); 
       
            return $secondsAgo = $currectTime - $postTime;
        }
    }
?>
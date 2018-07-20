<?php
	include($_SERVER['DOCUMENT_ROOT'].'/php/splitPage.php'); 
    include($_SERVER['DOCUMENT_ROOT'].'/php/getPostTime.php'); 
    
    $tutorPostAccount = $_SESSION['tutorPostAccount']; 
	$adrating = new rating();
	$adconn = new createConnection(); //create new database connected
	$getPostTime = new getPostTime(); //create new database connected
	$conn = $adconn->connect();
	$stmt = $conn->prepare("SELECT * FROM Tutor_Post WHERE userAccount='$tutorPostAccount'"); 
	$stmt->execute();
	$total = $stmt->rowCount();

	$currectTimeSql = $conn->prepare("SELECT now() as now");
	$currectTimeSql -> execute();
	$currectTimeResult = $currectTimeSql->fetch(PDO::FETCH_OBJ);
	$currectTime = $currectTimeResult -> now;

	$postNum=4;
	
	$mySplitPage = new splitPage($total, $postNum);

	$sql = "SELECT * FROM Tutor_Post t_post
			LEFT JOIN User_Info u_info
            ON t_post.userAccount = u_info.userACCOUNT
            WHERE t_post.userAccount='$tutorPostAccount' ORDER BY tutorPostId DESC {$mySplitPage->limit}";
            
	$count = 0;
	foreach ($conn->query($sql) as $row) {
		$courseArray = explode("|", $row['courseNumber']);
		$postTime = $row['date'];
		$timeAgo = $getPostTime -> timeAgo($currectTime, $postTime);
		echo "<a href='/post/tutor/editTutorPostDetail.php?tutorPost=". $row['tutorPostId'] . "'>";
		if($count%2 == 0){
			echo    "<div class='row theme-backcolor2 main-pg-list-bg' style='margin-left:2%;margin-right:2%;'>";
		}else {
			echo    "<div class='row theme-backcolor1 main-pg-list-bg1' style='margin-left:2%;margin-right:2%;'>";
		}
		$count++;
		$rateValue = $row['averageRateScore'];
		$ratePre = ($rateValue/5-4/120)*100;
		$rateTimes = $row['rateNumber'];
		echo 		"<div class='phone-post-time'>" . $timeAgo . "</div>
					<div class='col-sm-3 padding-zero col3-width'>
						<div class='row padding-zero'>
							<div class='col-xs-1 Width'> 
								<img class='Width rounded' src='data:image/jpeg;base64," . base64_encode($row['userLQPhotoId']) . "' alt=''>
							</div>
							<div class='col-xs-11 name-width'>                           
								<table>
									<tr>
										<td class='padding-left' style='padding-bottom: 8px; padding-top: 4px; color:rgb(120,120,120);'>". $row['userName'] . "</td>
									</tr>
									<tr>
										<td class='padding-left'>";
											$adrating->showRating($ratePre, $rateValue, $rateTimes);
		echo							"</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class='col-sm-5 padding-zero'>
						<div class='row'>
							<div class='col-xs-12 padding-top'>                  
								<table>
									<tr>
										<td><label class='label-style-school-list text-center'>" . $row['school'] . "</label></td>
									</tr>
									<tr>
										<td colspan='2'>
											<div class='fSize list-element-margin-top'>";
												for($i=0; $i<6; $i++){
													if(isset($courseArray[$i]) && ( $courseArray[$i] != null ||$courseArray[$i] != '')){
		echo											"<label class='label-style-course-list text-center label-margin text-ellipsis'>" . strtoupper($courseArray[$i]) . "</label>";
													}		
												}
		echo								"</div> 
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div></a>";
	}

	$adconn->disconnect();
?>

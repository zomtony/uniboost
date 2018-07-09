<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>
<div class="container">  
<?php
	include($_SERVER['DOCUMENT_ROOT'].'/php/splitPage.php'); 
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	include($_SERVER['DOCUMENT_ROOT'].'/php/getPostTime.php'); 
	include($_SERVER['DOCUMENT_ROOT'].'/component/starRating/rating.php'); //rating
    $accountb = $_GET["accountb"];  
	$rating = new rating();
	$myconn = new createConnection(); //create new database connected
	$getPostTime = new getPostTime(); //create new database connected
	$conn = $myconn->connect();
	$stmt = $conn->prepare("SELECT * FROM Tutor_Post WHERE userAccount='$accountb'"); 
	$stmt->execute();
	$total = $stmt->rowCount();

	$currectTimeSql = $conn->prepare("SELECT now() as now");
	$currectTimeSql -> execute();
	$currectTimeResult = $currectTimeSql->fetch(PDO::FETCH_OBJ);
	$currectTime = $currectTimeResult -> now;

	$postNum=12;
	
	$mySplitPage = new splitPage($total, $postNum);

	$sql = "SELECT * FROM Tutor_Post t_post
			LEFT JOIN User_Info u_info
            ON t_post.userAccount = u_info.userACCOUNT
            WHERE t_post.userAccount='$accountb' ORDER BY tutorPostId DESC {$mySplitPage->limit}";
            
	$count = 0;
	foreach ($conn->query($sql) as $row) {
		$courseArray = explode("|", $row['courseNumber']);
		$postTime = $row['date'];
		$timeAgo = $getPostTime -> timeAgo($currectTime, $postTime);
		echo "<a href='/post/tutor/tutorPostDetail.php?tutorPost=". $row['tutorPostId'] . "'>";
		if($count%2 == 0){
			echo    "<div class='row theme-backcolor2 main-pg-list-bg'>";
		}else {
			echo    "<div class='row theme-backcolor1 main-pg-list-bg1'>";
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
											$rating->showRating($ratePre, $rateValue, $rateTimes);
		echo							"</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class='col-sm-9 padding-zero'>
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

	$myconn->disconnect();
    echo $mySplitPage->fpage();

    echo    "<div class='row'>				
				<div class='col-lg-12 text-center margin--position-top'>
					<a href='/userProfile/userProfile.php?accountb=$accountb'>
                    	<button type='button' class='btn btn-margin btn-margin userprofile-button-bg'>返回我的档案</button>
					</a>
                </div>
            </div>";
?>

</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>

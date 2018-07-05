<?php
	include($_SERVER['DOCUMENT_ROOT'].'/php/splitPage.php'); 
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	include($_SERVER['DOCUMENT_ROOT'].'/php/getPostTime.php'); 
	include($_SERVER['DOCUMENT_ROOT'].'/component/starRating/rating.php'); //rating
	$rating = new rating();
	$myconn = new createConnection(); //create new database connected
	$getPostTime = new getPostTime(); //create new database connected

	$conn = $myconn->connect();
	$currectTimeSql = $conn->prepare("SELECT now() as now");
	$currectTimeSql -> execute();
	$currectTimeResult = $currectTimeSql->fetch(PDO::FETCH_OBJ);
	$currectTime = $currectTimeResult -> now;
	//echo $currectTime;
	$num=12;	
	if(isset($_SESSION['chooseSchool']) && isset($_SESSION['keyWords'])){
		if($_SESSION['chooseSchool'] == 'selected' && ($_SESSION['keyWords'] == null || $_SESSION['keyWords'] == '')){
			$stmt = $conn->prepare("SELECT * FROM Tutor_Post");
			$stmt->execute();
			$total = $stmt->rowCount();
			
			$splitPage = new splitPage($total, $num);
			
			$sql = "SELECT * FROM Tutor_Post t_post
				LEFT JOIN User_Info u_info
				ON t_post.userAccount = u_info.userACCOUNT ORDER BY t_post.tutorPostId DESC {$splitPage->limit}";
		}elseif($_SESSION['chooseSchool'] == 'selected' && ($_SESSION['keyWords'] != null && $_SESSION['keyWords'] != '')){
			$keyWords = $_SESSION['keyWords'];
			$stmt = $conn->prepare("SELECT * FROM Tutor_Post WHERE courseNumber LIKE '%$keyWords%'");
			$stmt->execute();
			$total = $stmt->rowCount();
			$splitPage = new splitPage($total, $num);
			$sql = "SELECT * FROM Tutor_Post t_post
				LEFT JOIN User_Info u_info
				ON t_post.userAccount = u_info.userACCOUNT WHERE t_post.courseNumber LIKE '%$keyWords%' ORDER BY t_post.tutorPostId DESC {$splitPage->limit}";
		}elseif($_SESSION['chooseSchool'] != 'selected' && ($_SESSION['keyWords'] != null && $_SESSION['keyWords'] != '')){
			$school = $_SESSION['chooseSchool'];
			$keyWords = $_SESSION['keyWords'];
			$stmt = $conn->prepare("SELECT * FROM Tutor_Post WHERE school = '$school' AND courseNumber LIKE '%$keyWords%'");
			$stmt->execute();
			$total = $stmt->rowCount();
			$splitPage = new splitPage($total, $num);
			$sql = "SELECT * FROM Tutor_Post t_post
				LEFT JOIN User_Info u_info
				ON t_post.userAccount = u_info.userACCOUNT WHERE t_post.school = '$school' AND t_post.courseNumber LIKE '%$keyWords%' ORDER BY t_post.tutorPostId DESC {$splitPage->limit}";
		}elseif($_SESSION['chooseSchool'] != 'selected' && ($_SESSION['keyWords'] == null || $_SESSION['keyWords'] == '')){
			$school = $_SESSION['chooseSchool'];
			$stmt = $conn->prepare("SELECT * FROM Tutor_Post WHERE school = '$school'");
			$stmt->execute();
			$total = $stmt->rowCount();
			$splitPage = new splitPage($total, $num);
			$sql = "SELECT * FROM Tutor_Post t_post
				LEFT JOIN User_Info u_info
				ON t_post.userAccount = u_info.userACCOUNT WHERE t_post.school = '$school' ORDER BY t_post.tutorPostId DESC {$splitPage->limit}";		
		}
	}else{
		$stmt = $conn->prepare("SELECT * FROM Tutor_Post");
		$stmt->execute();
		$total = $stmt->rowCount();
		$splitPage = new splitPage($total, $num);
		$sql = "SELECT * FROM Tutor_Post t_post
			LEFT JOIN User_Info u_info
			ON t_post.userAccount = u_info.userACCOUNT ORDER BY t_post.tutorPostId DESC {$splitPage->limit}";
	}
	
    if($total == 0){
	    echo "<div><h3>啊, 还没有人教这个课哦, 看看其他的吧</h3></div><br>";
        $sql = "SELECT * FROM Tutor_Post t_post
            LEFT JOIN User_Info u_info
            ON t_post.userAccount = u_info.userACCOUNT ORDER BY t_post.tutorPostId DESC {$splitPage->limit}";
	}
	
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
		echo 		"<div class='col-sm-3 padding-zero col3-width'>
						<div class='row padding-zero'>
							<div class='col-xs-1 Width'> 
								<img class='Width rounded' src='data:image/jpeg;base64," . base64_encode($row['userHQPhotoId']) . "' alt=''>
							</div>
							<div class='col-xs-11 name-width'>                           
								<table>
									<tr>
										<td class='padding-left' style='padding-bottom: 8px; font-size: 18px; color:rgb(120,120,120);'>". $row['userName'] . "</td>
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
										<td class='td-post-time'>" . $timeAgo . "</td>
									</tr>
									<tr>
										<td colspan='2'>
											<div class='fSize list-element-margin-top'>";
												for($i=0; $i<6; $i++){
													if(isset($courseArray[$i]) && ( $courseArray[$i] != null ||$courseArray[$i] != '')){
		echo											"<label class='label-style-course-list text-center label-margin'>" . $courseArray[$i] . "</label>";
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
	echo $splitPage->fpage();
?>
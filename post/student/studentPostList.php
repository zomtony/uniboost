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

	$num=12;

	if(isset($_SESSION['chooseSchool']) && isset($_SESSION['keyWords'])){
		$keyWords = $_SESSION['keyWords'];
		$keyWords = str_replace(' ', '', $keyWords);
		if($_SESSION['chooseSchool'] == 'selected' && ($_SESSION['keyWords'] == null || $_SESSION['keyWords'] == '')){

			$stmt = $conn->prepare("SELECT * FROM Student_Post sp"); 
			$stmt->execute();
			$total = $stmt->rowCount();
				
			$splitPageStudent = new splitPage($total, $num);
			$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post  sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount  ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";

		}elseif($_SESSION['chooseSchool'] == 'selected' && ($_SESSION['keyWords'] != null && $_SESSION['keyWords'] != '')){

			$stmt = $conn->prepare("SELECT * FROM Student_Post WHERE expectedCourse LIKE '%$keyWords%'"); 
			$stmt->execute();
			$total = $stmt->rowCount();
			$splitPageStudent = new splitPage($total, $num);

			$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount WHERE expectedCourse LIKE '%$keyWords%'  ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";

		}elseif($_SESSION['chooseSchool'] != 'selected' && ($_SESSION['keyWords'] != null && $_SESSION['keyWords'] != '')){

			$school = $_SESSION['chooseSchool'];
			$stmt = $conn->prepare("SELECT * FROM Student_Post WHERE school = '$school' AND expectedCourse LIKE '%$keyWords%'"); 
			$stmt->execute();
			$total = $stmt->rowCount();
			$splitPageStudent = new splitPage($total, $num);

			$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount WHERE school = '$school' AND expectedCourse LIKE '%$keyWords%'  ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";

		}elseif($_SESSION['chooseSchool'] != 'selected' && ($_SESSION['keyWords'] == null || $_SESSION['keyWords'] == '')){

			$school = $_SESSION['chooseSchool'];
			$stmt = $conn->prepare("SELECT * FROM Student_Post WHERE school = '$school'"); 
			$stmt->execute();
			$total = $stmt->rowCount();
			$splitPageStudent = new splitPage($total, $num);

			$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount WHERE school = '$school' ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";		

		}
	}else{
		$stmt = $conn->prepare("SELECT * FROM Student_Post"); 
		$stmt->execute();
		$total = $stmt->rowCount();
		$splitPageStudent = new splitPage($total, $num);

		$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount  ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";
	}
	
	if($total == 0){
	    echo "<div><h3>啊, 还没有相关帖子哦, 看看其他的吧</h3></div><br>";
		$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount  ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";
	}

	$count = 0;
	foreach ($conn->query($sql) as $row ) {
		$postTime = $row['date'];
		$timeAgo = $getPostTime -> timeAgo($currectTime, $postTime);
		echo "<a href='/post/student/studentPostDetail.php?studentPost=". $row['studentPostId'] . "'>";
		if($count%2 == 0){
			echo    "<div class='row theme-backcolor2 main-pg-list-bg'>";
		}else {
			echo    "<div class='row theme-backcolor1 main-pg-list-bg1'>";
		}
		$count++;



		echo 		"<div class='col-sm-3 padding-zero col3-width'>
						<div class='row padding-zero'>
							<div class='col-xs-1 Width'>"; 



					if($row['userLQPhotoId'] != null){
		echo    		"<img class='Width rounded' src='data:image/jpeg;base64," . base64_encode($row['userLQPhotoId']) . "' alt=''>";
					}else{
		echo           "<img class='Width rounded' src='/img/defaultLQPohotId.jpg' alt=''>";
					}



		echo				"</div>
							<div class='col-xs-11 name-width'>                           
								<table>
									<tr>
										<td class='padding-left text-ellipsis' style='padding-top: 2px; padding-bottom: 6px; font-size: 18px; color:rgb(120,120,120);'>". $row['userName'] . "</td>
									</tr>
									<tr>
										<td class='padding-left'></td>
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
											<div class='fSize'><label class='label-style-course-list text-center label-margin text-ellipsis' id='expectedCourseb' >". strtoupper($row['expectedCourse']) . "</label></div> 
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			    </a>";
	}

	$myconn->disconnect();
	echo $splitPageStudent->fpage();
?>
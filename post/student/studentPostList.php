<?php
	include($_SERVER['DOCUMENT_ROOT'].'/php/splitPage.php'); 
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	include($_SERVER['DOCUMENT_ROOT'].'/component/starRating/rating.php'); //rating
	$rating = new rating();
	$myconn = new createConnection(); //create new database connected
	$conn = $myconn->connect();

	$num=12;

	if(isset($_SESSION['chooseSchool']) && isset($_SESSION['key'])){
		if($_SESSION['chooseSchool'] == 'selected' && ($_SESSION['key'] == null || $_SESSION['key'] == '')){

			$stmt = $conn->prepare("SELECT * FROM Student_Post sp"); 
			$stmt->execute();
			$total = $stmt->rowCount();
				
			$splitPageStudent = new splitPage($total, $num);
			$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post  sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount  ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";

		}elseif($_SESSION['chooseSchool'] == 'selected' && ($_SESSION['key'] != null && $_SESSION['key'] != '')){

			$key = $_SESSION['key'];
			$stmt = $conn->prepare("SELECT * FROM Student_Post WHERE expectedCourse LIKE '%$key%'"); 
			$stmt->execute();
			$total = $stmt->rowCount();
			$splitPageStudent = new splitPage($total, $num);

			$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount WHERE expectedCourse LIKE '%$key%'  ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";

		}elseif($_SESSION['chooseSchool'] != 'selected' && ($_SESSION['key'] != null && $_SESSION['key'] != '')){

			$school = $_SESSION['chooseSchool'];
			$key = $_SESSION['key'];
			$stmt = $conn->prepare("SELECT * FROM Student_Post WHERE school = '$school' AND expectedCourse LIKE '%$key%'"); 
			$stmt->execute();
			$total = $stmt->rowCount();
			$splitPageStudent = new splitPage($total, $num);

			$sql = "SELECT sp.studentPostId, sp.userName, sp.userAccount, sp.expectedCourse, sp.expectedPrice, sp.school, sp.date, ui.userLQPhotoId FROM Student_Post sp LEFT JOIN User_Info ui ON sp.userAccount = ui.userAccount WHERE school = '$school' AND expectedCourse LIKE '%$key%'  ORDER BY sp.studentPostId DESC {$splitPageStudent->limit}";

		}elseif($_SESSION['chooseSchool'] != 'selected' && ($_SESSION['key'] == null || $_SESSION['key'] == '')){

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
	
	$count = 0;
	foreach ($conn->query($sql) as $row ) {
		echo "<a href='/post/student/studentPostDetail.php?studentPost=". $row['studentPostId'] . "'>";
		if($count%2 == 0){
			echo    "<div class='row theme-backcolor2'>";
		}else {
			echo    "<div class='row theme-backcolor1'>";
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
										<td class='padding-left '>". $row['userName'] . "</td>
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
										<td>" . $row['school'] . "</td>
										<td class='td-post-time'>" . $row['date'] . "</td>
									</tr>
									<tr>
										<td colspan='2'>
											<div class='fSize'><label class='label-style-course-list text-center label-margin' id='expectedCourseb' >". $row['expectedCourse'] . "</label></div> 
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
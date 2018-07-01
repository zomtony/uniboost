<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>
<div class="container">  
<?php
	include($_SERVER['DOCUMENT_ROOT'].'/php/splitPage.php'); 
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	include($_SERVER['DOCUMENT_ROOT'].'/component/starRating/rating.php'); //rating
    $accountb = $_GET["accountb"];  
	$rating = new rating();
	$myconn = new createConnection(); //create new database connected
	$conn = $myconn->connect();
	$stmt = $conn->prepare("SELECT * FROM Tutor_Post WHERE userAccount='$accountb'"); 
	$stmt->execute();
	$total = $stmt->rowCount();

	$postNum=12;
	
	$mySplitPage = new splitPage($total, $postNum);

	$sql = "SELECT * FROM Tutor_Post t_post
			LEFT JOIN User_Info u_info
            ON t_post.userAccount = u_info.userACCOUNT
            WHERE t_post.userAccount='$accountb'{$mySplitPage->limit}";
            
	$count = 0;
	foreach ($conn->query($sql) as $row) {
		echo "<a href='/post/tutor/tutorPostDetail.php?tutorPost=". $row['tutorPostId'] . "'>";
		if($count%2 == 0){
			echo    "<div class='row theme-backcolor2'>";
		}else {
			echo    "<div class='row theme-backcolor1'>";
		}
		$count++;

		$rateValue = $row['averageRateScore'];
		$ratePre = ($rateValue/5)*100;
		$rateTimes = $row['rateNumber'];

		echo 		"<div class='col-sm-3 padding-zero col3-width'>
						<div class='row padding-zero'>
							<div class='col-xs-1 Width'> 
								<img class='Width rounded' src='data:image/jpeg;base64," . base64_encode($row['userLQPhotoId']) . "' alt=''>
							</div>
							<div class='col-xs-11 name-width'>                           
								<table>
									<tr>
										<td class='padding-left '>". $row['userName'] . "</td>
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
							<div class='col-xs-9 padding-top'>                  
								<table>
									<tr>
										<td>" . $row['school'] . "</td>
									</tr>
									<tr>
										<td>
											<div class='fSize'>". $row['courseNumber'] . "</div> 
										</td>
									</tr>
								</table>
							</div>
							<div class='col-xs-3'>$" . $row['wage'] . "</div>
						</div>
					</div>
				</div>
				</a>";
	}

	$myconn->disconnect();
    echo $mySplitPage->fpage();

    echo    "<div class='row'>				
				<div class='col-lg-12 text-center margin--position-top'>
					<a href='/userProfile/userProfile.php?accountb=$accountb'>
                    	<button type='button' class='btn btn-margin btn-margin userprofile-button-bg'>返回个人信息</button>
					</a>
                </div>
            </div>";
?>

</div>
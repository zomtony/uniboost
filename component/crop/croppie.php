<?php
	session_start();
	if(isset($_POST["image"]))
	{
		$data = $_POST["image"];
		$image_array_1 = explode(";", $data);
		$image_array_2 = explode(",", $image_array_1[1]);
		$data = base64_decode($image_array_2[1]);
		$tempDir = $_SERVER['DOCUMENT_ROOT'] . '/component/crop/temp/';
		$imageName = $_SESSION['accountb'] . time() . '.png';
		
		file_put_contents("$tempDir" . $imageName, $data);
		$_SESSION['Crop_ImgDir'] = $_SERVER['DOCUMENT_ROOT'] . '/component/crop/temp/' . $imageName;
		$_SESSION['Crop_ImgName'] = $imageName;
		echo "<img src='/component/crop/temp/" . $imageName. "' class='img-thumbnail rounded profile-img-size eliminatePadding' name='photoIdf' id='photoIdf'/>";
	}

?>
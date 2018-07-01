


function saveInfo(){
  var choosePostType = document.getElementById("choosePostType").value;
  sessionStorage.setItem("choosePostType", choosePostType);

  var chooseSchool = document.getElementById("chooseSchool").value;
  sessionStorage.setItem("chooseSchool", chooseSchool);
}


function editMyProfile() {
  var userProfile = document.getElementById("userProfile");
  var changeProfile = document.getElementById("changeProfile");
  var editButton = document.getElementById("edit-Profile");
  if (userProfile.style.display === "none") {
    userProfile.style.display = "block";
    editButton.style.display = "block";
    changeProfile.style.display = "none";
  } else {
    userProfile.style.display = "none";
    editButton.style.display = "none";
    changeProfile.style.display = "block";
  }
}

function change() {
	var pic = document.getElementById("photoIdf");
	var file = document.getElementById("file");
  var totalKb = file.files[0].size/1024;
  
  if(totalKb >= 5120){
    window.alert("图片不能大于5M"); 
    return;
  }
	var ext=file.value.substring(file.value.lastIndexOf(".")+1).toLowerCase();
    //not support gif
     if(ext!='png'&&ext!='jpg'&&ext!='jpeg'){
         alert("图片的格式必须为png或者jpg或者jpeg格式！"); 
		 return;
     }
	 var isIE = navigator.userAgent.match(/MSIE/)!= null,
		 isIE6 = navigator.userAgent.match(/MSIE 6.0/)!= null;

	 if(isIE) {
		file.select();
		var reallocalpath = document.selection.createRange().text;

         if (isIE6) {
			pic.src = reallocalpath;
		 }else {
             pic.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image',src=\"" + reallocalpath + "\")";
             pic.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
		 }
	 }else {
		html5Reader(file);
   }
   
}

 function html5Reader(file){
     var file = file.files[0];
     var reader = new FileReader();
     reader.readAsDataURL(file);
     reader.onload = function(e){
         var pic = document.getElementById("photoIdf");
         pic.src=this.result;
     }
 }


 
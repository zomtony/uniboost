


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


 
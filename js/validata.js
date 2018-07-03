function checkSignUpInput(){
    var pwd1 = document.getElementById('pwdf1').value;
    var pwd2 = document.getElementById('pwdf2').value;
    if(pwd1 != pwd2){
        window.alert("两次输入密码不一致");
        return false;
    }
}

function checkTutorPostInput(){
    var course1 = document.getElementById('courseArrayf1').value;
    var course2 = document.getElementById('courseArrayf2').value;
    var course3 = document.getElementById('courseArrayf3').value;
    var course4 = document.getElementById('courseArrayf4').value;
    var course5 = document.getElementById('courseArrayf5').value;
    var course6 = document.getElementById('courseArrayf6').value;

    if(course1 == null && course2 == null && course3 == null && course4 == null && course5 == null && course6 == null ){
        window.alert("请输入所教课程");
        return false;
    }
}
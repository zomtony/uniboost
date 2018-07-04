function checkSignUpInput(){
    var pwd1 = document.getElementById('pwdf1').value;
    var pwd2 = document.getElementById('pwdf2').value;
    if(pwd1 != pwd2){
        window.alert("两次输入密码不一致");
        return false;
    }
}

function checkTutorPostInput(){
    var school = document.getElementById('chooseSchool').value;

    if(school == "selected"){
        window.alert("请选择学校");
        return false;
    }
}
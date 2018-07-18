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
        window.alert("请选择课程所属学校");
        return false;
    }
}

function checkStudentPostInput(){
    var school = document.getElementById('chooseSchool').value;
    var weChatNumber = document.getElementById('weChatNumberf').value;
    var phoneNumber = document.getElementById('phoneNumberf').value;
    if(school == "selected"){
        window.alert("请选择课程所属学校");
        return false;
    }
    if((weChatNumber == "" || weChatNumber == null) && (phoneNumber == "" || phoneNumber == null)){
        window.alert("请输入至少一种你的联系方式，方便老师联系你");
        return false;
    }
}

function checkIfLogin(){
    window.alert("请登陆后写评论");
    return false;
}
function checkSignUpInput(){
    var pwd1 = document.getElementById('pwdf1').value;
    var pwd2 = document.getElementById('pwdf2').value;
    if(pwd1 != pwd2){
        window.alert("两次输入密码不一致");
        return false;
    }
}

function checkTutorPostInput(){
    var userName = document.getElementById('userNamef').value;
    var school = document.getElementById('chooseSchool').value;
    
    if(userName.trim() == ""){
        window.alert("请在我的档案处补全信息，名字为必填项");
        return false;
    }

    if(school == "selected"){
        window.alert("请选择课程所属学校");
        return false;
    }
}

function checkStudentPostInput(){
    var userName = document.getElementById('userNamef').value;
    var school = document.getElementById('chooseSchool').value;
    var expectedCourse = document.getElementById('expectedCoursef').value
    var weChatNumber = document.getElementById('weChatNumberf').value;
    var phoneNumber = document.getElementById('phoneNumberf').value;

    if(userName.trim() == ""){
        window.alert("请输入你的名称");
        return false;
    }

    if(expectedCourse.trim() == ""){
        window.alert("请输入你的课程编号或者名称");
        return false;
    }

    if(school == "selected"){
        window.alert("请选择课程所属学校");
        return false;
    }
    if((weChatNumber.trim() == "" || weChatNumber == null) && (phoneNumber.trim() == "" || phoneNumber == null)){
        window.alert("请输入至少一种你的联系方式，方便老师联系你");
        return false;
    }
}

function checkIfLogin(){
    window.alert("请登陆后写评论");
    return false;
}
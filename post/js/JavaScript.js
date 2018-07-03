
var count = 0;

function setValueForMonday(){
  var monday = document.getElementById("monday");
  if(monday.value == 0){
    document.getElementById("mondayf").classList.remove('button-bg');
    document.getElementById("mondayf").classList.add('button-bg-clicked');
    monday.value = 1;
  }else{
    document.getElementById("mondayf").classList.remove('button-bg-clicked');
    document.getElementById("mondayf").classList.add('button-bg');
    monday.value = 0;
  }
}

function setValueTuesday(){
  var tuesday = document.getElementById("tuesday");
  if(tuesday.value == 0){
    document.getElementById("tuesdayf").classList.remove('button-bg');
    document.getElementById("tuesdayf").classList.add('button-bg-clicked');
    tuesday.value = 1;
  }else{
    document.getElementById("tuesdayf").classList.remove('button-bg-clicked');
    document.getElementById("tuesdayf").classList.add('button-bg');
    tuesday.value = 0;
  }
}

function setValueForWednesday(){
  var wednesday = document.getElementById("wednesday");
  if(wednesday.value == 0){
    document.getElementById("wednesdayf").classList.remove('button-bg');
    document.getElementById("wednesdayf").classList.add('button-bg-clicked');
    wednesday.value = 1;
  }else{
    document.getElementById("wednesdayf").classList.remove('button-bg-clicked');
    document.getElementById("wednesdayf").classList.add('button-bg');
    wednesday.value = 0;
  }
}

function setValueForThursday(){
  var thursday = document.getElementById("thursday");
  if(thursday.value == 0){
    document.getElementById("thursdayf").classList.remove('button-bg');
    document.getElementById("thursdayf").classList.add('button-bg-clicked');
    thursday.value = 1;
  }else{
    document.getElementById("thursdayf").classList.remove('button-bg-clicked');
    document.getElementById("thursdayf").classList.add('button-bg');
    thursday.value = 0;
  }
}

function setValueForFriday(){
  var friday = document.getElementById("friday");
  if(friday.value == 0){
    document.getElementById("fridayf").classList.remove('button-bg');
    document.getElementById("fridayf").classList.add('button-bg-clicked');
    friday.value = 1;
  }else{
    document.getElementById("fridayf").classList.remove('button-bg-clicked');
    document.getElementById("fridayf").classList.add('button-bg');
    friday.value = 0;
  }
}

function setValueForSaturday(){
  var saturday = document.getElementById("saturday");
  if(saturday.value == 0){
    document.getElementById("saturdayf").classList.remove('button-bg');
    document.getElementById("saturdayf").classList.add('button-bg-clicked');
    saturday.value = 1;
  }else{
    document.getElementById("saturdayf").classList.remove('button-bg-clicked');
    document.getElementById("saturdayf").classList.add('button-bg');
    saturday.value = 0;
  }
}

function setValueForSunday(){
  var sunday = document.getElementById("sunday");
  if(sunday.value == 0){
    document.getElementById("sundayf").classList.remove('button-bg');
    document.getElementById("sundayf").classList.add('button-bg-clicked');
    sunday.value = 1;
  }else{
    document.getElementById("sundayf").classList.remove('button-bg-clicked');
    document.getElementById("sundayf").classList.add('button-bg');
    sunday.value = 0;
  }
}
function infoChangeName(){
  window.alert("请在我的档案处修改名字.");
}
$(document).ready(function() {
  var html = $(".copy-fields").html();
  $(".after-add-more").after(html);
  $(".add-more").click(function(){
    count++
    if(count <= 2){
      var html = $(".copy-fields").html();
      $(".after-add-more").after(html);
    }else{
      window.alert("最多只能选三门课");
    }
  });
});

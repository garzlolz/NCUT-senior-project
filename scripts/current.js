var x=document.getElementById("sens").innerHTML;

if(x>3000){
    $(document).ready(function () {
        $(".ui-block-a").css("background-color","rgb(167, 45, 8)")
        $("#advice").css("background-color","rgb(167, 45, 8)")
         $("#testt").text("狀態 : 請開啟空氣清淨機!");
    });
}
else if(x>1050){
    $(document).ready(function () {
        $(".ui-block-a").css("background-color","purple")
        $("#advice").css("background-color","purple")
        $("#testt").text("狀態 : 請開啟空氣清淨機!");
    });
}
else if(x>300){
    $(document).ready(function () {
        $(".ui-block-a").css("background-color","red")  
        $("#advice").css("background-color","red")
        $("#testt").text("狀態 : 請開啟空氣清淨機!");
    });
}
else if(x>150){
    $(document).ready(function () {
        $(".ui-block-a").css("background-color","orange")
        $("#advice").css("background-color","orange")
        $("#testt").text("狀態 : 請戴上口罩!");
    });
}
else if(x>75){
    $(document).ready(function () {
        $(".ui-block-a").css("background-color","yellow")
        $("#advice").css("background-color","yellow")
        $("#testt").text("狀態 : 開啟窗戶通風");
    });
}
else if(x>0 && x<75){
    $(document).ready(function () {
        $(".ui-block-a").css("background-color","green")
        $("#advice").css("background-color","green")
        $("#testt").text("狀態:良好");
    });
}


$(document).ready(function(){
    $(".okbtn").on("click",function(){
        $("#section-cookie").css("display","none");
    });
    
    $(window).scroll(function(){
        if(this.scrollY > 450){
            $(".scroll-icon").css("display","flex");
            $("#section-cookie").css("z-index", "9999");
            $(".message-icon").css("bottom","190px");
        }else{
            $(".scroll-icon").css("display","none");
            $("#section-cookie").css("z-index", "-1");
            $(".message-icon").css("bottom","70px");
        }
    });
});
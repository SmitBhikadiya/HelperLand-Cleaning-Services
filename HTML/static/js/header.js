$(document).ready(function(){
    $(".menu-bar").click(function(){
        $('.nav-list').toggleClass("active");
        $('.menu-bar i').toggleClass("active");
    });
    $(window).scroll(function(){
        if(this.scrollY > 30){
            $(".navbar").addClass("sticky");
        }else{
            $(".navbar").removeClass("sticky");
        }
    });
});
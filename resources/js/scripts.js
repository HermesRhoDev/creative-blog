$(window).scroll(() => { 
    let scroll = $(window).scrollTop();

    if(scroll >= 50){
        $("#header_navbar").addClass("shadow");
    }else{
        $("#header_navbar").removeClass("shadow");
    }
});
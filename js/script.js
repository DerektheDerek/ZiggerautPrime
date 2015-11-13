$("#tbl").DataTable({
    responsive: true,
    paging: false,
    ordering: 4
});

$("#tbl").css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 500);

$(document).ready(function(){
   
   $("div[id*='_length']").css("display", "none");
   $(".home-center").delay(500).css({opacity: 0, visibility: "visible"}).animate({
       opacity: 1
       }, 1500 
    );
    $(".home-center").animate({
        "top": "-=50px",
       "queue": false
        }, 900
    )
    $(".hell-hole").delay(3500).css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 2000);
});
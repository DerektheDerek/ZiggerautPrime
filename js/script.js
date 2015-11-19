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
    
    
    //Set the active attribute to the page in the header
    if(fileName(window.location.href).split(".")[0] == ""){
        var desktop_view = $("#nav").children("li")[0];
        var mobile_view = $("#side-nav").children("li")[0];
        $(desktop_view).children("a").addClass("active");
        $(mobile_view).children("a").addClass("active");
    }
    else{
        $(".nav-btn:contains('"+fileName(window.location.href).split(".")[0].toUpperCase()+"')").each(function(){
            $(this).addClass("active"); 
        });
    }
});


function fileName(href){
    return href.replace(/^.*[\\\/]/, '');
}

    
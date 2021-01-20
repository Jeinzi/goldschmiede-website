$(document).on("click",".gallery-thumbnail", function (e) {
    //alert(event.target.id);
    $("#carousel-div").show();
});

$(document).on("click",".carousel-item", function (e) {
    $("#carousel-div").hide();
});

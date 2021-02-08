function resizeImageContainer() {
    $('.square-container').css('width', 'auto');
    $('.square-container').css('width', $("#gallery-image").width()+'px');
}

$(window).resize(resizeImageContainer);

window.onload = function() {
    $("#gallery-image").on('load', function() {
        $(".gallery-viewer-container").show();
        resizeImageContainer();
    });
}

$('.gallery-thumbnail').click(function() {
    path = $(this).attr("src").replace("thumbnails/", "");
    img = $("#gallery-image");
    img.attr("src", path);
    $("#gallery-title").text($(this).attr("data-title"));
    $("#gallery-subtitle").text($(this).attr("data-subtitle"));
});

$('.gallery-viewer-container').click(function() {
    $(".gallery-viewer-container").hide();
})

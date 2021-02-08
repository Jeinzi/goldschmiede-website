window.onload = function() {
    $("#gallery-image").on('load', function() {
        $(".gallery-viewer-container").show();
        $('.square-container').css('width', $("#gallery-image").width()+'px');
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
    $('.square-container').css('width', 'auto');
})

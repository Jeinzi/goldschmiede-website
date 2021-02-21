function resizeImageContainer() {
    $('.content-container').css('width', 'auto');
    $('.content-container').css('height', 'auto');
    imageHeight = $("#gallery-image").height() + 'px';
    containerHeight = $(".content-container").height() + 'px'
    $('.content-container').css('width', imageHeight).css('height', containerHeight);
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
    $("#gallery-title").text($(this).attr("alt"));
    $("#gallery-subtitle").text($(this).attr("data-subtitle"));
});

$('.gallery-viewer-container').click(function() {
    $(".gallery-viewer-container").hide();
})

$('.text-container').click(function(e) {
   e.stopPropagation();
})

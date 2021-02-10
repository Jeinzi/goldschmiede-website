// Credits: R0bb13, https://markmail.org/message/hilbsejsl4zxwlv6#query:+page:1+mid:hilbsejsl4zxwlv6+state:results
function rgb2hex(rgb) {
    var hexDigits = ["0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"];
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {
     return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
    }
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function getActiveId() {
    return getActiveTag().attr("data-id");
}

function getActiveTag() {
    return $("#tag-container>.activeBadge");
}

function getCurrentColor() {
    return $("#input-color").val();
}

function getCurrentTextColor() {
    col = rgb2hex($("#button-text-color").css("color"));
    return col;
}

function getCurrentName() {
    return $("#input-name").val()
}
   
function selectTag(tag) {
    getActiveTag().removeClass("activeBadge");
    tag.addClass("activeBadge");
    $("#input-name").val(tag.text());
    $("#input-color").val(rgb2hex(tag.css("background-color")));
    $("#button-text-color").css("color", tag.css("color"));
    $("#button-text-color").css("background-color", tag.css("background-color"));
}

function showChanges() {
    tag = getActiveTag();
    tag.css("background-color", getCurrentColor());
    tag.css("color", getCurrentTextColor());
    tag.text(getCurrentName());
}

$('#input-name').on('input', function() {
	showChanges();
});

$('#input-color').on('input', function() {
    $("#button-text-color").css("background-color", getCurrentColor());
	showChanges();
});


$(document).on("click", ".badge", function() {
    selectTag($(this));
});

$("#button-upload").click(function() {
    $.get("update-tag", {id: getActiveId(), name: getCurrentName(), color: getCurrentColor().slice(1,7), textColor: getCurrentTextColor().slice(1,7)}, function(data) {
        if (data == 0) {
            return;
        }
    });
});

$("#button-delete").click(function() {
    $.get("update-tag", {delete: true, id: getActiveId()}, function(data) {
        if (data == 0) {
            return;
        }
        tag = getActiveTag();
        nextTag = tag.next();
        if (nextTag.length != 0) {
            selectTag(nextTag);
            tag.remove();
        }
        else if ((prevTag = tag.prev()).length != 0) {
            selectTag(prevTag);
            tag.remove();
        }
        else {
            alert("New tag creation not supported.")
        }
    });
});

$("#button-text-color").click(function() {
    if (rgb2hex($(this).css("color")) == "#000000") {
        $(this).css("color", "#FFFFFF");
    }
    else {
        $(this).css("color", "#000000");
    }
    $(this).one('transitionend', showChanges);
});

// Select first tag.
selectTag($("#tag-container a:first-child"));
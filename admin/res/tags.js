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
    if (tag.length == 0) {
        // No tag passed to function.
        return;
    }
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

$("#input-name").on("input", function() {
    showChanges();
});


$("#input-color").on("input", function() {
    $("#button-text-color").css("background-color", getCurrentColor());
    showChanges();
});


// Remove tags that have not been uploaded.
function removeNotUploaded() {
    $("#tag-container").children(":not([data-id])").remove();
}


$(document).on("click", ".badge", function() {
    selectTag($(this));
    resetUploadButton();
    removeNotUploaded();
});


$("#button-upload").click(function() {
    updateTag();
});


$("#input-name").keypress(function(e) {
    if(e.which == 13) {
        updateTag();
    }
});


function updateTag() {
    id = getActiveId();
    if (getActiveTag().length == 0) {
        alert("Bitte erst einen Tag hinzufügen.");
        return;
    }
    $.get("update-tag", {
        id: getActiveId(),
        name: getCurrentName(),
        color: getCurrentColor().slice(1,7),
        textColor: getCurrentTextColor().slice(1,7)
    },
    function(response) {
        var newClass = "";
        if (id == null) {
            // A new tag has been uploaded. The return value is its
            // id or 0 on error. Yes, this will fail if the database
            // is empty.
            getActiveTag().attr("data-id", response);
            newClass = (response != 0 ? "btn-success" : "btn-danger");
        }
        else {
            // An existing tag has been updated.
            newClass = (response == 1 ? "btn-success" : "btn-danger");
        }
        $("#button-upload").addClass(newClass);
    });
}


function resetUploadButton() {
    $("#button-upload").removeClass("btn-success")
                       .removeClass("btn-danger");
}


$("#input-name").on("input", function() {
    resetUploadButton();
});


$("#button-delete").click(function() {
    $(".modal-body").text(`Soll der Tag "${getCurrentName()}" wirklich gelöscht werden? Es werden auch alle Zuordnungen dieses Tags zu Bildern gelöscht.`);
});

$("#button-delete-definitely").click(function() {
    if (getActiveId() == null) {
        return;
    }
    $.get("update-tag", {delete: true, id: getActiveId()}, function(response) {
        if (response == 0) {
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
            tag.remove();
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


function addNewTag() {
    var letters = '0123456789ABCDEF';
    var bgColor = '#';
    for (var i = 0; i < 6; i++) {
        bgColor += letters[Math.floor(Math.random() * 16)];
    }
    var obj = $("<span>").addClass("badge")
                         .addClass("tag")
                         .css("color", "#000000")
                         .css("background-color", bgColor)
                         .text(" ");
    $("#tag-container").append(obj);
    $(" ").insertAfter(obj);
    selectTag(obj);
    $("#input-name").val("");
    $("#input-name").focus();
}

$("#button-add-tag").click(function() {
    removeNotUploaded();
    addNewTag();
});



// Select first tag.
selectTag($("#tag-container span:first-child"));

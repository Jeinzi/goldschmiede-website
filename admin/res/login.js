$("#login-button").click(function() {
  checkLogin();
});

$(".card-login").on('keypress',function(e) {
  // If enter has been pressed.
    if (e.which == 13) {
        checkLogin();
    }
});

function checkLogin() {
  var username = $("#input-username").val();
  var password = $("#input-password").val();
  jsonData = {username: username, password: password, checkCredentialsOnly: true};
  $.post('login-processing.php', jsonData).done(function(data) {
    data = JSON.parse(data);
    failDiv = $("#fail-div");
    animationName = failDiv.css("animation-name");

    if (data.validLogin === true) {
      jsonData.checkCredentialsOnly = false;
      sendForm("login-processing.php", jsonData, "post");
    }
    else if (animationName == "none") {
      failDiv.css("display", "flex");
      failDiv.css("background-color", "#d9534f");
      failDiv.css("animation-name", "login-failed-swing");
      failDiv.children().removeClass("d-none");
      loginCard = $(".card-login");
      loginCard.css("border-bottom-left-radius", "0px");
      loginCard.css("border-bottom-right-radius", "0px");
    }
    else {
      failDiv.css("animation-name", "none");
      failDiv.css("animation-duration", "1s");
      failDiv.css("animation-timing-function", "ease-in-out");
      setTimeout(swingAgain, 50);
    }
  });
}

function swingAgain() {
  $("#fail-div").css("animation-name", "login-failed-swing-again");
}

function sendForm(path, params, method) {
    method = method || "post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

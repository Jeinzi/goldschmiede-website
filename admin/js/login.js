var xmlHttp = createXmlHttpRequestObject();

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
	if (xmlHttp.readyState == 0 || xmlHttp.readyState == 4) {
		user = encodeURIComponent(document.getElementsByName("input-username")[0].value);
		password = encodeURIComponent(document.getElementsByName("input-password")[0].value);
		xmlHttp.open("POST", "check-login.php", true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send("username=" + user + "&password=" + password);
		xmlHttp.onreadystatechange = handleServerResponse;
	}
}


function createXmlHttpRequestObject() {
	var xmlHttp;
	if (window.ActiveXObject) {
		try {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e) {
			xmlHttp = false;
		}
	}
	else {
		try {
			xmlHttp = new XMLHttpRequest();
		}
		catch(e) {
			xmlHttp = false;
		}
	}

	if (!xmlHttp) {
		alert("Something went horribly wrong. Most likely, your browser does not support AJAX. Sorry mate, but you can't login that way."); /* TODO: Other popup box */
	}
	else {
		return(xmlHttp);
	}
}


function handleServerResponse() {
	validLogin = "false";
	if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
		xmlResponse = xmlHttp.responseXML;
		xmlDocumentElement = xmlResponse.documentElement;
		validLogin = xmlDocumentElement.firstChild.data;
	}
	else {
		return;
	}

	if (validLogin == "true") {
		var username = document.getElementsByName("input-username")[0].value;
		var password = document.getElementsByName("input-password")[0].value;
		var data = {};
		data['username'] = username;
		data['password'] = password;
		post("login-process.php", data, "post");
		return;
	}

	failDiv = $("#fail-div");
	animationName = failDiv.css("animation-name");

	if (animationName == "none") {
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
}


function swingAgain() {
	$("#fail-div").css("animation-name", "login-failed-swing-again");
}


function post(path, params, method) {
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

function getUploadId() {
	return 1;
}
// Load data from server and display it in input fields.
$('.input-group-append .button-upload').each(function() {
	fillInputField($(this), 1);
});

// Output email list item
function outputEmail(email, id) {
	var input = $(".list-group-item>input").parent().detach();
	$(".list-group").append(`<div class="list-group-item email-li-item">
	 <div class="email">${email}</div>
	 <div class="email-append"><button class="btn email-button" data-id="${id}"><img src="/svg/trash-fill-white.svg" alt="Mülleimer-Symbol"></button></div>
	 </div>`);
	 $(".list-group").append(input);
}

// Delete emails.
$(document).on("click", ".email-button", function() {
	var button = $(this);
	$.get("delete-email.php", {id: button.attr("data-id")}, function(data) {
		if (data == 1) {
			button.parent().parent().remove();
		}
	});
});

// Add emails.
$("#add-email-button").click(function() {
	var input = $(this).parent().siblings("input");
	var email = input.val().trim();
	if (email === "") {
		return;
	}
	$.get("add-email.php", {email: email}, function(data) {
			console.log(data);
		if (data != 0) {
			input.val("");
			outputEmail(email, data);
		}
	})
});

// When pressing enter in an input field, execute the corresponding button's action.
$('.list-group-item>input').keypress(function(e) {
	// Exit if the enter key hasn't been pressed.
	if(e.which != 13) {
		return;
	}

	$("#add-email-button").click();
});

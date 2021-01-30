/**************** METHODS ****************/

// Reset the state of all buttons.
function resetUploadButtons() {
	$('.input-group-append .button-upload').each(function() {
		resetUploadButton($(this));
	})
}

function resetUploadButton(uploadButton) {
	uploadButton.removeClass().addClass('btn btn-outline-input button-upload')
	            .children().attr("src", "/svg/cloud-upload-fill.svg");
}

// Get data from the server and fill it in the text field.
function fillInputField(uploadButton, id)
{
    var input = uploadButton.parent().siblings("input, textarea");

	// Request and display information.
	$.get('get-data.php', {path: input.attr('data-db-path'), "id": id}).done(function(data) {
        data = JSON.parse(data);
		input.val(data.value);
	});
}

// Fill all input fields with data from the database.
function fillInputFields() {
    var id = getActiveListItemId();
    $('.input-group-append .button-upload').each(function() {
        fillInputField($(this), id);
    })
}



/**************** BINDINGS ****************/

$('.input-group-append .button-upload').click(function() {
	uploadFieldData($(this), getUploadId());
})

// Upload data from an input field to the database.
// button: A button attached to an input field
// id: The row id in the database to modify
function uploadFieldData(button, id) {
	// Return if the button has already been pressed and the input has not changed since.
	if(button.hasClass('btn-success') || button.hasClass('btn-danger')) {
		return;
	}

	var input = button.parent().siblings("input, textarea");
	var payloadString = `{"id":"${id}","path":"${input.attr('data-db-path')}","value":"${input.val()}"}`;
	var jsonObject = JSON.parse(payloadString);

    // Send an update request to the server with the data field to be updated
    // and the row's id along with the new data.
	$.get('update-data.php', jsonObject).done(function(data) {
		// Adapt the button style according to the success of the request.
		if(data == 1) {
			button.children().attr("src", "/svg/check-circle-fill-white.svg");
			button.removeClass().addClass('btn btn-success button-upload');
		}
		else {
			button.children().attr("src", "/svg/x-white.svg");
			button.removeClass().addClass('btn btn-danger button-upload');
		}
	});
}

// Reset button state if something is entered into the corresponding input field.
$('input, textarea').on('input', function() {
	resetUploadButton($(this).siblings(".input-group-append").children("button"));
});

// When pressing enter in an input field, execute the corresponding button's action.
$('div.input-group input').keypress(function(e) {
	// Exit if the enter key hasn't been pressed.
	if(e.which != 13) {
		return;
	}

	clickUpdateButton.call($(this).siblings('.input-group-append').children());
});

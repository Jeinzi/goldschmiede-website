/**************** METHODS ****************/

// Take a text input and reset the state of the corresponding button.
function resetInputButton(inputField) {
	inputField.siblings('.input-group-append')
			  .children().removeClass().addClass('btn btn-outline-input')
			  .children().attr("src", "/svg/cloud-upload-fill.svg");
}

// Get data from the server and fill it in the text field.
function fillInputField(uploadButton, id)
{
    var input = uploadButton.parent().siblings("input, textarea");

	// Request and display information.
	$.get('get-data.php', {path: input.attr('data-db-path'), "id": id}).done(function(data) {
        data = JSON.parse(data);
		resetInputButton(input.val(data.value));
	});
}



/**************** BINDINGS ****************/

// Click on one of the buttons attached to an input field, except the delete button.
$('.input-group-append .button-upload').click(clickUpdateButton);

function clickUpdateButton() {
	// Return if the button has already been pressed and the input has not changed since.
	var button = $(this);
	if(button.hasClass('btn-success') || button.hasClass('btn-danger')) {
		return;
	}

	var id = 1;
	var input = button.parent().siblings("input, textarea");

	var payloadString = `{"id":"${id}","path":"${input.attr('data-db-path')}","value":"${input.val()}"}`;
	var jsonObject = JSON.parse(payloadString);

    // Send an update request to the server with the data field to be updated
    // and the row's id along with the new data.
	$.get('update-data.php', jsonObject).done(function(data) {
		// Adapt the button style according to the success of the request.
		if(data == 1) {
			button.children().attr("src", "/svg/check-circle-fill-white.svg");
			button.removeClass().addClass('btn btn-success');
		}
		else {
			button.children().attr("src", "/svg/x-white.svg");
			button.removeClass().addClass('btn btn-danger');
		}
	});
}

// Reset button state if something is entered into the corresponding input field.
$('input, textarea').on('input', function() {
	resetInputButton($(this));
});

// When pressing enter in an input field, execute the corresponding button's action.
$('div.input-group input').keypress(function(e) {
	// Exit if the enter key hasn't been pressed.
	if(e.which != 13) {
		return;
	}

	clickUpdateButton.call($(this).siblings('.input-group-append').children());
});

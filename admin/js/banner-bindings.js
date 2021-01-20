/**************** Switch project ****************/

// Click on one of the projects in the project list.
$('a.list-group-item').click(function() {
	// If the user clicked on the currently active project, do nothing.
	if($(this).hasClass('list-group-item-primary')) {
		return;
	}

	// Add the active class and remove it from all other list items.
	var bannerId = $(this).attr('data-id');
	$(this).parent().children('a').removeClass('list-group-item-primary');
	$(this).removeClass("list-group-item-secondary").addClass('list-group-item-primary');
	$("#banner-preview").attr("src", "/img/banner/" + $(this).text());

	getAndUpdateData(bannerId);
});


/**************** Update info in database ****************/

// Click on one of the buttons attached to an input field, except the delete button.
$('.input-group-append button').not('#button-delete').click(clickUpdateButton);

function clickUpdateButton() {
	// Return if the button has already been pressed and the input has not changed since.
	var button = $(this);
	if(button.hasClass('btn-success') || button.hasClass('btn-danger')) {
		return;
	}

	var activeId = getActiveBannerId();
	var input = button.parent().siblings("input, textarea");

	var payloadString = '{"bannerId":"' + activeId + '","' + input.attr('id') + '":"' + input.val() + '"}';
	var jsonObject = JSON.parse(payloadString);
	//TODO alert(payloadString);

	// Send an update request to the server with the current project's id and
	// the data field to be updated along with the new data.
	$.get('update-banner-data.php', jsonObject).done(function(data) {
		// Adapt the button style according to the success of the request.
		if(data == 1)	{
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
	// Exit, if the enter key hasn't been pressed.
	if(e.which != 13) {
		return;
	}

	clickUpdateButton.call($(this).siblings('.input-group-append').children());
});


/**************** Project deletion ****************/

// Input into the text box that controls the deletion of the currently active project.
$('#inputDelete').on('input', function(e) {
	// If the text matches the project's name, enable the button, otherwise disable it.
	if($(this).val() == $('#inputNameDE').val()) {
		$('#buttonDelete').removeClass('disabled');
	}
	else {
		$('#buttonDelete').addClass('disabled');
	}
});


// Click on the button that deletes the currently active project.
$('#buttonDelete').click(clickDeleteButton);

function clickDeleteButton() {
	var bannerId = getActivebannerId();

	// If the text in the input field does not match the project's name, abort.
	if($('#inputDelete').val() != $('#inputNameDE').val()) {
		return;
	}

	// Send a delete request to the server.
	$.get('delete-project.php', {bannerId: bannerId}).done(function(data) {
		if(data == 1) {
			// If the deletion was successful on the server side,
			// remove the corresponding list item.
			var activeElement = getActiveListElement();

			// Hide the parent list, if there are no other projects within.
			var newActiveElement;
			if (activeElement.siblings('button.list-group-item').length == 0) {
				activeElement.parent().hide();
				// If there are no projects left at all, adapt the screen and quit.
				if($('#listGroupListed').is(':hidden') && $('#listGroupUnlisted').is(':hidden')) {
					noProjectsDetected();
					return;
				}

				// If there are still projects in the other list, put the project there.
				var newActiveElementParentId = activeElement.parent().attr('id') == "listGroupUnlisted" ? "#listGroupListed" : "#listGroupUnlisted";
				newActiveElement = $(newActiveElementParentId).children('button.list-group-item').first();
			}
			else {
				var nextElement = activeElement.next('button.list-group-item');
				if(nextElement.length != 0) {
					newActiveElement = nextElement;
				}
				else {
					newActiveElement = activeElement.prev();
				}
			}
			activeElement.remove();
			newActiveElement.addClass('active');

			getAndUpdateData(newActiveElement.attr('bannerId'));
		}
	});
}


/**************** Toggle listing ****************/

// Change of the button toggling whether the banner is listed.
$('#input-is-active').change(function(e, context) {
	// Change the database entry.
	var bannerId = getActiveBannerId();
	var jsonObject = {"bannerId": bannerId, "input-is-active": $(this).prop('checked') == true ? 1 : 0};
	$.get('update-banner-data.php', jsonObject).done(function(data) {
		if (data == 1) {
			//$(this).popover()
		}
	});
});

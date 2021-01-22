/**************** METHODS ****************/

// To be executed, if there are no projects to be listed.
function noProjectsDetected()
{
	// Remove the project info section and hide the project lists.
	$('#dataDisplay').remove();
	$('#listGroupListed').hide();
	$('#listGroupUnlisted').hide();

	// Insert a notification.
	$('#projectList').html('<div class="list-group"><li class="list-group-item"><h4>Keine Projekte vorhanden.</h4></li></div>');
}

// Gets a complete set of the banner data for a given banner id from the server
// and updates all inputs and the view graph accordingly.
function getAndUpdateData(bannerId)
{
	// Request banner information.
	$.get('get-banner-data.php', {bannerId: bannerId}).done(function(data) {
		data = JSON.parse(data);

		// Update all the input fields and reset the state of their corresponding buttons.
		resetInputButton($('#input-title').val(data.title));
		resetInputButton($('#input-subtitle').val(data.subtitle));

		$('#input-is-active').bootstrapToggle(data.active == 1 ? 'on' : 'off', true);
	});
}

// Get the id of the currently active banner.
function getActiveListElement() {
	return $('a.list-group-item.list-group-item-primary');
}

function getActiveBannerId() {
	return getActiveListElement().attr('data-id');
}




/******************* BINDINGS *******************/
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

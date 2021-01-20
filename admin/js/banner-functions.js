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

// Gets a complete se of the banner data for a given banner id from the server
// and updates all inputs and the view graph accordingly.
function getAndUpdateData(bannerId)
{
	// Request banner information.
	$.get('get-banner-data.php', {bannerId: bannerId}).done(function(data) {
		data = JSON.parse(data);

		// Update all the input fields and reset the state of their corresponding buttons..
		resetInputButton($('#input-title').val(data.title));
		resetInputButton($('#input-subtitle').val(data.subtitle));

		$('#input-is-active').bootstrapToggle(data.active == 1 ? 'on' : 'off', true);
	});
}

// Takes a text input and resets the state of the corresponding button.
function resetInputButton(inputField) {
	inputField.siblings('.input-group-append')
			  .children().removeClass().addClass('btn btn-outline-input')
			  .children().attr("src", "/svg/cloud-upload-fill.svg");
}

// Get the id of the currently active banner.
function getActiveListElement() {
	return $('a.list-group-item.list-group-item-primary');
}

function getActiveBannerId() {
	return getActiveListElement().attr('data-id');
}

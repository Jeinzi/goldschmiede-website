// Click on the button that deletes the currently active banner.
$('#button-delete').click(clickDeleteButton);


function clickDeleteButton() {
	var bannerId = getActiveListItemId();

	// Send a deletion request to the server.
	$.get('/admin/delete-banner.php', {bannerId: bannerId}).done(function(data) {
		if(data == 1) {
			// If the deletion was successful on the server side,
			// remove the corresponding list item.
			var activeElement = getActiveListItem();

			// Choose an other list item.
			var newActiveElement;
			if (activeElement.siblings('a.list-group-item').length != 0) {
				var nextElement = activeElement.next('a.list-group-item');
				if(nextElement.length != 0) {
					newActiveElement = nextElement;
				}
				else {
					newActiveElement = activeElement.prev();
				}
			}
			activeElement.remove();
			
			// If there is at least one list item left, make it active.
			if (typeof newActiveElement !== 'undefined') {
				newActiveElement.addClass('list-group-item-primary');
			}
			fillInputFields(); //TODO: Clear fields when no list items remaining
		}
	});
}


// Change of the button which toggles whether the banner is listed.
$('#input-is-active').change(function(e, context) {
	// Change the database entry.
	var bannerId = getActiveListItemId();
	var jsonObject = {"bannerId": bannerId, "input-is-active": $(this).prop('checked') == true ? 1 : 0};
	$.get('update-banner-data.php', jsonObject).done(function(data) {
		if (data == 1) {
			// TODO: Feedback
		}
	});
});

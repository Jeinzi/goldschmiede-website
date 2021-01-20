// Hide empty lists and choose the first project
// in the first visible list to be active.
var areProjectsListed = true;
var buttonsListed = $('#listGroupListed').children('button').length;
var buttonsUnlisted = $('#listGroupUnlisted').children('button').length;

if(buttonsListed != "")
{
	$('#listGroupListed').children('button.list-group-item').first().addClass('active');
	if(buttonsUnlisted == "") {
		$('#listGroupUnlisted').hide();
	}
}
else if(buttonsListed == "" && buttonsUnlisted != "")
{
	$('#listGroupUnlisted').children('button.list-group-item').first().addClass('active');
	$('#listGroupListed').hide();
}
else if(buttonsListed == "" && buttonsUnlisted == "")
{
	noProjectsDetected();
	areProjectsListed = false;
}

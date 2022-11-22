/**************** METHODS ****************/

// Get the currently active list item.
function getActiveListItem() {
  return $('a.list-group-item.list-group-item-primary');
}

// Get the ID of the currently active list item.
function getActiveListItemId() {
  return getActiveListItem().attr('data-id');
}


/******************* BINDINGS *******************/

// Click on one of the entries in the list.
$('a.list-group-item').click(function() {
  // If the user clicked on the currently active entry, do nothing.
  if($(this).hasClass('list-group-item-primary')) {
    return;
  }

  // Add the active class and remove it from all other list items.
  //var bannerId = $(this).attr('data-id');
  $(this).parent().children('a').removeClass('list-group-item-primary');
  $(this).removeClass("list-group-item-secondary").addClass('list-group-item-primary');

  onListItemChange($(this));
});

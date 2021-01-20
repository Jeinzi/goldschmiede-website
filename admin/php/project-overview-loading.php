<?php
// Get list of all projects.
$connection = ConnectDB();
$query = "SELECT * FROM projects";
$result = $connection->query($query);
if ($result == false)
{
	Error("Failed to query projects.");
}

// Output list of existing projects as buttons.
$buttonsListed = "";
$buttonsUnlisted = "";
foreach ($result as $row)
{
	// Get total views.
	$query = 'SELECT SUM(count) AS totalViews FROM views WHERE projectId=' . $row['id'];
	$viewResult = $connection->query($query);
	if ($viewResult == false)
	{
		Error("Failed to query views.");
	}
	$views = $viewResult->fetch(PDO::FETCH_ASSOC)['totalViews'];

	$newButton = '<button type="button" class="list-group-item'
				. '" projectid=' . $row['id'] .'>' . $row['titleDE']
				. '<span class="badge">' . $views . '</span> </button>';

	// Add button either to listed or unlisted project list.
	if($row['isListed'] == true && is_dir('../projects/' . $row['directory']))
	{
		$buttonsListed .= $newButton;
	}
	else {
		$buttonsUnlisted .= $newButton;
	}
}

// Output projec lists.
echo '<div class="list-group" id="listGroupListed">';
echo '<li class="list-group-item"><h4>Aktive Projekte</h4></li>';
echo $buttonsListed;
echo '</div>';

echo '<div class="list-group" id="listGroupUnlisted">';
echo '<li class="list-group-item"><h4>Inaktive Projekte</h4></li>';
echo $buttonsUnlisted;
echo '</div>';
?>

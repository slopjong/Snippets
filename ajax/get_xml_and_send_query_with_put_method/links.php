<ul>

<?php
	$links = array(
		"index" => "Performing an ajax request to fetch XML data",
		'get_parameter_with_put_method' => 'Performing a PUT request while passing a GET parameter',
	);
	
	foreach($links as $script => $title)
		echo '<li><a href="'. $script .'.php">'. $title .'</a></li>';
?>

</ul>

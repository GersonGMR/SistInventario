<?php

session_start();

if (!isset($_SESSION['count']))
	$_SESSION['count'] = 0;
else
	$_SESSION['count']++;

echo "This is the session " . $_SESSION['count'] . "<br/>";

echo '<h3> SESSION </h3>';

foreach( $_SESSION as $key => $val ) {
	echo '_$SESSION[' . $key . '] = ' . $val . '<br/>';
}
//print_r( $_SESSION );

exit();
?>

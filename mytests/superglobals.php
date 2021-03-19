<?php
	
// Generate a formatted list with all globals
// =============================================
// Custom global variable $_CUSTOM
//
$_CUSTOM = array( 'USERNAME' => 'john', 'USERID' => '12345' );

// List here whichever globals you want to print
// This could be your our custom globals
$globals = array(
	'$_SERVER' => $_SERVER, '$_ENV' => $_ENV,
	'$_REQUEST' => $_REQUEST, '$_POST' => $_POST, 
	'$_GET' => $_GET, '$_COOKIE' => $_COOKIE,
	'$_FILES' => $_FILES, '$_CUSTOM' => $_CUSTOM
);
?>

<html>
	<style type="text/css">
		.left {
			font-weight: 700;
		}
		.right {
			font-weight: 700;
			color: #009;
		}
		.key {
			color: #d00;
			font-style: italic;
		}
	</style>
	<body>
		<?php
		// Generate the output
		echo '<h1> Superglobals </h1>';
		foreach( $globals as $globalkey => $global ) {
			echo '<h3>' . $globalkey . '</h3>';
			foreach( $global as $key => $value ) {
				echo '<span class="left">' . $globalkey . '</span>'
					. '[<span class="key">\'' . $key . '\'</span>]'
					. ' = <span class="right">' . $value . '</span><br/>';
			}
		}
		?>
	</body>
</html>
	


	
		

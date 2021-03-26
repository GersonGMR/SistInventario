<?php
     //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	$conexion = new mysqli("localhost","root","","pos_mvc");

	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>

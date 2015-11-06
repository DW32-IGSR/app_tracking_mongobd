<?php

$email = $_POST['email'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

if ($pass == $pass2) {
    
    require_once("conexion.class.php");
    $m = conexion::conectar();
    $db = $m->selectDB('app_tracking');
    $collection = $db->usuarios;
    $collection->update(
        array('email' => $email),
        array('$set' => array("pass" => md5($pass))));
        
        ob_start();
		header('refresh: 3; ../');
		echo "La contraseña se ha cambiado correctamente";
		ob_end_flush();
} else {
	echo "Las contrasenyas no coinciden";
}





<?php

$email = $_POST['email'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];

if ($pass == $pass2) {
    require_once("conexion.class.php");
    $db = Conexion::conectar();
    
    try {	
    	$stmt = $db->prepare('UPDATE usuario SET pass=:pass WHERE email=:email');
    	$stmt->bindParam(':pass', md5($pass));
    	$stmt->bindParam(':email', $email);
        $stmt->execute();
        
        ob_start();
		header('refresh: 3; ../');
		echo "La contraseña se ha cambiado correctamente";
		ob_end_flush();
        
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    
    
    /*echo "<br>Email: " . $email;
    echo "<br>Pass: " . $pass;
    echo "<br>Pass1: " . $pass2;*/
} else {
	echo "Las contrasenyas no coinciden";
}





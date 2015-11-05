<?php
include("conexion.class.php");
$activation_key = $_GET["activation"];

$db = Conexion::conectar();

$db = $m->selectDB('app_tracking');
$collection = $db->usuarios;
$mongo_usuarioKey=array("activacion_key" => "$activation_key");
$cursor = $collection->find($mongo_usuarioKey);


if ($total == 1) {
    //echo "<br>hay";
    try {
        $stm = $db->prepare("UPDATE usuario SET validated=1 WHERE activacion_key=:activacion_key");
        $stm->bindParam(":activacion_key", $activation_key);
        $stm->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    ob_start();
		header('refresh: 3; ../');
		echo "<br>¡Bienvenido!";
		echo "Tu cuenta ha sido activada.";
		ob_end_flush();
} else {
    echo "<br>Error en la activacion de la cuenta.";
}

/*$stm = $db->prepare("SELECT COUNT(1) FROM usuario WHERE activacion_key=:activacion_key");
$stm->bindParam(":activacion_key", $activation_key);
$stm->execute();
$total = $stm->fetchColumn();

if ($total == 1) {
    //echo "<br>hay";
    try {
        $stm = $db->prepare("UPDATE usuario SET validated=1 WHERE activacion_key=:activacion_key");
        $stm->bindParam(":activacion_key", $activation_key);
        $stm->execute();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    ob_start();
		header('refresh: 3; ../');
		echo "<br>¡Bienvenido!";
		echo "Tu cuenta ha sido activada.";
		ob_end_flush();
} else {
    echo "<br>Error en la activacion de la cuenta.";
}*/
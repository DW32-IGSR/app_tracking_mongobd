<?php
require_once("conexion.class.php");
$activation_key = $_GET["activation"];
//var_dump($activation_key);

$m = conexion::conectar();

$db = $m->selectDB('app_tracking');
$collection = $db->usuarios;
$mongo_usuarioKey=array("activacion_key" => "$activation_key");
var_dump($mongo_usuarioKey);
$total = $collection->count($mongo_usuarioKey);
print_r($total);

if ($total == 1) {
    //echo "<br>hay";
        $db = $m->selectDB('app_tracking');
        $collection = $db->usuarios;
        $newdata = array('$set' => array("validated" => 1));
        var_dump($newdata);
        $collection->update(array("activacion_key" => "$activation_key"), $newdata);

    ob_start();
		//header('refresh: 3; ../');
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
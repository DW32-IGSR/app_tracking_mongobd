<?php
include("../model/conexion.class.php");
include_once("../model/email.php");
require '../vendor/autoload.php';
use Mailgun\Mailgun;
$email = $_POST["email"];
//echo "email de usuario: $email <br/>";
//pasar a model
$m = conexion::conectar();
$db = $m->selectDB('app_tracking');
$collection = $db->usuarios;
$newarray=array('email' => "$email");
$cursor = $collection->findOne($newarray);
/*echo "array buscar usuario <br/>";
var_dump($newarray);
echo "array usuario <br/>";
var_dump($cursor);
echo "<br/>";
echo $cursor['_id'];*/

//echo $cursor['usuario'];

$total = $collection->count($newarray);
//var_dump($total);


/*echo "total: " . $total . "<br>";
echo $fila->activacion_key;*/

if ($total == 1) {
    
    Email::reinicioPassword($cursor['usuario'], $email, $cursor['activacion_key']);
   
    ob_start();
		header('refresh: 3; ../');
		echo "Se te ha enviado un correo a email indicado.";
	ob_end_flush();
} else {
    echo "<br>No hay ningún usuario con ese email";
}
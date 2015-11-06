<?php
include("../model/conexion.class.php");
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
    
    # Instantiate the client.
    $mgClient = new Mailgun('key-116da3f3cd011ad01d454a632a599587');
    $domain = "sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org";
    
    # Make the call to the client.
    $result = $mgClient->sendMessage("$domain",
    array('from'    => 'App-Tracking DW32-IGSR <postmaster@sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org>',
        //'to'      => 'IGSR <dw32igsr@gmail.com>',
        'to'      => $cursor['usuario'] . ' ' .$email,
        'subject' => 'Validación de reinicio de contraseña',
        //'text'    => 'Mensaje desde Cloud9'));
        'text'    => "Hola ".$cursor['usuario']."!
                    Recientemente se ha enviado una solicitud de reinicio de tu contraseña para nuestra área de miembros. 
                    Si no solicitaste esto, por favor ignora este correo.
                    Para reiniciar tu contraseña, por favor visita la url a continuación:
                    https://app-tracking-mongodb-nohtrim.c9.io/model/recuperarpassword.php?activation=".$cursor['activacion_key']."&email=".$email.""));
   
    ob_start();
		header('refresh: 3; ../');
		echo "Se te ha enviado un correo a email indicado.";
	ob_end_flush();
} else {
    echo "<br>No hay ningún usuario con ese email";
}
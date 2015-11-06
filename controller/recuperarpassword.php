<?php
include("../model/conexion.class.php");
require '../vendor/autoload.php';
use Mailgun\Mailgun;
$email = $_POST["email"];

$db = Conexion::conectar();

//pasar a model
$stm = $db->prepare("SELECT * FROM usuario WHERE email=:email");
$stm->bindParam(":email", $email);
$stm->execute();
//$resultado = $stm->fetchColumn();
//$total = count($resultado);
$total = $stm->rowCount();
$fila = $stm->fetchObject();

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
        'to'      => $fila->usuario . ' ' .$email,
        'subject' => 'Validación de reinicio de contraseña',
        //'text'    => 'Mensaje desde Cloud9'));
        'text'    => "Hola $fila->usuario!
                    Recientemente se ha enviado una solicitud de reinicio de tu contraseña para nuestra área de miembros. 
                    Si no solicitaste esto, por favor ignora este correo.
                    Para reiniciar tu contraseña, por favor visita la url a continuación:
                    https://app-tracking-mongodb-nohtrim.c9.io/model/recuperarpassword.php?activation=".$fila->activacion_key."&email=".$email.""));
   
    ob_start();
		header('refresh: 3; ../');
		echo "Se te ha enviado un correo a email indicado.";
	ob_end_flush();
} else {
    echo "<br>No hay ningún usuario con ese email";
}
<?php
require '../vendor/autoload.php';
use Mailgun\Mailgun;
session_start();
//include("../model/model.php");
//provisional
//$_SESSION['id_usuario']=1;
//echo "pruebas";
    
if (isset($_POST['crearPosicion'])){
    include_once("../model/model.php");
    session_start();
    //provisional
    $id_usuario = $_SESSION['id_usuario'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $titulo = $_POST['titulo'];
    Model::insertarPosicion($id_usuario, $titulo, $latitud, $longitud );
    header('Location: ../');
}

if (isset($_POST['borrar'])){
    include_once("../model/model.php");
    $id_usuario = $_SESSION['id_usuario'];
    $id_posicion = $_POST['id_posicion'];
    Model::borrarPosicion($id_usuario, $id_posicion);
    header('Location: ../');
}
if(isset($_POST['editar'])){
    include_once("../model/model.php");
    $titulo = $_POST['titulo'];
    $id_posicion = $_POST['id_posicion'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    //echo "$id_posicion, $latitud, $longitud, $titulo";
    Model::editarPosicion($id_posicion, $titulo, $latitud, $longitud); 
    header('Location: ../');
}

if (isset($_POST['login'])){
    include_once("../model/model.php");
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];
    $latitud = $_GET['latitud'];
    $longitud = $_GET['longitud'];
    //configurando para insertar titulo
    //$titulo = $_GET['titulo'];
    Model::buscarUsuario($usuario, $pass, $latitud, $longitud);
    header('Location: ../');
}

if (isset($_POST['register'])){
    include_once("../model/model.php");
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];
    if($pass == $pass2){
        
        # Include the Autoloader (see "Libraries" for install instructions)
        //use Mailgun\Mailgun;

        function generate_random_key() {
              $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
              $new_key = "";
              for ($i = 0; $i < 32; $i++) {
                  $new_key .= $chars[rand(0,35)];
              }
              return $new_key;
        }

        $random_key = generate_random_key();
        $validated = 0;
        
        Model::registrarUsuario($usuario, $pass, $email, $random_key, $validated);
        
        # Instantiate the client.
        $mgClient = new Mailgun('key-116da3f3cd011ad01d454a632a599587');
        $domain = "sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org";
        
        # Make the call to the client.
        $result = $mgClient->sendMessage("$domain",
        array('from'    => 'App-Tracking DW32-IGSR <postmaster@sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org>',
            //'to'      => 'IGSR <dw32igsr@gmail.com>',
            'to'      => $usuario . ' ' .$email,
            'subject' => 'Registro en App-Tracking',
            //'text'    => 'Mensaje desde Cloud9'));
            'text'    => "Hola $usuario!
                        Gracias por registrarse en nuestro sitio.
                        Su cuenta ha sido creada, y debe ser activada antes de poder ser utilizada.
                        Para activar la cuenta, haga click en el siguiente enlace o copielo en la
                        barra de direcciones del navegador:
                        https://app-tracking-mongodb-nohtrim.c9.io/model/activate.php?activation=".$random_key."&email=".$email.""));
                
        header('Location: ../');
        //echo "registro completado";
    }
}
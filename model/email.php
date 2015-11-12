<?php
use Mailgun\Mailgun;

class Email {

    public function generate_random_key() {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $new_key = "";
        for ($i = 0; $i < 32; $i++) {
            $new_key .= $chars[rand(0,35)];
        }
        return $new_key;
    }
     
    public function registrar($usuario, $email, $random_key) {
        //$random_key = generate_random_key();
        //$validated = 0;
        
        //Model::registrarUsuario($usuario, $pass, $email, $random_key, $validated);
        
        # Instantiate the client.
        $mgClient = new Mailgun('key-116da3f3cd011ad01d454a632a599587');
        $domain = "sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org";
        
        $mensaje="<h1>Hola $usuario!</h1>
                    <p>Gracias por registrarse en nuestro sitio.
                    Su cuenta ha sido creada, y debe ser activada antes de poder ser utilizada.
                    Para activar la cuenta, haga click en el siguiente enlace o copielo en la
                    barra de direcciones del navegador:</p>
                    <a href=' https://app-tracking-mongodb-nohtrim.c9.io/model/activate.php?activation=$random_key&email=$email'>Activar cuenta</a>
                ";
        
        # Make the call to the client.
        $result = $mgClient->sendMessage("$domain",
        array('from'    => 'App-Tracking DW32-IGSR <postmaster@sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org>',
            //'to'      => 'IGSR <dw32igsr@gmail.com>',
            'to'      => $usuario . ' ' .$email,
            'subject' => 'Registro en App-Tracking',
            //'text'    => 'Mensaje desde Cloud9'));
            'html'    => $mensaje));
                
        header('Location: ../');
    }
    
    public function reinicioPassword($usuario, $email, $random_key) {
        $mgClient = new Mailgun('key-116da3f3cd011ad01d454a632a599587');
        $domain = "sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org";
        
        $mensaje="<h1>Hola $usuario!</h1>
                    <p>Recientemente se ha enviado una solicitud de reinicio de tu contraseña para nuestra área de miembros. 
                    Si no solicitaste esto, por favor ignora este correo.
                    Para reiniciar tu contraseña, por favor visita la url a continuación:</p>
                    <a href=' https://app-tracking-mongodb-nohtrim.c9.io/model/recuperarpassword.php?activation=$random_key&email=$email'>Restablecer contraseña</a>
                ";
        
        # Make the call to the client.
        $result = $mgClient->sendMessage("$domain",
        array('from'    => 'App-Tracking DW32-IGSR <postmaster@sandboxe7f47692877a4fd6b2115e79c3ce660d.mailgun.org>',
            //'to'      => 'IGSR <dw32igsr@gmail.com>',
            'to'      => $usuario . ' ' .$email,
            'subject' => 'Validación de reinicio de contraseña',
            //'text'    => 'Mensaje desde Cloud9'));
            'html'    => $mensaje));
       
        ob_start();
    		header('refresh: 3; ../');
    		echo "Se te ha enviado un correo a email indicado.";
    	ob_end_flush();
    }
}
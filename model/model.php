<?php
include("posicion.class.php");
include("usuario.class.php");
session_start();
class Model {
    private $posicion;
    private $datos;
    private $latitud;
    private $longitud;
    
    private $nombre;
    private $pass;
    private $usuario;
    
    /*public function __construct() {
        //$this->string = "MVC + PHP = Awesome!";
        //$this->posicion=$this->buscar_posiciones();
    }*/
    
    public function insertarPosicion($id_usuario, $titulo, $latitud, $longitud) {
        //echo "insercion de posicion en marcha";
        //echo "  id $id_usuario titulo $titulo latitud $latitud longitud $longitud";
        require_once("conexion.class.php");
        $m = conexion::conectar();
        $db = $m->selectDB('app_tracking');
        $collection = $db->posiciones;
        //----
        $document=array("id_usuario" => "$id_usuario", "titulo" => "$titulo", "latitud" => "$latitud", "longitud" => "$longitud", "hora" => date("Y-m-d H:i:s"));
        $collection->insert($document);
    }
    
    public function borrarPosicion($id_usuario, $id_posicion) {
        if ($_POST['borrar']){
            require_once("conexion.class.php");
            $db = Conexion::conectar();
        	$stmt = $db->prepare('DELETE FROM posicion WHERE id_posicion=:id_posicion AND id_usuario=:id_usuario');
        	$stmt->bindParam(':id_posicion', $id_posicion, PDO::PARAM_INT);
        	$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
    
    public function editarPosicion($id_posicion, $titulo, $latitud, $longitud ) {
        if ($_POST['editar']){
            require_once("conexion.class.php");
            $db = Conexion::conectar();
            //echo "</br>$id_posicion, $latitud, $longitud, $titulo";
            try {	
            	$stmt = $db->prepare('UPDATE posicion SET titulo=:titulo, latitud=:latitud, longitud=:longitud WHERE id_posicion=:id_posicion');
            	//$stmt = $db->prepare('UPDATE posicion SET titulo=?, latitud=?, longitud=? WHERE id_posicion=?');
            	//$stmt->execute(array($titulo,$latitud,$longitud,$id_posicion));
            	$stmt->bindParam(':titulo', $titulo);
            	$stmt->bindParam(':latitud', $latitud);
            	$stmt->bindParam(':longitud', $longitud);
            	$stmt->bindParam(':id_posicion', $id_posicion);
            	//$stmt->bindParam(':id_usuario', $id_usuario);
                $stmt->execute();
                //var_dump($stmt);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }	
        }
    }
    
    public function buscar_posiciones(){
        //echo "prueba  700 ".$_SESSION['id_usuario'];
        require_once("conexion.class.php");
        $db = Conexion::conectar();
    	$stmt = $db->prepare("SELECT id_posicion, latitud, longitud, hora, titulo FROM posicion WHERE id_usuario=:id_usuario");
        //$stmt->bindParam(":id_usuario", $_SESSION['id_usuario'], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $_SESSION['id_usuario'], PDO::PARAM_INT);
        $stmt->execute();
        //$respuesta="\n";
        //$_SESSION['id_usuario']=1;
        $marcadores = array();
        foreach ($stmt->fetchAll() as $row) {
            array_push($marcadores, new Posicion($row['id_posicion'],$row['latitud'],$row['longitud'],$row['hora'],$_SESSION['id_usuario'],$row['titulo']));
        }
        return $marcadores;
    }
    
    public function buscarUsuario($usuario, $pass, $latitud, $longitud) {
        //echo "prueba 500 ".$_SESSION['id_usuario'];
        require_once("conexion.class.php");
        $m = conexion::conectar();
        $db = $m->selectDB('app_tracking');
        $collection = $db->usuarios;
        
        //$sweetQuery = array('Details.Taste' => 'Sweet');
        $mongo_usuario=array("usuario" => "$usuario", "pass" => "$pass");
        //$mongo_usuario=array('usuario' => "$usuario", 'pass' => "$pass");
        $cursor = $collection->find($mongo_usuario);
        //$respuesta="";
        
        //---
        //$cursor = $collection->find();
        //var_dump(iterator_to_array($cursor));
        //---
        /*
        foreach ( $cursor as $id => $value )
        {
            echo "$id: ";
            var_dump( $value );
        }
        */
        
        foreach ( $cursor as $id => $value ) {
            if ($value['validated'] == 1) {
                //echo "mostrar los datos del cursor <br/><br/>";
                //var_dump( $value );
                
                $usuario=new Usuario($value['_id'],$value["usuario"],$value["pass"]);
                //echo "<p>".$usuario->mostrar()."</p>";
                $_SESSION['id_usuario']=$value["_id"];
                //echo "<p>valor de session id_usuario<p>".$_SESSION['id_usuario'];
                $titulo=date("Y-m-d H:i:s");
                
                Model::insertarPosicion($value['_id'], $titulo, $latitud, $longitud);
            } else {
                echo "No estas activado";
            }
        }
    }
    
    public function registrarUsuario($usuario, $pass, $email, $random_key, $validated){
        require_once("conexion.class.php");
        $m = Conexion::conectar();
        
        $db = $m->selectDB('app_tracking');
        $collection = $db->usuarios;
        $document = array( "usuario" => $usuario, "pass" => md5($pass), "email" => $email, "activacion_key" => $random_key, "validated" => $validated );
        $collection->insert($document);
    }
    /*public function registrarUsuario($usuario, $pass, $email, $random_key, $validated){
        require_once("conexion.class.php");
        $db = Conexion::conectar();
        
        $stmt = $db->prepare("INSERT INTO usuario (usuario, pass, email, activacion_key, validated) VALUES (:usuario, :pass, :email, :activacion_key, :validated)");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":pass", md5($pass), PDO::PARAM_STR);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":activacion_key", $random_key);
        $stmt->bindParam(":validated", $validated);
        $stmt->execute();
    }*/
}
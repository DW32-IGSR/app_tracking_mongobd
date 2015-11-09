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
        require_once("conexion.class.php");
        $m = conexion::conectar();
        $db = $m->selectDB('app_tracking');
        $collection = $db->posiciones;
        $document=array("id_usuario" => "$id_usuario", "titulo" => "$titulo", "latitud" => "$latitud", "longitud" => "$longitud", "hora" => date("Y-m-d H:i:s"));
        $prueba=$collection->insert($document);
        echo $prueba;
        var_dump($prueba);
    }
    
    public function borrarPosicion($id_usuario, $id_posicion) {
        if ($_POST['borrar']){
            require_once("conexion.class.php");
            $m = Conexion::conectar();
            $db = $m->selectDB('app_tracking');
            $collection = $db->posiciones;
            echo "id de la posicon: '$id_posicion'";
            $collection->remove(array('_id' => new MongoId($id_posicion)));
        }
    }
    
    public function editarPosicion($id_posicion, $titulo, $latitud, $longitud ) {
        if ($_POST['editar']){
            require_once("conexion.class.php");
            $m = conexion::conectar();
            $db = $m->selectDB('app_tracking');
            $collection = $db->posiciones;
            var_dump($newdata);
            echo "<br> $id_posicion";
            $collection->update(
                array('_id' => new MongoId($id_posicion)),
                array('$set' => array("titulo" => $titulo, "latitud" => $latitud, "longitud" => $longitud)));
        }
    }
    
    public function buscar_posiciones(){
        require_once("conexion.class.php");
        $m = conexion::conectar();
        $db = $m->selectDB('app_tracking');
        $collection = $db->posiciones;
        $id_usuario_temp=$_SESSION['id_usuario'];
        $mongo_posicion=array('id_usuario' => "$id_usuario_temp");
        $cursor = $collection->find($mongo_posicion);
        $marcadores = array();
        
        foreach ( $cursor as $id => $value ) {
            array_push($marcadores, new Posicion($value['_id'], $_SESSION['id_usuario'], $value['titulo'], $value['latitud'], $value['longitud'], $value['hora']));
        }
        return $marcadores;
    }
    
    public function buscarUsuario($usuario, $pass, $latitud, $longitud) {
        //echo "en busca de usuario -- ";
        require_once("conexion.class.php");
        $m = conexion::conectar();
        $db = $m->selectDB('app_tracking');
        $collection = $db->usuarios;
        $mongo_usuario=array("usuario" => "$usuario", "pass" => md5($pass));
        //var_dump($mongo_usuario);
        $cursor = $collection->find($mongo_usuario);
        //var_dump($cursor);
        foreach ( $cursor as $id => $value ) {
            if ($value['validated']) {
                $usuario=new Usuario($value['_id'],$value["usuario"],$value["pass"]);
                $_SESSION['id_usuario']=$value["_id"];
                $titulo=date("Y-m-d H:i:s");
                Model::insertarPosicion($value['_id'], $titulo, $latitud, $longitud);
                //echo "sesion establecida";
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
}
<?php
//require '../vendor/autoload.php';

session_start();
//include("../model/model.php");
class Controller {
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
    }

    public function mostrar_posiciones() {
    	$this->model->buscar_posiciones();
    }
    
    public function posicionar() {
        if (isset($_POST['crearPosicion'])){
            session_start();
            //provisional
            $id_usuario = $_SESSION['id_usuario'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $titulo = $_POST['titulo'];
            Model::insertarPosicion($id_usuario, $titulo, $latitud, $longitud );
            header('Location: .');
        }
    }
    
    public function login() {
        //echo "hi";
        if (isset($_POST['login'])){
            //echo "dentro de post";
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $lat = $_GET['latitud'];
            $long = $_GET['longitud'];
            //configurando para insertar titulo
            //$titulo = $_GET['titulo'];
            //$this->model->buscarUsuario($usuario, $pass, $lat, $long/*, $titulo*/);
            Model::buscarUsuario($usuario, $pass, $lat, $long);
            //echo "ok";
            header('Location: .');
        }
    }
    
    public function register(){
        if (isset($_POST['register'])){
            $usuario = $_POST['usuario'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            if($pass == $pass2){
                
                include_once("model/email.php");
                $random_key = Email::generate_random_key();
                Email::registrar($usuario, $email, $random_key);
                $validated = 0;
                Model::registrarUsuario($usuario, $pass, $email, $random_key, $validated);
                        
                header('Location: .');
                //echo "registro completado";
            }
        }
    }
    
    public function destructorSesion(){
        //vaciar la sesion
        session_start();
        session_destroy();
        header("location: .");
    }
    
    public function modificarPosicion() {
        if(isset($_POST['editar'])){
            $titulo = $_POST['titulo'];
            $id_posicion = $_POST['id_posicion'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            //echo "$id_posicion, $latitud, $longitud, $titulo";
            Model::editarPosicion($id_posicion, $titulo, $latitud, $longitud); 
            header('Location: .');
        }else if (isset($_POST['borrar'])){
            $id_usuario = $_SESSION['id_usuario'];
            $id_posicion = $_POST['id_posicion'];
            Model::borrarPosicion($id_usuario, $id_posicion);
            header('Location: .');
        }  
    }
    
    public function editar(){
        if(isset($_POST['editar'])){
            $titulo = $_POST['titulo'];
            $id_posicion = $_POST['id_posicion'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            //echo "$id_posicion, $latitud, $longitud, $titulo";
            Model::editarPosicion($id_posicion, $titulo, $latitud, $longitud); 
            header('Location: .');
        }
    }
    
    public function borrar(){
        if (isset($_POST['borrar'])){
            $id_usuario = $_SESSION['id_usuario'];
            $id_posicion = $_POST['id_posicion'];
            Model::borrarPosicion($id_usuario, $id_posicion);
            header('Location: .');
        }        
    }
}
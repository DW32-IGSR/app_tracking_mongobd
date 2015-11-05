<?php
class Usuario {
    private $id_usuario;
    private $usuario;
    private $pass;
    
    public function __construct($id_usuario, $usuario, $pass) {
        $this->id_usuario = $id_usuario;
        $this->usuario = $usuario;
        $this->pass = $pass;
    }
    
    public function mostrar() {
    	return "Id_Usuario: ".$this->id_usuario." Usuario: ".$this->usuario;
    }
    public function getIdUsu(){
        return $this->id_usuario;
    }
}
<?php
class Usuario {
    private $id_usuario;
    private $nombre;
    private $pass;
    
    public function __construct($id_usuario, $nombre, $pass) {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->pass = $pass;
    }
    
    public function mostrar() {
    	return "Id_Usuario: ".$this->id_usuario." Nombre: ".$this->nombre;
    }
    public function getIdUsu(){
        return $this->id_usuario;
    }
}
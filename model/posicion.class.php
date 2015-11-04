<?php
class Posicion {
    //poner private y hacer los geter
    private $latitud;
    private $longitud;
    private $hora;
    private $id_usuario;
    private $id_posicion;
    private $titulo;
    
    public function __construct($id_posicion, $latitud, $longitud, $hora, $id_usuario, $titulo) {
        $this->id_posicion = $id_posicion;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->hora = $hora;
        $this->id_usuario = $id_usuario;
        $this->titulo = $titulo;
        //$this->model->insertarPosicion($latitud, $longitud, $hora, $id_usuario);
    }
    
    public function getLatitud(){
        return $this->latitud;
    }
    public function getLongitud(){
        return $this->longitud;
    }
    public function getHora(){
        return $this->hora;
    }
    public function getId_usuario(){
        return $this->id_usuario;
    }    
    public function getId_posicion(){
        return $this->id_posicion;
    }
    public function getTitulo(){
        return $this->titulo;
    }
}
<?php
class Posicion {
    private $latitud;
    private $longitud;
    private $hora;
    private $id_usuario;
    //private $marca;
    
    public function __construct($latitud, $longitud, $hora, $id_usuario) {
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->hora = $hora;
        $this->id_usuario = $id_usuario;
        //$this->marca = $marca;
        //$this->model->insertarPosicion($latitud, $longitud, $hora, $id_usuario);
    }
    public function mostrar() {
    	return "Posicion: latitud: ".$this->latitud." longitud: ".$this->longitud." hora: ".$this->hora." usuario: ".$this->id_usuario;
    }
}
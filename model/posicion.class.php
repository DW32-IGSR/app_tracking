<?php
class Posicion {
    private $latitud;
    private $longitud;
    private $hora;
    private $id_usuario;
    
    public function __construct($latitud, $longitud, $hora, $id_usuario) {
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->hora = $hora;
        $this->id_usuario = $id_usuario;
        //$this->model->insertarPosicion($latitud, $longitud, $hora, $id_usuario);
    }
    public function mostrar() {
    	return "Posicion: latitud: ".$this->latitud." longitud: ".$this->longitud." hora: ".$this->hora." usuario: ".$this->id_usuario;
    }
    
    //cambiando de forma y de archivo
    public function buscar(){
        
    }
    
}
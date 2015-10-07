<?php
class Posicion {
    private $latitud;
    private $longitud;
    private $hora;
    
    public function __construct($latitud, $longitud, $hora) {
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->hora = $hora;
    }
    public function mostrar() {
    	$this->model->string = "Posicion: latitud: ".$latitud." longitud: ".$longitud." hora: ".$hora;
    }
}
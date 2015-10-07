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
    	return "Posicion: latitud: ".$this->latitud." longitud: ".$this->longitud." hora: ".$this->hora;
    }
}
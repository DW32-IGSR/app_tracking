<?php
include("posicion.class.php");
class Model {
    public $string;
    public $posicion;
    public $datos;
    
    public function __construct() {
        //$this->string = "MVC + PHP = Awesome!";
        $this->posicion=new Posicion(40,40,"12:00");
    }
}
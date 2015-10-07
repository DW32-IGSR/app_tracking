<?php
class View
{
    private $model;
    private $controller;
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
	
    public function output(){
        //return '<p><a href="ejemplo.php?action=clicked">' . $this->model->string . "</a></p>";
        
        //prueba de crear una pagina
        $head="<html><head>";
        $head.="</head>";
        $body="<body>";
        $body.="<p>texto de prueba</p>";
        //correccion para la clase
        //$posicion->new Posicion(40,40,12:00);
        $body.="";
        $body.="";
        $body.="</body>";
        $respuesta=$head.$body;
        return $respuesta;
    }
}
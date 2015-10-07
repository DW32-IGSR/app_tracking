<?php
class View {
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
        $body.="<a href='index.php?action=mostrar'>mostrar</a>";
        //correccion para la clase
        //$posicion->new Posicion(40,40,12:00);
        $body.="<p>".$this->model->posicion->mostrar()."</p>";
        $body.="";
        $body.="";
        $body.="</body>";
        $respuesta=$head.$body;
        return $respuesta;
    }
    
    public function formulario() {
        echo "<form action='../controller/controller.php?task=formulario' method='POST' name='formulario'>
        Usuario: <input type='text' name='usuario'> <br>
        Latitud: <input type='number' name='latitud'> <br>
        Longitud: <input type='number' name='longitud'> <br>
        Hora: <input type='time' name='hora'> <br>
        <input type='submit' value='Enviar'>
        </form>";
    }
}
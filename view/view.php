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
        //correccion primera carga
        //$body.="<p>".$this->model->mostrar()."</p>";
        $body.=$this->model->buscar_posiciones();
        $body.="";
        $body.="";
        $body.="<a href='index.php?action=crear'>insertar</a>";
        $body.="</body>";
        $respuesta=$head.$body;
        return $respuesta;
    }
    
    public function formulario() {
        echo "<form action='index.php?action=formulario' method='POST' name='formulario'>
        Usuario: <input type='text' name='usuario'> <br>
        Latitud: <input type='number' name='latitud'> <br>
        Longitud: <input type='number' name='longitud'> <br>
        <input type='submit' value='Enviar'>
        </form>";
    }
}
<?php
class Controller
{
    private $model;
    public function __construct($model) {
        $this->model = $model;
    }
    public function clicked() {
    	$this->model->string = "Updated Data, thanks to MVC and PHP!";
    }
    
    public function formulario() {
        $usuario = $_POST['usuario'];
        $latitud = $_POST['latitud'];
        $longitud = $_POST['longitud'];
    }
}
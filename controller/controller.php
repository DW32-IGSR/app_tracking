<?php
class Controller {
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
    }
    
    /*public function clicked() {
    	$this->model->string = "Updated Data, thanks to MVC and PHP!";
    }*/
    
    public function mostrar_posiciones() {
    	$this->model->buscar_posiciones();
    }
    
    public function formulario() {
        if ($_POST['crear']){
            //$usuario = $_POST['usuario'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $this->model->insertarPosicion($latitud,$longitud);
        }

    }
    
    public function login() {
        if ($_POST['login']){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            //$this->model->insertarPosicion($latitud,$longitud);
            $this->model->buscarUsuario($usuario, $pass);
        }
    }
    
    public function register(){
        if ($_POST['register']){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            if($pass == $pass2){
                $this->model->registrarUsuario($usuario, $pass);
            }
        }
    }
}
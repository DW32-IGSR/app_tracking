<?php
class Controller {
    private $model;
    
    public function __construct($model) {
        $this->model = $model;
    }

    public function mostrar_posiciones() {
    	$this->model->buscar_posiciones();
    }
    
    public function posicionar() {
        if ($_POST['crearPosicion']){
            session_start();
            $id_usuario = $_SESSION['id_usuario'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $this->model->insertarPosicion($id_usuario,$latitud,$longitud);
        }
    }
    
    public function login() {
        if ($_POST['login']){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $lat = $_GET['lat'];
            $long = $_GET['long'];
            $this->model->buscarUsuario($usuario, $pass, $lat, $long);
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
    
    public function destructorSesion(){
        //vaciar la sesion
        session_start();
        session_destroy();
        header("location:index.php");
    }
    
    //funcion para guardar la posicion desde un boton
    /*public function marcarMiPosicion(){
        $latitud;
        $longitud;
        insertarPosicion($_SESSION['id_usuario'],$latitud,$longitud);
        header("location:index.php");
    }*/
    
    public function borrarPosicion() {
        if ($_POST['borrar']){
            $id_usuario = $_SESSION['id_usuario'];
            $id_posicion = $_POST['id_posicion'];
            $this->model->borrarPosicion($id_usuario, $id_posicion);
        }else if($_POST['editar']){
            //$id_usuario = $_SESSION['id_usuario'];
            //$id_posicion = $_POST['id_pos'];
            //$latitud = $_POST['latitud'];
            //$longitud = $_POST['longitud'];
            //$this->model->editarPosicion($id_posicion, $id_usuario,$latitud,$longitud);  
        }
    }
}
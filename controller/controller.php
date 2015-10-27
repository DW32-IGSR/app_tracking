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
            $titulo = $_POST['titulo'];
            $this->model->insertarPosicion($id_usuario,$latitud,$longitud, $titulo);
        }
    }
    
    public function login() {
        if ($_POST['login']){
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $lat = $_GET['lat'];
            $long = $_GET['long'];
            //configurando para insertar titulo
            //$titulo = $_GET['titulo'];
            $this->model->buscarUsuario($usuario, $pass, $lat, $long/*, $titulo*/);
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
    
    public function modificarPosicion() {
        if ($_POST['borrar']){
            $id_usuario = $_SESSION['id_usuario'];
            $id_posicion = $_POST['id_posicion'];
            $this->model->borrarPosicion($id_usuario, $id_posicion);
        }else if($_POST['editar']){
            $titulo = $_POST['titulo'];
            $id_posicion = $_POST['id_posicion'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            //echo "$id_posicion, $latitud, $longitud, $titulo";
            $this->model->editarPosicion($id_posicion, $latitud, $longitud, $titulo); 
        }
    }
}
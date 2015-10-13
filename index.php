<?php
    require 'vendor/autoload.php';
    include_once("model/model.php");
    include_once("controller/controller.php");
    include_once("view/view.php");
    
    $model = new Model();
    $controller = new Controller($model);
    $view = new View($controller, $model);
    
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $controller->{$_GET['action']}();
    }
    echo $view->abrirhtml();
    echo $view->reloj();
    session_start();
    if (isset($_SESSION['id_usuario'])){
        echo $view->mapa();
        echo $view->cerrarSesion();
        echo $view->output();
        echo $view->formulario();        
    } else {
        echo $view->login();
        echo $view->register();        
    }
    //echo $view->datosUsuario();
    echo $view->cerrarhtml();
    
    //echo date("Y-m-d H:i:s");
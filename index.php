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
    echo $view->abrirHtml();
    //echo $view->scripter();
    echo $view->abrirBody();
    echo $view->reloj();
    session_start();
    if (isset($_SESSION['id_usuario'])){
        echo $view->navbar();
        //echo $view->cerrarSesion();        
        echo $view->mapa();
        echo $view->output();
        echo $view->scripterMapa();
        echo $view->posicionManual();        
    } else {
        echo $view->login();
        echo $view->register();        
    }
    //echo $view->datosUsuario();
    echo $view->cerrarhtml();
    
    //echo date("Y-m-d H:i:s");
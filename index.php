<?php
    include_once("model/model.php");
    include_once("controller/controller.php");
    include_once("view/view.php");
    
    $model = new Model();
    $controller = new Controller($model);
    $view = new View($controller, $model);
    
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $controller->{$_GET['action']}();
    }
    echo $view->output();
    echo $view->formApp();
    //prueba 2
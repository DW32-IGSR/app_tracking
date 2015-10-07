<?php
    include_once("model/model0.php");
    include_once("controller/controller0.php");
    include_once("view/view0.php");
    
    $model = new Model();
    $controller = new Controller($model);
    $view = new View($controller, $model);
    
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $controller->{$_GET['action']}();
    }
    echo $view->output();
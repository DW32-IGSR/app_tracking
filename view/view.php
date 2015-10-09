<?php
class View {
    private $model;
    private $controller;
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
	
	public function abrirHtml(){
	    $abrir="<html><head>";
	    $abrir.="<meta charset='UTF-8' />";
        $abrir.="</head>";
        $abrir.="<body onload='mueveReloj()'>";
        return $abrir;
	}
	
	public function cerrarHtml(){
        $cerrar="</body>";
        $cerrar.="</html>";
        return $cerrar;
	}
	
    public function output(){
        //return '<p><a href="ejemplo.php?action=clicked">' . $this->model->string . "</a></p>";
        //$body.="<p>".$this->model->mostrar()."</p>";
        $respuesta.=$this->model->buscar_posiciones();
        return $respuesta;
    }
    
    public function formulario() {
        $respuesta = "<form action='index.php?action=formulario' method='POST' name='formulario'>
        Usuario: <input type='text' name='usuario'> <br>
        Latitud: <input type='number' name='latitud'> <br>
        Longitud: <input type='number' name='longitud'> <br>
        <input type='submit' name='crear' value='Enviar'>
        </form>";
        return $respuesta;
    }
    
    public function login() {
        $respuesta = "<form action='index.php?action=login' method='POST' name='formulario_login'>
        Usuario: <input type='text' name='usuario'> <br>
        Contraseña: <input type='password' name='pass'> <br>
        <input type='submit' name='login' value='Entrar'>
        </form>";
        return $respuesta;
    }
    
    public function reloj(){
        $script='<script>function mueveReloj(){
                    momentoActual = new Date();
                    hora = momentoActual.getHours();
                    minuto = (momentoActual.getMinutes()<10)?"0"+momentoActual.getMinutes():momentoActual.getMinutes();
                    segundo = (momentoActual.getSeconds()<10)?"0"+momentoActual.getSeconds():momentoActual.getSeconds();
                
                    horaImprimible = hora + " : " + minuto + " : " + segundo;
                
                    document.form_reloj.reloj.value = horaImprimible;
                
                    setTimeout("mueveReloj()",1000);
                }</script> ';
        $reloj='<form name="form_reloj" align="center">
                <input type="text" name="reloj" size="10">
                </form>';
        $respuesta=$reloj.$script;
        return $respuesta;
    }
    
}
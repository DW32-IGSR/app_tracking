<?php
class View {
    private $model;
    //private $usuario;    
    private $controller;
    private $x=43.327656;
	private $y=-1.970592;
	private $map;
	
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
	
	public function abrirHtml(){
	    $abrir="<html><head>";
	    $abrir.="<meta charset='UTF-8' />";
	    $abrir.=$this->scripter();
        $abrir.="</head>";
        $abrir.="<body onload='mueveReloj()'>";
        return $abrir;
	}
	
	public function scripter(){

	    $scripter="<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyApO7P8vAubMM9T97jMJ2YDpAJuEeJ99yg&callback=initialize'
        async defer></script>";
        $scripter.="<script>function initialize() {
                        var mapProp = {
                        center:new google.maps.LatLng($this->x,$this->y),
                        zoom:16,
                        mapTypeId:google.maps.MapTypeId.ROADMAP
                        //$(#map).css(width)=screen.width;
                      };
                      mapa=new google.maps.Map(document.getElementById('map'),mapProp);
                      colorin='azul';
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng($this->x,$this->y),
                            map: mapa,
                            title: 'app-tracking'
                        });
                    }
                    google.maps.event.addDomListener(window, 'load', initialize);
                    </script>";
        //$scripter.=$this->marcarPosicion();
        //echo "prueba 123 $map.";
	    return $scripter;
	}
	
	function marcarPosicion($x,$y){
	    $posicion=
	            "<script>
	                document.write(colorin);
	                var marker = new google.maps.Marker({
                            position: new google.maps.LatLng($x,$y),
                            //mapa siendo una variable global
                            map: mapa,
                            title: 'prueba 123'
                    });
	           </script>";
	    return $posicion;
	}
	
	public function mapa(){
	    return "<div id='map' style='width:100%;height:550px;'></div>";
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
    
    public function register() {
        $respuesta = "<form action='index.php?action=register' method='POST' name='formulario_register'>
        Usuario: <input type='text' name='usuario'> <br>
        Contraseña: <input type='password' name='pass'> <br>
        Repita la contraseña <input type='password' name='pass2'> <br>
        <input type='submit' name='register' value='Registrar'>
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
                }
                </script> ';
        $reloj='<form name="form_reloj" align="center">
                <input type="text" name="reloj" size="10">
                </form>';
        $respuesta=$reloj.$script;
        return $respuesta;
    } 
    
    /*public function datosUsuario(){
        echo "joder ";
        require_once("model/usuario.class.php");
        //$this->usuario->mostrar();
        $id_usu=Usuario::getIdUsu();
        echo $id_usu;
        //$id_usu=Usuario::id_usuario;
        if(isset($id_usu)){
            //$datos=Usuario::mostrar();
            echo "1234";
            echo "<br/>";
        } else {
            echo "<div>".$this->login()."</div>";
            echo "5637";
            echo "<br/>";
        }    
        return $datos;
    }*/
    
    public function cerrarSesion(){
        //boton de cerrar sesion
        return '<a href="index.php?action=destructorSesion">Cerrar Sesión </a>';
        //return '<input type="button" onclick="location.href="index.php?action=destructorSesion;" value="Cerrar Sesión" />';
    }
}
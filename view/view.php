<?php
class View {
    private $model;
    //private $usuario;    
    private $controller;
	
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
	
	public function abrirHtml(){
	    $abrir="<html>\n<head>\n";
	    $abrir.="<meta charset='UTF-8' />\n";
        //$abrir.="</head>\n";
        $abrir.=$this->scripts();
        return $abrir;
	}
	
	public function abrirBody(){
	    $abrir.="</head>\n";
	    $abrir="<body onload='mueveReloj()'>\n";
        return $abrir;
	}
	
	public function scripts(){
	    $scripts = "<script>var marcadores=[];
        </script>";
	    return $scripts;
	}
	
	public function scripterMapa(){

	    $scripter="<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyApO7P8vAubMM9T97jMJ2YDpAJuEeJ99yg&callback=initialize' async defer></script>\n";
        $scripter.="<script>
        mapa='mapas';
        colorin='azul';
        function initialize() {
            var mapProp = {
                center:new google.maps.LatLng(marcadores[(marcadores.length-1)][1],marcadores[(marcadores.length-1)][2]),
                zoom:16,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
          mapa=new google.maps.Map(document.getElementById('map'),mapProp);
        //}
        //probando array
            //alert(marcadores.length);
            for (i = 0; i < marcadores.length; i++) {  
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
                    map: mapa,
                    title: marcadores[i][0]
                }); //probando array
            }
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        
        </script>\n";
        //$scripter.="</head>\n";
	    return $scripter;
	}
	
	static function marcarPosicion($x,$y){
	//function marcarPosicion($title,$x,$y){
	    $posicion=
	            "<script>
                //añadir un titulo en el array y en la base de datos 
                //marcadores.push([$title,$x,$y]); 
                marcadores.push(['prueba',$x,$y]);    
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
    
    public function posicionManual() {
        $respuesta = "<form action='index.php?action=posicionar' method='POST' name='posicionar'>
        Latitud: <input type='text' name='latitud'> <br>
        Longitud: <input type='text' name='longitud'> <br>
        <input type='submit' name='crearPosicion' value='Enviar'>
        </form>";
        return $respuesta;
    }
    
    public function login() {
        $respuesta = "
<script type='text/javascript'>
    if (typeof navigator.geolocation == 'object'){
        navigator.geolocation.getCurrentPosition(mostrar_ubicacion);
    }
    function mostrar_ubicacion(p){
        var latti = p.coords.latitude;
        var longi = p.coords.longitude;
        //alert(latti+' , '+longi);
        document.getElementById('formulario').action='index.php?action=login&lat='+latti+'&long='+longi;
    }
</script>
        <!--<form action='index.php?action=login' method='POST' name='formulario_login'>-->
        <form id='formulario' action='' method='POST' name='formulario_login'>
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
        $reloj="<form name='form_reloj' align='center'>
                <input disabled type='text' name='reloj' size='10'>
                </form>\n";
        $respuesta=$reloj.$script;
        return $respuesta;
    } 
    
    public function cerrarSesion(){
        //boton de cerrar sesion
        return '<a href="index.php?action=destructorSesion">Cerrar Sesión </a>';
        //return '<input type="button" onclick="location.href="controller.php?action=destructorSesion;" value="Cerrar Sesión" />';
    }
    public function enviarPosicion(){
       $script='<script type="text/javascript">
        if (typeof navigator.geolocation == "object"){
            navigator.geolocation.getCurrentPosition(mostrar_ubicacion);
        }
        function mostrar_ubicacion(p){
           // document.getElementById("TE").innerHTML = ("posición: "+p.coords.latitude+","+p.coords.longitude );
            var latti = p.coords.latitude;
            var longgii = p.coords.longitude;
            document.getElementById("latitud").value = latti;
            document.getElementById("longitud").value = longgii;
        }
        </script>';
        return $script;
    }  
}
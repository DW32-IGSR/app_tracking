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
	    $abrir.="<link href='css/bootstrap.min.css' rel='stylesheet'>";
	    $abrir.="<link href='css/bootstrap-theme.min.css' rel='stylesheet'>";
	    $abrir.="<link href='css/mystyles.css' rel='stylesheet'>";
	    $abrir.='<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>';
	    $abrir.='<script src="js/bootstrap.min.js"></script>';
        //$abrir.="</head>\n";
        $abrir.=$this->scripts();
        return $abrir;
	}
	
	public function abrirBody(){
	    $abrir="</head>\n";
	    $abrir.="<body  onload='mueveReloj()'>\n";
        return $abrir;
	}
	public function navbar(){
	    $navbar='<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">APP-TRACKING</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#"></span>Home</a></li>

                    <!--<li><a href="#">About</a></li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Autores<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Rubén Álvarez</a></li>
                            <li><a href="#">Gorka Pérez</a></li>
                            <li><a href="#">Iosu Recalde</a></li>
                            <li><a href="#">Sergio Varela</a></li>
                            <!--<li role="separator" class="divider"></li>
                            <li class="dropdown-header">Specials</li>
                            <li><a href="#">Lunch Buffet</a></li>
                            <li><a href="#">Weekend Brunch</a></li>-->
                        </ul>
                    </li>
                    <!--<li><a href="#">Contact</a></li>-->
                </ul>
                <ul class="nav navbar-nav navbar-center">
                    <li>
                        <a id="reloj">Cargando reloj</a>
                    </li> 
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php?action=destructorSesion">Cerrar sesión</a></li>
                </ul>                
            </div>    
        </div>

    </nav>';
	    return $navbar;
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
            //alert(marcadores);
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
	
	//static function marcarPosicion($x,$y){
	static function marcarPosicion($title,$x,$y){
	    $posicion=
	            "<script>
                //añadir un titulo en el array y en la base de datos 
                marcadores.push(['$title',$x,$y]); 
                //marcadores.push(['prueba',$x,$y]);    
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
        $respuesta.="<table class='table table-striped'>
        <tr>
            <th>Id</th><th>Nombre</th><th>Latitud</th><th>Longitud</th><th>Fecha</th><th>Usuario</th><td></td>
        </tr>";
        $respuesta.=$this->model->buscar_posiciones();
        $respuesta.="       
        <tr>
            <th>Id</th><th>Nombre</th><th>Latitud</th><th>Longitud</th><th>Fecha</th><th>Usuario</th><td></td>
        </tr>";
        $respuesta.="</table>";        
        return $respuesta;
    }
    
    public function posicionManual() {
        $respuesta = "<br><form action='index.php?action=posicionar' method='POST' name='posicionar'>
        <table>
            <tr>
                <td> Título: </td> <td> <input type='text' name='titulo'> </td>
            </tr>
            <tr>
                <td> Latitud: </td> <td> <input type='text' name='latitud'> </td>
            </tr>
            <tr>
                <td> Longitud: </td> <td> <input type='text' name='longitud'> </td>
            </tr>
        </table>
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
        //var titulo = 'prueba32';
        //alert(latti+' , '+longi);
        //document.getElementById('formulario').action='index.php?action=login&titulo='+titulo+'&lat='+latti+'&long='+longi;
        document.getElementById('formulario').action='index.php?action=login&lat='+latti+'&long='+longi;
    }
</script>
        <!--<form action='index.php?action=login' method='POST' name='formulario_login'>-->
        <form id='formulario' action='' method='POST' name='formulario_login'>
        <table>
        <tr>
        <td>Usuario: </td><td><input type='text' name='usuario'><td>
        </tr>
        <tr>
        <td>Contraseña: </td><td><input type='password' name='pass'></td> 
        </tr>
        <tr>
        <td><input type='submit' name='login' value='Entrar'></td>
        </tr>
        </table>
        </form>";
        return $respuesta;
    }
    
    public function register() {
        $respuesta = "<form action='index.php?action=register' method='POST' name='formulario_register'>
        <table bgcolor='lightblue'>
        <tr>
        <td>Usuario: </td><td><input type='text' name='usuario'></td>
        </tr>
        <tr>
        <td>Contraseña: </td><td><input type='password' name='pass'><td>
        </tr>
        <tr>
        <td>Repita la contraseña </td><td><input type='password' name='pass2'><td>
        </tr>
        <tr>
        <td><input type='submit' name='register' value='Registrar'></td>
        </tr>
        </table>
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
                
                    document.getElementById("reloj").innerHTML = horaImprimible;
                    
                    setTimeout("mueveReloj()",1000);
                }
                </script> ';
        return $script;
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
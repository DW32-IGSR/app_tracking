<?php
include("posicion.class.php");
include("usuario.class.php");
session_start();
class Model {
    public $posicion;
    public $datos;
    public $latitud;
    public $longitud;
    
    public $nombre;
    public $pass;
    public $usuario;
    
    public function __construct() {
        //$this->string = "MVC + PHP = Awesome!";
        //$this->posicion=$this->buscar_posiciones();
    }
    
    public function insertarPosicion($id_usuario, $latitud, $longitud) {
        require_once("conexion.class.php");
        $db = Conexion::conectar();
    	$stmt = $db->prepare('INSERT INTO posicion (latitud, longitud, hora, id_usuario) VALUES (:latitud,:longitud,:hora,:id_usuario)');
    	//INSERT INTO `posicion`(`latitud`, `longitud`, `id_usuario`, `hora`) VALUES (5465464,4564564645,1, CURRENT_TIMESTAMP)
    	$stmt->bindParam(':latitud', $latitud);
    	$stmt->bindParam(':longitud', $longitud); 
    	$stmt->bindParam(':hora', date("Y-m-d H:i:s"));
    	$stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        $lastid= $db -> lastInsertId();
    }
    
    public function buscar_posiciones(){
        require_once("conexion.class.php");
        $db = Conexion::conectar();
        //$sql="SELECT latitud, longitud, hora FROM posicion WHERE id_usuario=".$this->id_usuario;
        //echo $sql;
    	$stmt = $db->prepare("SELECT latitud, longitud, hora FROM posicion WHERE id_usuario=:id_usuario");
        $stmt->bindParam(":id_usuario", $_SESSION['id_usuario'], PDO::PARAM_INT);
        $stmt->execute();
        $respuesta="\n";
        foreach ($stmt->fetchAll() as $row) {
            //var_dump($row);
            //echo "hola?: ".$row['latitud'];
            $posicion=new Posicion($row['latitud'],$row["longitud"],$row["hora"],$_SESSION['id_usuario']);
            
            //$script=View::marcarPosicion($row['titulo'],$row['latitud'],$row["longitud"]);
            $script=View::marcarPosicion($row['latitud'],$row["longitud"]);
            
            $respuesta.= "<p>".$posicion->mostrar()."</p>\n".$script."\n";
        }
        return $respuesta;
    }
    
    public function buscarUsuario($usuario, $pass) {
        require_once("conexion.class.php");
        $db = Conexion::conectar();
    	$stmt = $db->prepare("SELECT * FROM usuario WHERE usuario=:usuario and pass=:pass");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":pass", md5($pass), PDO::PARAM_STR);
        $stmt->execute();
        $respuesta="";
        foreach ($stmt->fetchAll() as $row) {
            //var_dump($row);
            $usuario=new Usuario($row['id_usuario'],$row["usuario"],$row["pass"]);
            echo "<p>".$usuario->mostrar()."</p>";
            //session_start();
            $_SESSION['id_usuario']=$row["id_usuario"];
            $this->id_usuario=$row['id_usuario'];    
            
            //despues de iniciar se sesion se guarda la posicion en la base de datos
            //insertarPosicion($id_usuario, $latitud, $longitud)
            //falta establecer las variables
            
            //sin verificar
/*function(){
	var content = document.getElementById("geolocation-test");

	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(function(objPosition)
		{
			var lon = objPosition.coords.longitude;
			var lat = objPosition.coords.latitude;

			content.innerHTML = "<p><strong>Latitud:</strong> " + lat + "</p><p><strong>Longitud:</strong> " + lon + "</p>";

		}, function(objPositionError)
		{
			switch (objPositionError.code)
			{
				case objPositionError.PERMISSION_DENIED:
					content.innerHTML = "No se ha permitido el acceso a la posición del usuario.";
				break;
				case objPositionError.POSITION_UNAVAILABLE:
					content.innerHTML = "No se ha podido acceder a la información de su posición.";
				break;
				case objPositionError.TIMEOUT:
					content.innerHTML = "El servicio ha tardado demasiado tiempo en responder.";
				break;
				default:
					content.innerHTML = "Error desconocido.";
			}
		}, {
			maximumAge: 75000,
			timeout: 15000
		});
	}
	else
	{
		content.innerHTML = "Su navegador no soporta la API de geolocalización.";
	}
}*/
            //insertarPosicion($row['id_usuario'],$lat,$lon);
        }
    }
    public function registrarUsuario($usuario, $pass){
        require_once("conexion.class.php");
        $db = Conexion::conectar();
        $stmt = $db->prepare("INSERT INTO usuario (usuario, pass) VALUES (:usuario, :pass)");
        $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        $stmt->bindParam(":pass", md5($pass), PDO::PARAM_STR);
        $stmt->execute();
    }
    
}
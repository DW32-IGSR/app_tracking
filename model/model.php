<?php
include("posicion.class.php");
class Model {
    public $posicion;
    public $datos;
    public $latitud;
    public $longitud;
    private $id_usuario=1;
    
    public function __construct() {
        //$this->string = "MVC + PHP = Awesome!";
        //$this->posicion=$this->buscar_posiciones();
    }
    
    public function insertarPosicion($latitud, $longitud) {
        
        require_once("conexion.class.php");
        $db = Conexion::conectar();
        //falta el id usuario en el insert
    	$stmt = $db->prepare('INSERT INTO posicion (latitud, longitud, hora, id_usuario) VALUES (:latitud,:longitud,:hora,:id_usuario)');
    	//INSERT INTO `posicion`(`latitud`, `longitud`, `id_usuario`, `hora`) VALUES (5465464,4564564645,1, CURRENT_TIMESTAMP)
    	$stmt->bindParam(':latitud', $latitud);
    	$stmt->bindParam(':longitud', $longitud);
    	//$stmt->bindParam(':hora', CURRENT_TIMESTAMP); //error al enviar formulario
    	$stmt->bindParam(':hora', date("Y-m-d h:i:s"));
    	$stmt->bindParam(':id_usuario', $this->id_usuario);
        $stmt->execute();
        $lastid= $db -> lastInsertId();
    }
    
    public function buscar_posiciones(){
        require_once("conexion.class.php");
        $db = Conexion::conectar();
        //$sql="SELECT latitud, longitud, hora FROM posicion WHERE id_usuario=".$this->id_usuario;
        //echo $sql;
    	$stmt = $db->prepare("SELECT latitud, longitud, hora FROM posicion WHERE id_usuario=:id_usuario");
        $stmt->bindValue(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta="";
        foreach ($stmt->fetchAll() as $row) {
            //var_dump($row);
            //echo "hola?: ".$row['latitud'];
            $posicion=new Posicion($row['latitud'],$row["longitud"],$row["hora"],$this->id_usuario);
            $respuesta.= "<p>".$posicion->mostrar()."</p>";
        }
        return $respuesta;
    }
}
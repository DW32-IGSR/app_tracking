<?php
class Posicion {
    private $latitud;
    private $longitud;
    private $hora;
    private $id_usuario;
    private $id_posicion;
    //private $marca;
    
    public function __construct($id_posicion, $latitud, $longitud, $hora, $id_usuario) {
        $this->id_posicion = $id_posicion;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->hora = $hora;
        $this->id_usuario = $id_usuario;
        //$this->marca = $marca;
        //$this->model->insertarPosicion($latitud, $longitud, $hora, $id_usuario);
    }
    public function mostrar() {
       	return "<form action='index.php?action=borrarPosicion' method='POST' name='varias'>Posicion: Id: $this->id_posicion <input hidden name='id_posicion' value=$this->id_posicion /> latitud: <input name='latitud' value=$this->latitud /> longitud: <input name='longitud' value=$this->longitud /> hora: $this->hora usuario: $this->id_usuario <input type='submit' name='editar' value='Editar'><input type='submit' name='borrar' value='Borrar'></form>";
    }
    
    public function formEditarPosicion() {
        if ($_POST['editar']){
            $respuesta = "<form action='#' method='POST' name='formulario'>
                <input type='hidden' name='id_pos'> <br>
                Latitud: <input type='text' name='latitud' value=''> <br>
                Longitud: <input type='text' name='longitud' value=''> <br>
                <input type='submit' name='edit' value='Editar'>
                </form>";
            return $respuesta;
        }
    }
    
    public function valoresFormEditarPosicion() {
        if ($_POST['editar']){
            $id_usuario = $_SESSION['id_usuario'];
            $id_posicion = $_POST['id_pos'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $this->model->editarPosicion($id_posicion, $id_usuario,$latitud,$longitud);
        }
    }
    
    public function editarPosicion($id_posicion, $id_usuario, $latitud, $longitud) {
            require_once("conexion.class.php");
            $db = Conexion::conectar();
        	$stmt = $db->prepare('UPDATE posicion SET latitud=:latitud AND longitud=:longitud WHERE id_posicion=:id_posicion AND id_usuario=:id_usuario');
        	$stmt->bindParam(':id_posicion', $id_posicion);
        	$stmt->bindParam(':id_usuario', $id_usuario);
        	$stmt->bindParam(':latitud', $latitud);
    	    $stmt->bindParam(':longitud', $longitud); 
            $stmt->execute();
    }
}
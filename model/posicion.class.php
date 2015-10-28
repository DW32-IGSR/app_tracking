<?php
class Posicion {
    private $latitud;
    private $longitud;
    private $hora;
    private $id_usuario;
    private $id_posicion;
    private $titulo;
    //private $marca;
    
    public function __construct($id_posicion, $latitud, $longitud, $hora, $id_usuario, $titulo) {
        $this->id_posicion = $id_posicion;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->hora = $hora;
        $this->id_usuario = $id_usuario;
        $this->titulo = $titulo;
        //$this->marca = $marca;
        //$this->model->insertarPosicion($latitud, $longitud, $hora, $id_usuario);
    }
    public function mostrar() {
       	return "<form action='index.php?action=modificarPosicion' method='POST' name='varias'>
       	<td>$this->id_posicion</td> <input hidden name='id_posicion' value=$this->id_posicion />
       	<td><input name='titulo' value='$this->titulo' /></td>
       	<td><input name='latitud' value=$this->latitud /></td>
       	<td><input name='longitud' value=$this->longitud /></td>
       	<td>$this->hora</td>
       	<td>$this->id_usuario</td>
       	<td> 
           	<input type='submit' name='editar' value='Editar'>
           	<input type='submit' name='borrar' value='Borrar'>
       	</td>
       	</form>";
    }
    
    /*public function formEditarPosicion() {
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
    }*/
}
<?php
class Usuario {
    private $id_usuario;
    private $nombre;
    
    public function __construct($id_usuario, $nombre) {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
    }
    public function clicked() {
    	//$this->model->string = "Updated Data, thanks to MVC and PHP!";
    }
}
<?php
 class UsuariosDTO {
    private $Id_Usuario;
    private $Nombre_Completo;
    private $Edad;
    private $Telefono;
    private $Correo;
    private $Contrasena;
    private $Contrasena_Nueva;
    private $Fecha_Modificacion;
    public function getId_Usuario(){
        return $this->Id_Usuario;
    }
    public function setId_Usuario($Id_Usuario){
        $this->Id_Usuario=$Id_Usuario;
    }
    public function getNombre_Completo(){
        return $this->Nombre_Completo;
    }
    public function setNombre_Completo($Nombre_Completo){
        $this->Nombre_Completo=$Nombre_Completo;
    }
    public function getEdad(){
        return $this->Edad;
    }
    public function setEdad($Edad){
        $this->Edad=$Edad;
    }
    public function getTelefono(){
        return $this->Telefono;
    }
    public function setTelefono($Telefono){
        $this->Telefono=$Telefono;
    }
    public function getCorreo(){
        return $this->Correo;
    }
    public function setCorreo($Correo){
        $this->Correo=$Correo;
    }
    public function getContrasena(){
        return $this->Contrasena;
    }
    public function setContrasena($Contrasena){
        $this->Contrasena=$Contrasena;
    }
    public function getContrasena_Nueva(){
        return $this->Contrasena_Nueva;
    }
    public function setContrasena_Nueva($Contrasena_Nueva){
        $this->Contrasena_Nueva=$Contrasena_Nueva;
    }
    public function getFecha_Modificacion(){
        return $this->Fecha_Modificacion;
    }
    public function setFecha_Modificacion($Fecha_Modificacion){
        $this->Fecha_Modificacion=$Fecha_Modificacion;
    }
    public function toString(){
        return array("Id_Usuario"=>$this->Id_Usuario,
            "Nombre_Completo"=>$this->Nombre_Completo,
            "Edad"=>$this->Edad,
            "Telefono"=>$this->Telefono,
            "Correo"=>$this->Correo,
            "Contrasena"=>$this->Contrasena,
            "Contrasena_Anterior"=>$this->Contrasena_Anterior,
            "Fecha_Modificacion"=>$this->Fecha_Modificacion
        );
    }
}
?>
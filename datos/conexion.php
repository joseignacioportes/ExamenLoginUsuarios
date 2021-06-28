<?php
class conexion{
	private $conexion;
	private $configuracion=[
		"driver"=>"mysql",
		"host"=>"localhost",
		"database"=>"registro_usuarios",	
		"port"=>"3306",	
		"username"=>"root",
		"password"=>"",
		"charset"=>"UTF8"
	];
	
	public function __construct(){
	}
	
	public function conectar(){
		try{
			$CONTROLADOR=$this->configuracion["driver"];
			$SERVIDOR=$this->configuracion["host"];
			$BASE_DATOS=$this->configuracion["database"];
			$PUERTO=$this->configuracion["port"];
			$USUARIO=$this->configuracion["username"];
			$CLAVE=$this->configuracion["password"];
			$CODIFICACION=$this->configuracion["charset"];

			$url="{$CONTROLADOR}:host={$SERVIDOR};port={$PUERTO};"."dbname={$BASE_DATOS};charset={$CODIFICACION}";
			//SE CREA LA CONEXION
			$this->conexion=new PDO($url, $USUARIO, $CLAVE);
			return $this->conexion;
		}catch(Exception $exc){
			echo $exc->getTraceAsString();
		}
	}
}


?>
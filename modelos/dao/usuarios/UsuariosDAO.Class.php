<?php
include_once(dirname(__FILE__)."/../../../modelos/dto/usuarios/UsuariosDTO.Class.php");
include_once(dirname(__FILE__)."/../../../datos/conexion.php");
class UsuariosDAO{
 	protected $conexion;
	public function __construct() {
		$this->conexion = (new conexion())->conectar();
	}
	public function _conexion(){
		$this->_proveedor->connect();
	}
	
	
	public function Login($usuariosDto){
		try{
			$tmp = [];
			$hash_password= hash('sha256',$usuariosDto->getContrasena());
			$sql="SELECT *  FROM usuarios  WHERE Correo=:Correo and rtrim(ltrim(Contrasena))=:Contrasena";
			$stm=$this->conexion->prepare($sql);
			$stm->bindValue("Correo", $usuariosDto->getCorreo(), PDO::PARAM_STR);
			$stm->bindValue("Contrasena", $hash_password, PDO::PARAM_STR);
			$stm->execute();
			$count=$stm->rowCount();
			$data=$stm->fetch(PDO::FETCH_OBJ);
			if($count){
				$tmp[0] = new UsuariosDTO();
				$tmp[0]->setId_Usuario($data->Id_Usuario);
				$tmp[0]->setNombre_Completo($data->Nombre_Completo);
			}

			return $tmp;
		}catch(PDOException $e){
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
	
	
	public function RegistrarUsuarios($usuariosDto){
		try{
			$hash_password= hash('sha256',$usuariosDto->getContrasena());
			$sql="INSERT INTO usuarios(Nombre_Completo, Edad, Telefono, Correo, Contrasena, Fecha_Modificacion) VALUES (:Nombre_Completo,:Edad,:Telefono,:Correo,:Contrasena,NOW()) ";
			$stm=$this->conexion->prepare($sql);
			$stm->bindValue("Nombre_Completo", $usuariosDto->getNombre_Completo(), PDO::PARAM_STR);
			$stm->bindValue("Edad", $usuariosDto->getEdad(), PDO::PARAM_INT);
			$stm->bindValue("Telefono", $usuariosDto->getTelefono(), PDO::PARAM_STR);
			$stm->bindValue("Correo", $usuariosDto->getCorreo(), PDO::PARAM_STR);
			$stm->bindValue("Contrasena", $hash_password, PDO::PARAM_STR);
			$stm->execute();
			$uid=$this->conexion->lastInsertId();
			
			return $uid;
		}catch(PDOException $e){
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}
	}
	
		
	public function ValidaExisteCorreo($usuariosDto){
		try{
			$sql="SELECT Correo  FROM usuarios ";
			$sql.=" WHERE ";
			$sql.="Correo='".rtrim(ltrim($usuariosDto->getCorreo()))."'";
			$sth=$this->conexion->prepare($sql);
			$sth->execute();
			
			return $sth->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function Cambiar_Contrasena($usuariosDto){
	
		try{
			$boolean=false;
			$hash_password= hash('sha256',$usuariosDto->getContrasena());
			$hash_newpassword= hash('sha256',$usuariosDto->getContrasena_Nueva());
			$sql="UPDATE usuarios SET Contrasena=:Contrasena_Nueva, Fecha_Modificacion=now()  WHERE Correo=:Correo and rtrim(ltrim(Contrasena))=:Contrasena";
			$stm=$this->conexion->prepare($sql);
			$stm->bindValue("Correo", $usuariosDto->getCorreo(), PDO::PARAM_STR);
			$stm->bindValue("Contrasena", $hash_password, PDO::PARAM_STR);
			$stm->bindValue("Contrasena_Nueva", $hash_newpassword, PDO::PARAM_STR);
			$stm->execute();
			$count=$stm->rowCount();
			if($count>0){
				$boolean=true;
			}
			return $boolean;
		}catch(PDOException $e){
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
}
?>
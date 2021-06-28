<?php
session_start();
include_once(dirname(__FILE__)."/../../modelos/dto/usuarios/UsuariosDTO.Class.php");
include_once(dirname(__FILE__)."/../../controladores/usuarios/UsuariosController.Class.php");
include_once(dirname(__FILE__)."/../../datos/json/JsonEncod.Class.php");
include_once(dirname(__FILE__)."/../../datos/json/JsonDecod.Class.php");
class UsuariosFacade {
	private $proveedor;
	public function __construct() {
	}

	
	public function RegistrarUsuarios($UsuariosDto){
		$UsuariosController = new UsuariosController();
		$UsuariosDto = $UsuariosController->RegistrarUsuarios($UsuariosDto);
		$jsonDto = new Encode_JSON();
		if($UsuariosDto!=""){
			return $jsonDto->encode($UsuariosDto);
		}
		return $jsonDto->encode(array("text"=>"OCURRIO UN ERROR AL REALIZAR EL REGISTRO"));
	}

	public function IniciarSesion($UsuariosDto){
		$respuesta = array();
		$UsuariosController = new UsuariosController();
		$UsuariosDto = $UsuariosController->IniciarSesion($UsuariosDto);
		if(count($UsuariosDto)>0){
			$_SESSION['Id_Usuario']=$UsuariosDto[0]->getId_Usuario();
			$_SESSION['Nombre_Completo']=$UsuariosDto[0]->getNombre_Completo();	
			$respuesta=array("totalCount"=>"1", "text"=>"Inicio sesion correctamente", "location"=>"index.php");
		}else{
			$respuesta=array("totalCount"=>"0", "text"=>"El correo o la contraseña son invalidos");
		}
		$jsonDto = new Encode_JSON();
		return $jsonDto->encode($respuesta);
	}

	public function Cambiar_Contrasena($UsuariosDto){
		$respuesta = array();
		$UsuariosController = new UsuariosController();
		$UsuariosDto = $UsuariosController->Cambiar_Contrasena($UsuariosDto);
		$jsonDto = new Encode_JSON();
		if($UsuariosDto==true){
			$respuesta=array("totalCount"=>"1", "text"=>"Has cambiado la contraseña correctamente");
		}else{
			$respuesta=array("totalCount"=>"0", "text"=>"El correo o la contraseña son invalidos");
		}
		$jsonDto = new Encode_JSON();
		return $jsonDto->encode($respuesta);
	}

	
}



@$Id_Usuario=$_POST["Id_Usuario"];
@$Nombre_Completo=$_POST["Nombre_Completo"];
@$Edad=$_POST["Edad"];
@$Telefono=$_POST["Telefono"];
@$Correo=$_POST["Correo"];
@$Contrasena=$_POST["Contrasena"];
@$Contrasena_Nueva=$_POST["Contrasena_Nueva"];
@$Fecha_Modificacion=$_POST["Fecha_Modificacion"];
@$accion=$_POST["accion"];

$usuariosFacade = new UsuariosFacade();
$usuariosDto = new UsuariosDTO();

$usuariosDto->setId_Usuario($Id_Usuario);
$usuariosDto->setNombre_Completo($Nombre_Completo);
$usuariosDto->setEdad($Edad);
$usuariosDto->setTelefono($Telefono);
$usuariosDto->setCorreo($Correo);
$usuariosDto->setContrasena($Contrasena);
$usuariosDto->setContrasena_Nueva($Contrasena_Nueva);
$usuariosDto->setFecha_Modificacion($Fecha_Modificacion);

if( ($accion=="guardar") && ($Id_Usuario=="") ){
	$usuariosDto=$usuariosFacade->RegistrarUsuarios($usuariosDto);
	echo $usuariosDto;
} else if($accion=="login"){
	echo  $usuariosFacade->IniciarSesion($usuariosDto);
} else if($accion=="cambiar_contrasena"){
	echo  $usuariosFacade->Cambiar_Contrasena($usuariosDto);
}
?>
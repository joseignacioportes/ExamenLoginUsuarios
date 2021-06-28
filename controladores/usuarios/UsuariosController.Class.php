<?php
include_once(dirname(__FILE__)."/../../modelos/dto/usuarios/UsuariosDTO.Class.php");
include_once(dirname(__FILE__)."/../../modelos/dao/usuarios/UsuariosDAO.Class.php");
class UsuariosController {
	public function __construct() {
	}

	public function IniciarSesion($UsuariosDto){
		$UsuariosDao = new UsuariosDAO();
		$UsuariosDto = $UsuariosDao->Login($UsuariosDto);
		return $UsuariosDto;
	}
	
	public function RegistrarUsuarios($UsuariosDto){
		$respuesta = array();
		$Usuarios = new UsuariosDTO();
		$UsuariosDao = new UsuariosDAO();
		
		$Usuarios->setCorreo($UsuariosDto->getCorreo());
		$Usuarios=$UsuariosDao->ValidaExisteCorreo($Usuarios);
		if(count($Usuarios)>0){
			$respuesta = array("totalCount"=>"1", "mensaje" => "El correo ya se encuentra registrado.");	
		}else{
			$Usuarios = $UsuariosDao->RegistrarUsuarios($UsuariosDto);
			if($Usuarios!=""){
				$respuesta = array("totalCount"=>"1", "mensaje" => "Se ha registrado correctamente");
			}
		}
		return $respuesta;
	}

	public function Cambiar_Contrasena($UsuariosDto){
		$UsuariosDao = new UsuariosDAO();
		$UsuariosDto = $UsuariosDao->Cambiar_Contrasena($UsuariosDto);
		return $UsuariosDto;
	}

	
}
?>
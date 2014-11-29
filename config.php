<?php
//======================================//
require_once( 'sesiones.php');
$sesion = new sesiones();
//======================================//
//variables del sistema
$icon	=	"img/favicon.ico";
$tt 	=	"SGB";
$dev	= 	"Brall ";
//=================================================================================================

$actual = basename($_SERVER['PHP_SELF']); //Regresa el nombre del archivo actual

//=================================================================================================
//si no estoy en el index
if ( $actual != 'index.php'){	
	//console.log("estoy afuera inddex");	
	//si vengo del login
	if(empty($_SESSION['token_']) || empty($_POST['tokenID']) || !preg_match('/[0-9a-f]/',substr($_POST['tokenID'],0,40)) || $_SESSION['token_']!==$_POST['tokenID'] || $_SERVER['HTTP_REFERER'] !== "http://localhost/biblioteca/"){
		//console.log("no hay token");
		}else{
			//$usuario = 		$_POST['usuarioNombre'];				
			//$tokenSesion = 	$_POST['tokenID'];
			//$sesion->set("usuario",$usuario);
			//$sesion->set("tokenID",$tokenSesion);

			echo 'holaaaaaaaa';

			console.log("hola desde config");
		}	
	//=================================================================================================
	//si ya esta logiado el usuario
/*		
		$usuario		= $sesion->get("usuario");	
		$tokenSesion	= $sesion->get("tokenID");	
		if( $tokenSesion == false )  {
			  header("Location: http://localhost/biblioteca/");
		   }else{
			   //TODO
			   //variables del sistema ya logiado
			   $enLinea = $usuario;	
				//echo $tokenSesion;
				//echo $tokenUser;			   	   		   	   
			}*/
}else{

	console.log("toy index");
}



?>
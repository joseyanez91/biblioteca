<?php 
	include ('mysql.php');
	//instancio la clase mysql
	$db = new mysql();

	$errors	= array();// arreglo errores
	$data	= array();// arreglo datos

if (empty($_POST['nombre']))
		$errors['nombre'] = 'el nombre de usuario esta en blanco.';
	
	if (empty($_POST['pass']))
		$errors['pass'] = 'ingrese una contraseña.';
	
	// retorna un mensaje ===========================================================
	
	// si hay algunos errores en nuestos campos, retorna un mesaje.
	if ( !empty($errors)) {	
		
		$data['success'] = false;
		$data['errors']  = $errors;
	} else {		
		$nombre = $_POST['nombre'];
		$pass 	=  $_POST['pass'];
		//abro una conexion de la DB
		$db->abrir();
		//hago la consulta a la DB
		$datos = $db->consulta("SELECT * FROM login WHERE usuario='".$nombre."' AND pass='".$pass."' ");			
		if(!$datos){
			$errors['noUser'] = 'contraseña o usuario invalido';
			$data['success'] = false;
			$data['errors']  = $errors;
			
			}else{
				// si no hay errores en nuestro formulario, envia los datos del servidor
				$data['success'] = true;
				$data['message'] = 'bienvenido!';
				$data['datos'] 	 = $datos[0];
				
				}		
		//cierro la conexion a la DB
		$db->cerrar();			
	}	
	// envia la respuesta AJAX del servidor
	echo json_encode($data);

 ?>
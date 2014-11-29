<?php
class sesiones{
	
	function __construct(){
		session_start();		
		}
	
	public function set($nombre, $valor){
		$_SESSION[$nombre] = $valor;
		}
	public function get($nombre){		
		if(isset($_SESSION[$nombre])){
				return $_SESSION[$nombre];
			}else{
				return false;
				}
		}
	public function eliminaSesion($nombre){
		unset($_SESSION[$nombre]);
		
		}			
	public function cerrarSession(){
			$_SESSION = array();
			session_destroy();
		}		
	}
	
	
?>
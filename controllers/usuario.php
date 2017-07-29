<?php 

require_once('../models/usuario.php');

if (isset($_POST['op'])) {

	$op = $_POST['op'];

	switch ($op) {
		case 'salir':
			session_start();
			session_destroy();
			break;	

		case 'ingreso':
			$email = $_POST['email'];
			$password = $_POST['password'];
			$ins = new usuario();
			$array = $ins->identificar($email,$password);
			if ($array[0] > 0 ){
				session_start();
				$_SESSION['ingreso'] = "YES";
				$_SESSION['nombre'] = $array[1].' '.$array[2];
				echo "1";
			}
			else {
				echo "2"; 
			}
		break;
					
		case 'registro':
			$reg = new usuario();
			$reg->registro($_POST['nombre'],$_POST['apellido'],$_POST['correo'],$_POST['password1']);
			if ($reg) echo "1";
			else echo "2";
		break;
		}
	
	
}

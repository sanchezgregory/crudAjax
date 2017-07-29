<?php 
class usuario 
{
	private $conexion;
	public function __construct() 
	{
		require_once('conexion.php');
		$this->conexion = new conexion();
		$this->conexion->conectar();
	}
	function identificar($email, $password) 
	{
		$sql = "select * from usuario where email = '$email' && password = '$password'";

		$resultado = $this->conexion->conexion->query($sql);
		if ($resultado->num_rows > 0 ) {
			$r = $resultado->fetch_array();
		} else {
			$r[0] = 0;
		}
		return $r;
		$this->conexion->cerrar();
	}
	function registro($nombre,$apellido,$email,$password) {
		$sql = "INSERT INTO usuario (nombre, apellido, email, password) VALUES ('$nombre','$apellido','$email','$password')";
		if($this->conexion->conexion->query($sql)) {
			return true;
		} else {
			return false;
		}
		$this->conexion->cerrar();
	}
}
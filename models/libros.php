<?php 
/**
* 
*/
class Libro
{
	public $conexion;

	function __construct()
	{
		require_once('conexion.php');
		$this->conexion = new conexion();
		$this->conexion->conectar();
	}
	function lista_libros($valor) 
	{
		$sql = "Select * from libros WHERE titulo like '%$valor%' or autor like '%$valor%'";
		$this->conexion->conexion->set_charset('utf8');	
		$resultado = $this->conexion->conexion->query($sql);
		$arreglo = array();
		while ($resp = $resultado->fetch_row()){
			$arreglo[] = $resp;
		}
		return $arreglo;
		$this->conexion->cerrar();

	}

	function editaLibro($id,$titulo,$autor,$idioma,$editorial) 
	{
		$sql = "UPDATE libros SET titulo='$titulo', autor='$autor', idioma='$idioma',editorial='$editorial' WHERE id = '$id'";
		if ($this->conexion->conexion->query($sql)) {
			return true;
		} else {
			return false;
		}

		$this->conexion->cerrar();

	}

	function deleteLibro($id)
	{
		$sql = "DELETE FROM libros WHERE id = $id";
		if( $this->conexion->conexion->query($sql)) return true;
		else return false;
		$this->conexion->cerrar();
	}
}
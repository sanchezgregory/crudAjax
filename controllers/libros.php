<?php 

require_once('../models/libros.php');

if (isset($_POST['op'])) {

	$op = $_POST['op'];

	switch ($op) {
		case 'buscar':
			$r = $_POST['valor'];
			$libros = new Libro();
			$r = $libros->lista_libros($r);
			echo json_encode($r);
			break;

		case 'editar':
			$ins = new Libro();
			$id=$_POST['id'];
			$titulo= $_POST['titulo'];
			$autor=$_POST['autor'];
			$idioma=$_POST['idioma'];
			$editorial=$_POST['editorial'];
			if ($ins->editaLibro($id,$titulo,$autor,$idioma,$editorial)) {
				echo "1";
			}
			else {
				echo "0";
			}
			break;
		case 'borrar':
			$id = $_POST['id'];
			$ins = new Libro();
			if ($ins->deleteLibro($id)) echo "1";
			else echo "2";
			break;
		
		default:
			echo "no paso";
			break;
}

}
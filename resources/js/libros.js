function buscarLibros(valor){
		$.ajax({
		url:'../controllers/libros.php',
		type:'POST',
		data:'op=buscar&valor='+valor
	}).done(function(resp){
		var resp = eval(resp);
		var html = "<table class='table table-bordered'<tr><td>cod</td><td>titulo</td><td>autor</td><td>idioma</td><td>editorial</td><td>Acciones</td></tr>";

		for(var i=0; i<resp.length; i++){
			var datos = resp[i][0]+'*'+resp[i][1]+'*'+resp[i][2]+'*'+resp[i][3]+'*'+resp[i][4];
			html += "<tr><td>"+resp[i][0]+"</td><td>"+resp[i][1]+"</td><td>"+resp[i][2]+"</td><td>"+resp[i][3]+"</td><td>"+resp[i][4]+"</td><td><a href='' onclick='mostrar("+'"'+datos+'"'+")' data-toggle='modal' data-target='#modalLibros' class='btn btn-success'>edit</a> <button class='btn btn-danger' onclick='mostrar2("+'"'+datos+'"'+")' data-toggle='modal' data-target='#borraLibro'>Del</button></td></tr>";
		}
		html+="</table>";
		$('#result').html(html);
	});
}
function mostrar(datos)
{
	var res = datos.split('*');
	$('#id').val(res[0]);
	$('#titulo').val(res[1]);
	$('#autor').val(res[2]);
	$('#idioma').val(res[3]);
	$('#editorial').val(res[4]);

}
function editLibro() 
{	
	$.ajax({
		url:'../controllers/libros.php',
		type:'POST',
		data:$('#editLibro').serialize(),
	}).done(function(e){
		if(e=="1") $('#editado').show('slow/400/fast');
	});
	buscarLibros('');
}
function mostrar2(datos) 
{
	var res = datos.split('*');
	$('#idL').html(res[0]);
	$('#tituloL').html(res[1]);
	$('#autorL').html(res[2]);
	$('#idiomaL').html(res[3]);
	$('#editorialL').html(res[4]);
}
function borrarLibro() 
{
	var id = $('#idL').html();
	$.ajax({
		url:'../controllers/libros.php',
		type:'POST',
		data:'op=borrar&id='+id
	}).done(function(resp){
		if(resp=="1") $('#borrado').show('slow/400/fast');
	});
	buscarLibros('');
}
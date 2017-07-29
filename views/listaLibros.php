<?php 
session_start();
if (isset($_SESSION['ingreso']) && ($_SESSION['ingreso'] == 'YES'))
{ ?>

	<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nombre']; ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#" onclick="cerrar()">Cerrar session</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
        <br><br>
        <div class="container">
        <div class="row">
          <div class="col-md-9 col-md-offset-1">
            <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">listado de libros</h3>
            </div>
            <div class="alert alert-success" id="borrado" style="display: none;">Libro borrado con exito</div>
            <div class="panel-body">
              <div class="well">
                <form class="form-inline">
                  <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">buscar</label>
                    <div class="input-group">
                      <div class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
                      <input type="text" class="form-control" onkeyup="buscarLibros(this.value);"  id="buscar" placeholder="Amount">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Buscar</button>
                </form> 
              </div>
              <div id="result"></div>
            </div>  
          </div>
          </div>
        </div>
        

      </div> <!-- /container -->
    </div>
    <!-- Modal -->
<div class="modal fade" id="modalLibros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <form id="editLibro">
            <div class="form-group has-success has-feedback">
                
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                  <input type="text" name="titulo" id="titulo" class="form-control" aria-describedby="titulo" placeholder="titulo">
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                  <input type="text" name="autor" id="autor" class="form-control" aria-describedby="autor" placeholder="autor">
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                  <input type="text" name="idioma" id="idioma" class="form-control" aria-describedby="idioma" placeholder="idioma">
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></span>
                  <input type="text" name="editorial" id="editorial" class="form-control"  aria-describedby="editorial" placeholder="editorial">
                </div>
            </div>
            <input type="hidden" name="op" id="op" value="editar">
            <input type="hidden" name="id" id="id">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="editar" onclick="editLibro()" class="btn btn-primary" >Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal borra libros -->
<!-- Modal -->
<div class="modal fade" id="borraLibro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
          Estas seguro de borrar el libro: <strong><span id="tituloL"></span></strong>
          con sus datos: <br>
          <div id="idL" style="display: none"></div>
          Autor: <span id="autorL"></span>
          Idioma: <span id="idiomaL"></span> 
          Editorial: <span id="editorialL"></span><p></p>
          <button id="borrarLibro" onclick="borrarLibro()" class="btn btn-danger" data-dismiss="modal" >Si, borrar!</button>
      </div>
    </div>
  </div>
</div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../resources/js/jquery.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script> 
    <script src="../resources/js/libros.js"></script>   
    <script>
    function cerrar() {
      $.ajax({
        url:'../controllers/usuario.php',
        type:'POST',
        data:'op=salir'
      }).done(function(resp) {
        location.href = '../views'
      });
    }
    </script>

  </body>
</html>

	
<?php } else {
		header('location:index.php');
} ?>
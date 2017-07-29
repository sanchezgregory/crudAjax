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

    <title>Crud Ajax Php MySql</title>

    <!-- Bootstrap core CSS -->
    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">
    
  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="#" data-toggle="modal" data-target="#registro">Registrarse</a>
            </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
        <br><br>
        <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4" >
          <div id="result" style="display: none;">
            <div class="alert alert-danger"> Registro no encontrado</div>
         </div>
         <div id="result2" style="display: none;">
            <div class="alert alert-danger"> Procesando <img src="../resources/img/giphy.gif"></div>
         </div>
            <form id="form">
            <div class="form-group has-success has-feedback">
                <label class="control-label" for="usuario">Usuario</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                  <input type="text" name="email" id="email" class="form-control" id="usuario" aria-describedby="usuario">
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                <label class="control-label" for="usuario">Password</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></span>
                  <input type="password" name="password" id="password" class="form-control" id="usuario" aria-describedby="usuario">
                </div>
            </div>
            <input type="hidden" name="op" id="op" value="ingreso">
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Entrar</button>

          </form>
          </div>
        </div>

      </div> <!-- /container -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Formulario de registro</h4>
      </div>
      <div class="modal-body">
      <div class="well" id="campovacio" style="display: none">No haber campos vacios</div>
      <div class="well" id="passwordnoigual" style="display: none">Los password no coinciden</div>
      <div class="well" id="reg" style="display: none">Registro exitoso</div>
        <form id="formreg">
            <div class="form-group has-success has-feedback">
                
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                  <input type="text" name="nombre" id="nombre" class="form-control" aria-describedby="nombre" placeholder="Nombre">
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                  <input type="text" name="apellido" id="apellido" class="form-control" aria-describedby="apellido" placeholder="Apellido">
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                  <input type="text" name="correo" id="correo" class="form-control" aria-describedby="correo" placeholder="Email">
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></span>
                  <input type="password" name="password1" id="password1" class="form-control"  aria-describedby="password1" placeholder="Password">
                </div>
            </div>
            <div class="form-group has-success has-feedback">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-star" aria-hidden="true"></span></span>
                  <input type="password" name="password2" id="password2" class="form-control" aria-describedby="password2" placeholder="Confirme password">
                </div>
            </div>
            <input type="hidden" name="op" id="op" value="registro">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="registro" class="btn btn-primary" >Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../resources/js/jquery.js"></script>
    <script src="../resources/js/bootstrap.min.js"></script>    
    <script>
    $(document).ready(function() {
      $('#form').submit(function(e) {
        e.preventDefault();
        var res = true;
        var email = $('#email').val();
        var password = $('#password').val();
        if (email == "" || password == "") {
          $('#result').html("No deben haber datos vacios");
        } else {
                $.ajax({
                  url:"../controllers/usuario.php",
                  type:'POST',
                  data:$('#form').serialize(),
                }).done(function(resp) {
                  if (resp==1) {
                    $('#result2').show('slow/400/fast');
                    var delayMillis = 1000; //1 second
                    $('#result2').show();
                    setTimeout(function() {
                      location.href = 'principal.php';
                    }, delayMillis);
                    
                  } else {
                      $('#result').show('slow/400/fast');
                    }
                  
                });
              } 
          });
      $('#formreg').submit(function (e) {
            e.preventDefault();
            var nombre =    $('#nombre').val();
            var apellido =  $('#apellido').val();
            var correo =     $('#correo').val();
            var password1 =  $('#password1').val();
            var password2 =  $('#password2').val();
            if (nombre == "" || apellido == "" || correo == "" || password1 == "" || password2 == "") {
              $('#campovacio').show();
            }
            else if (password1 == password2){
                $.ajax({
                  url:'../controllers/usuario.php',
                  type:'POST',
                  data: $('#formreg').serialize()
                }).done(function(resp) {
                    if (resp==1) $('#reg').show('slow/400/fast');
                      else alert('No se logro registrar');
                });
            } else {
              $('#passwordnoigual').show('slow/400/fast');
            }
          });   
        });
    </script>
  </body>
</html>

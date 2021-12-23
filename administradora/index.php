<?php
if($_POST){
           if(($_POST['usuario']=="admin")&&($_POST['contraseña']=="admin"))

             header('location:/roxana/administradora/inicio.php');



}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="./css/bootstrap.min.css"/>

  </head>
  <body>
 
<div class="container">
    <div class="row">

<div class="col-md-4">
    
</div>
        <div class="col-md-5">
 <br/><br/><br/>
        <div class="card">

            <div class="card-header">
                Login
            </div>
            <div class="card-body">
                

            <form method="POST" >

            <div class = "form-group">
            <label for="exampleInputEmail1">Usuario</label>
            <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="Escriba su usuario">
            </div>

            <br/>
            <div class="form-group">
            <label for="exampleInputPassword1">Contraseña:</label>
            <input type="password" class="form-control" name="contraseña"  placeholder="Contraseña">
            </div>
            <br/><br/>
            <button type="submit" class="btn btn-primary">Ingresar a mi inventario</button>
            </form>            
            </div>

        </div>

        </div>
        
    </div>
</div>

  </body>
</html>
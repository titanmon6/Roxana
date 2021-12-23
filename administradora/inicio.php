<!doctype html>
<html lang="en">
  <head>
    <title>Mi base de datos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
  </head>
  <body>

 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Inventario de el negocito <span class="sr-only" > 
        </li>

    </ul>
</nav>

<?php
$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
$txtValor=(isset($_POST['txtValor']))?$_POST['txtValor']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$host="localhost";
$bd="inventario";
$usuario="root";
$contraseña="";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contraseña );


} catch (Exception $ex) {
    echo $ex->getmessage();
}

switch($accion){
     case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO `inventario` (`Id`, `Nombre`, `Cantidad`, `Valor`) VALUES (NULL, '$txtNombre', '$txtCantidad', '$txtValor');");
        $sentenciaSQL->execute();
    break;

    case "Borrar":
        $sentenciaSQL=$conexion->prepare("DELETE FROM inventario WHERE Id=:Id");
        $sentenciaSQL->bindparam(':Id', $txtId);
        $sentenciaSQL->execute();
        break;
    case  "modificar":
        $sentenciaSQL= $conexion->prepare("UPDATE inventario SET Cantidad=:Cantidad WHERE id=id");
        $sentenciaSQL->bindparam(':Cantidad',$textCantidad);
        $sentenciaSQL->bindparam(':Id', $txtId);
        $sentenciaSQL->execute();
        echo "$textCantidad";
        break;

}

$sentenciaSQL=$conexion->prepare("SELECT * FROM inventario");
$sentenciaSQL->execute();
$total=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-3">

<div class="card">
    <div class="card-header">
        Agregar productos al inventario
    </div>

    <div class="card-body">
    <form method="POST" enctype="multipart/form-data">
      <div class = "form-group">
      <label for="txtNombre">Nombre del producto:</label>
      <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombre">
    </div>

    <div class = "form-group">
      <label for="txtCantidad">Cantidad:</label>
      <input type="text" class="form-control" name="txtCantidad" id="txtCantidad" placeholder="Cantidad">
    </div>

    <div class = "form-group">
      <label for="txtValor">Valor del producto:</label>
      <input type="text" class="form-control" name="txtValor" id="txtValor" placeholder="Valor">
    </div>

    <br/>
    <input type="submit" class="btn btn-primary" name="accion" value="Agregar" >


    </form>
    </div>
</div>
<br>
<div class="col-md-12" mt-5>
<form action="" method="get">
  <input type="text" name="busqueda"><br>
  <input type="submit" name="enviar" value="buscar" class="btn btn-primary">
</form>  
</div>   
</div>
<br>
<?php
if (isset($_GET['enviar'])){
    $busqueda = $_GET['busqueda'];

    $consulta = $conexion->query("SELECT * FROM inventario WHERE Nombre LIKE '%busqueda%'");
    while ($row = $consulta->fetch_array()){
        echo $row['Nombre'].'<br>';
    }
}
?>
<div class="col-md-12 ">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Valor</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($total as $inventario) { ?>
            <tr>
                <td><?php echo $inventario['Nombre']  ?> </td>
                <td><?php echo $inventario['Cantidad']  ?></td>
                <td><?php echo $inventario['Valor']  ?></td>
                <td>
                      <form method="post">

                       <input type="hidden" name="txtId" id="txtId" value=<?php echo $inventario['Id']  ?>>

                       <input type="submit" name="accion" value="Borrar" class="btn btn-primary">
                       <input type="submit" name="accion" value="Modificar" class="btn btn-primary">
                      </form>

                </td>



            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>  



</div>
        
    </div>
</div>


  </body>
</html>
<?php
$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
$txtValor=(isset($_POST['txtValor']))?$_POST['txtValor']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$txtVenta= (isset($_POST['txtVenta']))?$_POST['txtVenta']:"";
$txtCompra= (isset($_POST['txtCompra']))?$_POST['txtCompra']:"";
$txtOrigen= (isset($_POST['txtOrigen']))?$_POST['txtOrigen']:"";
$txtAgregado= (isset($_POST['txtAgregado']))?$_POST['txtAgregado']:"";

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
        $sentenciaSQL= $conexion->prepare("INSERT INTO inventario (Nombre,Cantidad,Valor,Agregado,Origen) VALUES (:Nombre,:Cantidad,:Valor,:Agregado,:Origen);");
        $c= $txtOrigen + (($txtOrigen*$txtAgregado)/100);
        $sentenciaSQL->bindparam(':Nombre',$txtNombre);
        $sentenciaSQL->bindparam(':Cantidad',$txtCantidad);
        $sentenciaSQL->bindparam(':Valor',$c);
        $sentenciaSQL->bindparam(':Agregado',$txtAgregado);
        $sentenciaSQL->bindparam(':Origen',$txtOrigen);
        $sentenciaSQL->execute();
    break;

    case "Modificar":
        if ($txtVenta && $txtCompra==null){
        $sentenciaSQL= $conexion->prepare("UPDATE inventario SET Cantidad=:Cantidad WHERE Id=:Id");
        $sentenciaSQL->bindparam(':Cantidad',$txtCantidad);
        $sentenciaSQL->bindparam(':Id',$txtId);
        $sentenciaSQL->execute();
        }
        if ($txtVenta!=null && $txtCompra==null){
            $sentenciaSQL= $conexion->prepare("UPDATE inventario SET Cantidad=:Cantidad WHERE Id=:Id");
            $a= $txtCantidad - $txtVenta;
            $sentenciaSQL->bindparam(':Cantidad',$a);
            $sentenciaSQL->bindparam(':Id',$txtId);
            $sentenciaSQL->execute();
            $txtVenta=null;
            $txtCompra=null;
            }

         if ($txtCompra!=null && $txtVenta==null){
            $sentenciaSQL= $conexion->prepare("UPDATE inventario SET Cantidad=:Cantidad WHERE Id=:Id");
             $a= $txtCantidad + $txtCompra;
             $sentenciaSQL->bindparam(':Cantidad',$a);
             $sentenciaSQL->bindparam(':Id',$txtId);
             $sentenciaSQL->execute();
             $txtVenta=null;
             $txtCompra=null;
             }

      $sentenciaSQL= $conexion->prepare("UPDATE inventario SET Nombre=:Nombre WHERE Id=:Id");
      $sentenciaSQL->bindparam(':Nombre',$txtNombre);
      $sentenciaSQL->bindparam(':Id',$txtId);
      $sentenciaSQL->execute();

      $sentenciaSQL= $conexion->prepare("UPDATE inventario SET Valor=:Valor WHERE Id=:Id");
      $b= $txtOrigen + (($txtOrigen*$txtAgregado)/100);
      $sentenciaSQL->bindparam(':Valor',$b);
      $sentenciaSQL->bindparam(':Id',$txtId);
      $sentenciaSQL->execute();

      $sentenciaSQL= $conexion->prepare("UPDATE inventario SET Agregado=:Agregado WHERE Id=:Id");
      $sentenciaSQL->bindparam(':Agregado',$txtAgregado);
      $sentenciaSQL->bindparam(':Id',$txtId);
      $sentenciaSQL->execute();

      $sentenciaSQL= $conexion->prepare("UPDATE inventario SET Origen=:Origen WHERE Id=:Id");
      $sentenciaSQL->bindparam(':Origen',$txtOrigen);
      $sentenciaSQL->bindparam(':Id',$txtId);
      $sentenciaSQL->execute();

    break;

    case "Borrar":
        $sentenciaSQL=$conexion->prepare("DELETE FROM inventario WHERE Id=:Id");
        $sentenciaSQL->bindparam(':Id', $txtId);
        $sentenciaSQL->execute();
        break;

    case "Seleccionar":
        $sentenciaSQL=$conexion->prepare("SELECT * FROM inventario WHERE Id=:Id");
        $sentenciaSQL->bindparam(':Id', $txtId);
        $sentenciaSQL->execute();
        $Base=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtNombre=$Base['Nombre'];
        $txtCantidad=$Base['Cantidad'];
        $txtValor=$Base['Valor'];
        $txtAgregado=$Base['Agregado'];
        $txtOrigen=$Base['Origen'];
    break;
}

$sentenciaSQL=$conexion->prepare("SELECT * FROM inventario");
$sentenciaSQL->execute();
$total=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
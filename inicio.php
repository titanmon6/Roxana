<?php include("./template/cabecera.php"); ?>
<?php include("./BaseDatos/BaseDatos.php"); ?>


<body>
<div class="container">
    <div class="row">

<div class="col-xs-1">
    
</div>
        <div class="col-md-3">
        <div class="card">

            <div class="card-header">
                Agregar Producto:
            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

<div class = "form-group">
  <input type="hidden" class="form-control" value="<?php echo $txtId; ?>" name="txtId" id="txtId" placeholder="Id">
</div>

<div class = "form-group">
  <label for="txtNombre">Nombre del producto:</label>
  <input type="text" class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
</div>

<div class = "form-group">
  <label for="txtCantidad">Cantidad:</label>
  <input type="text" class="form-control" value="<?php echo $txtCantidad; ?>" name="txtCantidad" id="txtCantidad" placeholder="Cantidad">
</div>

<div class = "form-group">
  <label for="txtOrigen">Precio de origen:</label>
  <input type="text" class="form-control" value="<?php echo $txtOrigen; ?>" name="txtOrigen" id="txtOrigen" placeholder="Origen">
 </div>

 <div class = "form-group">
  <label for="txtAgregado">Porcentaje agregado:</label>
  <input type="text" class="form-control" value="<?php echo $txtAgregado; ?>" name="txtAgregado" id="txtAgregado" placeholder="Agregado">
 </div>

<div class = "form-group">
  <input type="hidden" class="form-control" value="<?php echo $txtValor; ?>" name="txtValor" id="txtValor" placeholder="Valor">
</div>
----------------------------
 <div class = "form-group">
  <label for="txtVenta">Cuanto producto vendi?:</label>
  <input type="text" class="form-control"  name="txtVenta" id="txtVenta" placeholder="Venta">
 </div>

 <div class = "form-group">
  <label for="txtCompra">Cuanto producto compre?:</label>
  <input type="text" class="form-control" name="txtCompra" id="txtCompra" placeholder="Compra">
 </div>

  <br/>
 <div class="btn-group" role="group" aria-label="">
  <button type="submit" name="accion" value="Agregar" class="btn btn-primary">Agregar</button>
  <button type="submit" name="accion" value="Modificar" class="btn btn-info">Modificar</button>
 </div>
 </form>       

        </div>
        
    </div>
</div>



<div class="col-md-9">
    <table class="table table-bordered">
      
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Origen</th>
                <th>%</th>
                <th>Valor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($total as $inventario) { ?>
            <tr>
                <td><?php echo $inventario['Nombre']  ?> </td>
                <td><?php echo $inventario['Cantidad']   ?></td>
                <td><?php echo $inventario['Origen']  ?> $</td>
                <td><?php echo $inventario['Agregado']  ?>%</td>
                <td><?php echo $inventario['Valor'] ?> $ </td>
                <td>
                      <form method="post">

                       <input type="hidden" name="txtId" id="txtId" value=<?php echo $inventario['Id']  ?>>

                       <input type="submit" name="accion" value="Borrar" class="btn btn-danger">

                       <input type="submit" name="accion" value="Seleccionar" class="btn btn-info">

                       <?php if($inventario['Cantidad'] < 7){ echo "<input type='button' value='Renovar Stock!'onclick='save()'> ";}  ?>

                      </form>

                </td>



            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>  
</body>
</html>
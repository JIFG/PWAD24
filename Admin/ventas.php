<?php
include("../conexion.php"); include "encabezado.php";

$stmt =$conn->prepare("SELECT * FROM productos");
$stmt->execute();
$stmt2 =$conn->prepare("SELECT * FROM categorias");
$stmt2->execute();
echo '
<!-- Form Alta Productos -->


<div id="altaProd" class="modal">
<span onclick="document.getElementById(&quot;altaProd&quot;).style.display=&quot;none&quot;" class="close" title="Close Modal">&times;</span>
<form class="modal-content" action="altaProd.php" method="POST" enctype="multipart/form-data">
<div class="container">
<h1>Añadir un nuevo Producto</h1>
<hr>
<div class="mb-3">
<label class="form-label" for="cat"><b>Producto</b></label>
<input class="form-control" type="text" placeholder="Escribe el nombre del Producto" name="prod" required>
</div>
<label class="form-label" for="cat"><b>Categoría superior</b></label>
<select class="form-control" name="cat" required>
<option value="0" selected>Ninguna</option>'; while($row = $stmt2->fetch(PDO::FETCH_OBJ)){
echo '<option value="'.$row->id.'">'.$row->categoria.'</option>';
}
echo '
</select>
</div>
<div class="mb-3">
<label class="form-label" for="precio"><b>Precio</b></label>
$<input class="form-control" type="number" placeholder="0.00" name="precio" required>
</div>
<div class="mb-3">
<label class="form-label" for="desc"><b>Descripción</b></label><br>
<textarea class="form-control" name="desc" rows="5"></textarea>
</div>
<div class="mb-3">
<label class="form-label" for="fechaReg"><b>Fecha de Registro</b></label>
$<input class="form-control" type="date" placeholder="dd/mm/aa" name="fechaReg" required>
</div>
<div class="clearfix">
<button type="button" onclick="document.getElementById(&quot;altaProd&quot;).style.display=&quot;none&quot;" class="cancelbtn">Cancelar</button>
<button type="submit" class="signup">Agregar producto</button>
</div>
</div>
</form>
</div>
<!-- Fin Alta Categoría -->



<!-- Form Eliminar Categoría -->
<div id="delProd" class="modal">
<span onclick="document.getElementById(&quot;delProd&quot;).style.display=&quot;none&quot;" class="close" title="Close Modal">&times;</span>
<form class="modal-content" action="eliminarProd.php" method="POST">
<input type="hidden" name="idDel" id="idProdDel">
<div class="container">
<h1>Eliminar la categoría <b><span id="delProdSel"></span></b></h1>
<hr>
<p>¿Estás seguro de que deseas eliminar el producto seleccionado?</p>
<div class="clearfix d-flex">
<button type="button" onclick="document.getElementById(&quot;delProd&quot;).style.display=&quot;none&quot;" class="btn btn-danger" style="width:auto;">Cancelar</button>
<button type="submit" class="btn btn-primary" style="width:auto;">Eliminar Producto</button>
</div>
</div>
</form>
</div>
<!-- Fin Eliminar Categoría -->
 
</br>
<div class="d-flex justify-content-between m-4">
<h2>VENTAS</h2>
<!-- Button to open the modal -->
<button type="button" class="btn btn-sm" style="width:auto" onclick="document.getElementById(&quot;altaProd&quot;).style.display=&quot;block&quot;"><i class="fa-sharp fa-solid fa-file-circle-plus" style="font-size:60px;"></i></button>
</div>
<hr>
<table class="table">
<tr>
<th>PRODUCTO</th>
<th>CATEGORÍA</th>
<th>PRECIO</th>
<th>DESCRIPCIÓN</th>
<th>FECHA DE REGISTRO</th>
<th>MODIFICAR</th>
<th>ELIMINAR</th>
</tr>';

$stmt =$conn->prepare("SELECT * FROM productos");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_OBJ)){ echo "<tr>";
echo "<td>" . $row->producto . "</td>";
$stmt2 = $conn->prepare("SELECT * FROM categorias WHERE id = ?");
$stmt2->execute([$row->catId]);

if($row2=$stmt2->fetch(PDO::FETCH_OBJ)){ echo "<td>" . $row2->categoria . "</td>";
}else{
echo "<td> -- </td>";
}


echo "<td>" . $row->precio . "</td>";

 echo "<td>" . $row->descripcion . "</td>";
 echo "<td>" . $row->fechaReg . "</td>";
echo '<td><a class="btn btn-sm" style="width: auto;" href="editProdForm.php?id='.$row->id.'"><i class="fa-solid fa-file-pen" style="font-size:40px"></i></a></td>';
echo '<td><button type="button" class="btn btn-sm" style="width:auto" onclick="document.getElementById(&quot;delProd&quot;).style.display=&quot;block&quot;; document.getElementById(&quot;delProdSel&quot;).innerHTML=&quot;'.$row->producto.'&quot;;
document.getElementById(&quot;idProdDel&quot;).value=&quot;'.$row->id.'&quot;;"><i class="fa-solid fa-trash-can" style="font-size:40px"></i></button></td>'; echo "</tr>";
}
$conn=null; echo '</table>';
include "footer.php";
?>
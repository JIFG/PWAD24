<?php
include("../conexion.php"); 
include "encabezado.php";

$stmt =$conn->prepare("SELECT * FROM cocina2");
$stmt->execute();
 
echo '

<div id="id01" class="modal">
<span onclick="document.getElementById(&quot;id01&quot;).style.display=&quot;none&quot;" class="close" title="Close Modal">&times;</span>
<form class="modal-content" action="altaCat.php" method="POST" enctype="multipart/form-data">
<div class="container">
<h1>Añadir una nueva categoría</h1>
<hr>
<div class="mb-3">
<label class="form-label" for="cat"><b>Categoría</b></label>
<input class="form-control" type="text" placeholder="Escribe el nombre de la categoría" name="cat" required>
</div>
<div class="mb-3">
<label class="form-label" for="catPadre"><b>Categoría superior</b></label>
<select class="form-control" name="catPadre" required>
<option value="0" selected>Ninguna</option>'; while($row = $stmt->fetch(PDO::FETCH_OBJ)){
echo '<option value="'.$row->id.'">'.$row->categoria.'</option>';
}
echo '
</select>
</div>
<div class="mb-3">
<label class="form-label" for="img"><b>Imagen</b></label>
<input class="form-control" type="file" name="img">
</div>
<div class="mb-3">
<label class="form-label" for="desc"><b>Descripción</b></label><br>
<textarea class="form-control" name="desc" rows="5"></textarea>
</div>
<div class="clearfix">
<button type="button" onclick="document.getElementById(&quot;id01&quot;).style.display=&quot;none&quot;" class="cancelbtn">Cancelar</button>
<button type="submit" class="signup">Crear categoría</button>
</div>
</div>
</form>
</div>
<!-- Fin Alta Categoría -->



<!-- Form Eliminar Categoría -->
<div id="delCat" class="modal">
<span onclick="document.getElementById(&quot;delCat&quot;).style.display=&quot;none&quot;" class="close" title="Close Modal">&times;</span>
<form class="modal-content" action="eliminarCat.php" method="POST">
<input type="hidden" name="idDel" id="idCatDel">
<div class="container">
<h1>Eliminar la categoría <b><span id="delCatSel"></span></b></h1>
<hr>
<p>¿Estás seguro de que deseas eliminar la categoría?</p>
<div class="clearfix d-flex">
<button type="button" onclick="document.getElementById(&quot;delCat&quot;).style.display=&quot;none&quot;" class="btn btn-danger" style="width:auto;">Cancelar</button>
<button type="submit" class="btn btn-primary" style="width:auto;">Eliminar categoría</button>
</div>
</div>
</form>
</div>
<!-- Fin Eliminar Categoría -->
 
</br>
<div class="d-flex justify-content-between m-4">
<h2>Menu de platillos</h2>
<!-- Button to open the modal -->
<button type="button" class="btn btn-sm" style="width:auto" onclick="document.getElementById(&quot;id01&quot;).style.display=&quot;block&quot;"><i class="fa-sharp fa-solid fa-file-circle-plus" style="font-size:60px;"></i></button>
</div>
<hr>
<table class="table">
<tr>
<th>CATEGORÍA</th>
<th>CATEGORÍA SUPERIOR</th>
<th>IMAGEN</th>
<th>DESCRIPCIÓN</th>
<th>MODIFICAR</th>
<th>ELIMINAR</th>
</tr>';

$stmt =$conn->prepare("SELECT * FROM cocina2");
$stmt->execute();
while($row = $stmt->fetch(PDO::FETCH_OBJ)){ echo "<tr>";
echo "<td>" . $row->categoria . "</td>";
$stmt2 = $conn->prepare("SELECT * FROM cocina2 WHERE menuId = ?");
$stmt2->execute([$row->catPadre]);
if($row2=$stmt2->fetch(PDO::FETCH_OBJ)){ echo "<td>" . $row2->categoria . "</td>";
}else{
echo "<td> -- </td>";
}
echo "<td><img src='../" . $row->imagen . "' class='w-5' style='width:100px'></td>"; echo "<td>" . $row->descripcion . "</td>";
echo '<td><a class="btn btn-sm" style="width: auto;" href="editCatForm.php?menuId='.$row->id.'"><i class="fa-solid fa-file-pen" style="font-size:40px"></i></a></td>';
echo '<td><button type="button" class="btn btn-sm" style="width:auto" onclick="document.getElementById(&quot;delCat&quot;).style.display=&quot;block&quot;; document.getElementById(&quot;delCatSel&quot;).innerHTML=&quot;'.$row->categoria.'&quot;;
document.getElementById(&quot;idCatDel&quot;).value=&quot;'.$row->id.'&quot;;"><i class="fa-solid fa-trash-can" style="font-size:40px"></i></button></td>'; echo "</tr>";
}
$conn=null; echo '</table>';
include "footer.php";
?>

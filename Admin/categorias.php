<?php
include("../conexion.php");
include "encabezado.php";
?>

<style>
    /* Estilos para el modal */
    .modal {
        position: fixed; /* Fijar posición */
        top: 50%; /* Alinear verticalmente al centro */
        left: 50%; /* Alinear horizontalmente al centro */
        transform: translate(-50%, -50%); /* Centrar el modal */
        display: none; /* Ocultar inicialmente */
        z-index: 9999; /* Asegurar que esté por encima de otros elementos */
        overflow-y: auto; /* Permitir el scroll vertical si es necesario */
    }

    /* Estilos para el fondo oscuro */
    .modal-backdrop {
        position: fixed; /* Fijar posición */
        top: 0; /* Alinear al tope */
        left: 0; /* Alinear a la izquierda */
        width: 100%; /* Ancho completo */
        height: 100%; /* Altura completa */
        background-color: rgba(0, 0, 0, 0.5); /* Color de fondo semi-transparente */
        z-index: 9998; /* Asegurar que esté por debajo del modal pero por encima de otros elementos */
    }
</style>

<div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="altaCat.php" method="POST" enctype="multipart/form-data">
        <div class="container">
            <h1>Añadir un nuevo plato</h1>
            <hr>
            <div class="mb-3">
                <label class="form-label" for="cat"><b>Nombre del plato</b></label>
                <input class="form-control" type="text" placeholder="Escribe el nombre del plato" name="cat" required>
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
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
                <button type="submit" class="signup">Crear plato</button>
            </div>
        </div>
    </form>
</div>
<!-- Fin Añadir Plato -->

<div class="d-flex justify-content-between m-1">
    <h2>Menú de platos</h2>
    <button type="button" class="btn btn-success btn-lg" style="width:auto" onclick="document.getElementById(&quot;id01&quot;).style.display=&quot;block&quot;">Nuevo platillo +</button>
</div>
<?php
echo '
<hr>
<table class="table">
<tr>
<th>PLATO</th>
<th>IMAGEN</th>
<th>DESCRIPCIÓN</th>
<th>MODIFICAR</th>
<th>ELIMINAR</th>
</tr>';

// Consulta para obtener todos los platos
$stmtPlatos = $conn->prepare("SELECT * FROM cocina2");
$stmtPlatos->execute();
while($row = $stmtPlatos->fetch(PDO::FETCH_OBJ)){ 
    echo "<td>" . $row->plato . "</td>";
    echo "<td><img src='../" . $row->imagen . "' style='width:70px; height:70px;'></td>";
    echo "<td>" . $row->descripcion . "</td>";
    echo '<td><a class="btn btn-sm" style="width: auto;" href="editCatForm.php?menuId='.$row->menuId.'"><i class="fa-solid fa-file-pen" style="font-size:40px"></i></a></td>';
    echo '<!-- Botón de eliminación -->
    <td>
        <form action="eliminarCat.php" method="POST" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este plato?\');">
            <input type="hidden" name="idDel" value="' . $row->menuId . '">
            <button type="submit" class="btn btn-sm" style="width:auto">
                <i class="fa-solid fa-trash-can" style="font-size:40px"></i>
            </button>
        </form>
    </td>'; 
    echo "</tr>";
}
echo '</table>';
?>
<script src="https://kit.fontawesome.com/9459b47ce8.js" crossorigin="anonymous"></script>

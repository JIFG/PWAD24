<?php
include("../conexion.php");
include "encabezado.php";

$idCat = $_GET['menuId'];

try {
    // Consulta para obtener la categoría específica
    $stmt = $conn->prepare("SELECT * FROM cocina2 WHERE menuId = ?");
    $stmt->execute([$idCat]);

    if ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo '
        <!-- Form Modificar Categoría -->
        <div id="editCat" class="modal" style="display:block;">
            <span onclick="cerrarModal()" class="close" title="Close Modal">&times;</span>
            <form class="modal-content" action="editCat.php" method="POST" enctype="multipart/form-data">
                <div class="container">
                    <h1>Modificar plato ' . htmlspecialchars($row->plato) . '</h1>
                    <hr>
                    <input type="hidden" name="idEdit" value="' . htmlspecialchars($idCat) . '">
                    <div class="mb-3">
                        <label class="form-label" for="catEdit"><b>Nombre del Plato</b></label>
                        <input class="form-control" type="text" placeholder="Escribe el nombre del plato" name="catEdit" id="catEdit" required value="' . htmlspecialchars($row->plato) . '">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="img"><b>Imagen</b></label><br>
                        <img src="../' . htmlspecialchars($row->imagen) . '" id="imgCatEdit" style="width:100px;"><br>
                        <input type="hidden" name="imgNoChange" value="' . htmlspecialchars($row->imagen) . '">
                        <input class="form-control" type="file" name="img" id="imgCatEditSRC">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="desc"><b>Descripción</b></label><br>
                        <textarea class="form-control" name="descEdit" id="descEdit" rows="5">' . htmlspecialchars($row->descripcion) . '</textarea>
                    </div>
                    <div class="clearfix">
                        <button type="button" onclick="cerrarModal()" class="cancelbtn">Cancelar</button>
                        <button type="submit" class="signup">Modificar categoría</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Fin Modificar Categoría -->
        ';
    } else {
        echo "Categoría no encontrada.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

include "footer.php";
$conn = null;
?>

<script>
    function cerrarModal() {
        window.location.href = 'categorias.php'; 
    }
</script>

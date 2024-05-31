<?php
include("../conexion.php");

// Verificar si se recibió un ID para eliminar
if(isset($_POST['idDel'])) {
    // Obtener el ID del parámetro POST
    $idToDelete = $_POST['idDel'];

    // Preparar la consulta para eliminar el registro
    $stmt = $conn->prepare("DELETE FROM cocina2 WHERE menuId = ?");
    $stmt->execute([$idToDelete]);

    header("Location: categorias.php");
    exit();
} else {
    // Si no se recibió un ID válido, redireccionar a alguna página de error
    header("Location: error.php");
    exit();
}
?>

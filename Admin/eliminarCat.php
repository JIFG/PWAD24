<?php
include("../conexion.php");


if(isset($_POST['idDel'])) {
    $idToDelete = $_POST['idDel'];

    $stmt = $conn->prepare("DELETE FROM cocina2 WHERE menuId = ?");
    $stmt->execute([$idToDelete]);

    header("Location: categorias.php");
    exit();
} else {
    header("Location: error.php");
    exit();
}
?>

<?php
include("../conexion.php");


if(isset($_POST["id"])) {
    $id = intval($_POST["id"]);

    $stmt = $conn->prepare("DELETE FROM pedidos_temporales WHERE id = ?");
    $stmt->execute([$id]);


    header("Location: ../interfazCocina.php");
    exit(); 
} else {
    echo "ID del pedido no recibido.";
}

$conn = null;
?>

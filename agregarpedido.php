<?php
session_start();
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["menuId"])) {

    $socioId = $_SESSION['socioId'];

    $menuId = $_POST['menuId'];

    
    try {
        $stmt = $conn->prepare("INSERT INTO pedidos_temporales (socioId, menuId) VALUES (?, ?)");
        $stmt->bindParam(1, $socioId);
        $stmt->bindParam(2, $menuId);
        $stmt->execute();
        header("Location: pedidoRealizado.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>

<?php
session_start();
include('../conexion.php');
$user = $_POST['user'];
$pss = $_POST['pss'];

try {
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email=? AND pss=?");
    $stmt->bindParam(1, $user);
    $stmt->bindParam(2, $pss);
    $stmt->execute();
    while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
        $_SESSION['sessionOn'] = 'si';
        $_SESSION['user'] = $user;
        $_SESSION['pss'] = $pss;
        $_SESSION['socioId'] = $result->socioId;
        header("Location:../cocina.php");
        exit();
    }
    session_destroy();
    $error = "Datos incorrectos";
    echo "<script>alert('" . $error . "'); window.location.href = 'index.php?error=" . urlencode($error) . "';</script>";
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

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

    $userFound = false;

    while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
        $userFound = true;
        $_SESSION['sessionOn'] = 'si';
        $_SESSION['user'] = $user;
        $_SESSION['pss'] = $pss;
        $_SESSION['socioId'] = $result->socioId;
        $_SESSION['tipo'] = $result->tipo;

        if ($result->tipo == 1) {
            header("Location: users.php");
        } elseif ($result->tipo == 2) {
            header("Location: ../cafeteria");
        } elseif ($result->tipo == 3) {
            header("Location: ../Cocina");
        } else {
            header("Location: index.php?error=Tipo de usuario no reconocido");
        }
        exit();
    }

    if (!$userFound) {
        session_destroy();
        $error = "Datos incorrectos";
        echo "<script>alert('" . $error . "'); window.location.href = '../login?error=" . urlencode($error) . "';</script>";

        exit();
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<?php
include "../conexion.php";

try {
    if (isset($_POST["email"]) && isset($_POST["contrasena"]) && isset($_POST["nivel"]) && isset($_POST["socioId"])) {
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];
        $nivel = $_POST["nivel"];
        $socioId = $_POST["socioId"];
        $fechaRegistro = date("Y-m-d");

        $stmt_check_email = $conn->prepare("SELECT COUNT(*) AS count FROM `usuarios` WHERE `email` = ?");
        $stmt_check_email->execute([$email]);
        $email_exists = $stmt_check_email->fetchColumn();

        if ($email_exists) {
            echo "El correo electrónico ya está en uso. Por favor, elige otro.";
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO `usuarios`(`email`, `pss`, `tipo`, `fechaRegistro`, `socioId`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $contrasena);
        $stmt->bindParam(3, $nivel);
        $stmt->bindParam(4, $fechaRegistro);
        $stmt->bindParam(5, $socioId);

        if ($stmt->execute()) {
            header("Location: users.php");
            exit();
        } else {
            header("Location: error_registro.php");
            exit();
        }
    } else {
        header("Location: error_registro.php");
        exit();
    }
} catch (Exception $e) {
    echo "Lo siento, hubo un error inesperado.";
    exit();
}
?>

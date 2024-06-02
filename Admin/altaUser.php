<?php
include "../conexion.php";

try {
    if (isset($_POST["email"]) && isset($_POST["contrasena"]) && isset($_POST["nivel"])) {
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];
        $nivel = $_POST["nivel"];
        $socioId = $_POST["socioId"];
        $fechaRegistro = date("Y-m-d");

        if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "C:/xampp/htdocs/PWAD24/img/usuarios/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $avatarName = $_FILES['avatar']['name'];
            $targetFile = $targetDir . $avatarName;

            if (file_exists($targetFile)) {
                echo "Lo siento, el archivo ya existe.";
                exit();
            }

            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                $avatar = "img/usuarios/" . $avatarName;
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.";
                exit();
            }
        } else {
            $avatar = "";
        }

        $stmt_check_email = $conn->prepare("SELECT COUNT(*) AS count FROM `usuarios` WHERE `email` = ?");
        $stmt_check_email->execute([$email]);
        $email_exists = $stmt_check_email->fetchColumn();

        if ($email_exists) {
            echo "El correo electrónico ya está en uso. Por favor, elige otro.";
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO `usuarios`(`email`, `pss`, `tipo`, `avatar`, `fechaRegistro`, `socioId`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $contrasena);
        $stmt->bindParam(3, $nivel);
        $stmt->bindParam(4, $avatar);
        $stmt->bindParam(5, $fechaRegistro);
        $stmt->bindParam(6, $socioId);

        if ($stmt->execute()) {
            header("Location: users.php");
        } else {
            header("Location: error_registro.php");
        }

        $conn = null;
    } else {
        header("Location: error_registro.php");
    }
} catch (Exception $e) {
    echo "Lo siento, hubo un error inesperado.";
    exit();
}
?>

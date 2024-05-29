<?php
// Incluye el archivo de conexión a la base de datos
include "../conexion.php";

try {
    // Verifica si todos los campos necesarios están presentes en el arreglo $_POST y $_FILES
    if (isset($_POST["email"]) && isset($_POST["contrasena"]) && isset($_POST["nivel"]) && isset($_FILES["avatar"])) {
        // Recibe los datos del formulario de registro
        $email = $_POST["email"];
        $contrasena = password_hash($_POST["contrasena"], PASSWORD_BCRYPT); // Encripta la contraseña
        $nivel = $_POST["nivel"];
        $fechaRegistro = date("Y-m-d"); // Obtiene la fecha actual en formato YYYY-MM-DD
        
        // Manejo del archivo avatar
        $targetDir = "C:/xampp/htdocs/PWAD24/img/usuarios/"; // Directorio donde se guardarán los avatares
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        $targetFile = $targetDir . basename($_FILES["avatar"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Verifica si el archivo es una imagen real
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            echo "El archivo no es una imagen.";
            exit();
        }

        // Verifica si el archivo ya existe
        if (file_exists($targetFile)) {
            $uploadOk = 0;
            echo "Lo siento, el archivo ya existe.";
            exit();
        }

        // Verifica el tamaño del archivo
        if ($_FILES["avatar"]["size"] > 500000) { // 500 KB
            $uploadOk = 0;
            echo "Lo siento, tu archivo es demasiado grande.";
            exit();
        }

        // Permitir ciertos formatos de archivo
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit();
        }

        // Verifica si $uploadOk está establecido en 0 por un error
        if ($uploadOk == 0) {
            echo "Lo siento, tu archivo no fue subido.";
            exit();
        // Si todo está bien, intenta subir el archivo
        } else {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                $avatar = $targetFile;
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.";
                exit();
            }
        }

        // Prepara y ejecuta una consulta para verificar si el correo electrónico ya está en uso
        $stmt_check_email = $conn->prepare("SELECT COUNT(*) AS count FROM `usuarios` WHERE `email` = ?");
        $stmt_check_email->execute([$email]);
        $email_exists = $stmt_check_email->fetchColumn();

        // Verifica si el correo electrónico ya está en uso
        if ($email_exists) {
            echo "El correo electrónico ya está en uso. Por favor, elige otro.";
            exit();
        }

        // Prepara la consulta SQL para insertar los datos en la tabla de usuarios
        $stmt = $conn->prepare("INSERT INTO `usuarios`(`email`, `pss`, `tipo`, `avatar`, `fechaRegistro`) VALUES (?, ?, ?, ?, ?)");

        // Asocia los parámetros con los valores recibidos
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $contrasena);
        $stmt->bindParam(3, $nivel);
        $stmt->bindParam(4, $avatar);
        $stmt->bindParam(5, $fechaRegistro);

        // Ejecuta la consulta y redirige a la página de éxito si la inserción es correcta
        if ($stmt->execute()) {
            header("Location: users.php");
        } else {
            // En caso de error, redirige a una página de error
            header("Location: error_registro.php");
        }

        // Cierra la conexión a la base de datos
        $conn = null;
    } else {
        // En caso de que falten campos, redirige a una página de error
        header("Location: error_registro.php");
    }
} catch (Exception $e) {
    echo "Lo siento, hubo un error inesperado.";
    exit();
}
?>

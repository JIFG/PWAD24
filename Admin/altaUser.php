<?php
// Incluye el archivo de conexión a la base de datos
include "../conexion.php";

try {
    // Verifica si todos los campos necesarios están presentes en el arreglo $_POST y $_FILES
    if (isset($_POST["email"]) && isset($_POST["contrasena"]) && isset($_POST["nivel"])) {
        // Recibe los datos del formulario de registro
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];
        $nivel = $_POST["nivel"];
        $socioId = $_POST["socioId"];
        $fechaRegistro = date("Y-m-d"); // Obtiene la fecha actual en formato YYYY-MM-DD

        // Verifica si se ha seleccionado un archivo de avatar
        if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            // Manejo del archivo avatar
            $targetDir = "C:/xampp/htdocs/PWAD24/img/usuarios/"; // Directorio donde se guardarán los avatares
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $targetFile = $targetDir . basename($_FILES["avatar"]["name"]);

            // Verifica si el archivo ya existe
            if (file_exists($targetFile)) {
                echo "Lo siento, el archivo ya existe.";
                exit();
            }

            // Mueve el archivo de avatar a la carpeta de destino
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
                $avatar = $targetFile;
            } else {
                echo "Lo siento, hubo un error al subir tu archivo.";
                exit();
            }
        } else {
            // Si no se ha seleccionado un archivo de avatar, asigna un valor por defecto o deja el campo vacío
            $avatar = ""; // Puedes asignar aquí una ruta predeterminada si deseas
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
        $stmt = $conn->prepare("INSERT INTO `usuarios`(`email`, `pss`, `tipo`, `avatar`, `fechaRegistro`, `socioId`) VALUES (?, ?, ?, ?, ?, ?)");

        // Asocia los parámetros con los valores recibidos
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $contrasena);
        $stmt->bindParam(3, $nivel);
        $stmt->bindParam(4, $avatar);
        $stmt->bindParam(5, $fechaRegistro);
        $stmt->bindParam(6, $socioId);

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


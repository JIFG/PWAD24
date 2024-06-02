<?php
include "../conexion.php";

// Obtener datos del formulario
$id = $_POST["idEdit"];
$cat = $_POST["catEdit"];
$catPadre = $_POST["catPadreEdit"];
// Verificar si se seleccionó una imagen
if(isset($_FILES["img"]["name"]) && strlen($_FILES["img"]["name"]) > 0) {
    // Si se seleccionó una imagen, establecer la ruta
    $img = "img/catalogo/categorias/" . $_FILES["img"]["name"];
} else {
    // Si no se seleccionó ninguna imagen, mantener la imagen actual
    $img = $_POST["imgNoChange"];
}
$desc = $_POST["descEdit"];

try {
    // Preparar la consulta SQL
    $stmt = $conn->prepare("UPDATE `cocina2` SET `plato`=:plato, `imagen`=:imagen, `descripcion`=:descripcion WHERE menuId=:menuId");
    
    // Vincular parámetros
    $stmt->bindParam(':plato', $cat);
    $stmt->bindParam(':imagen', $img);
    $stmt->bindParam(':descripcion', $desc);
    $stmt->bindParam(':menuId', $id);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Si la actualización fue exitosa, subir la imagen si es necesario
        include("subirImg.php");
        header("Location: categorias.php"); // Redirigir al usuario a la página de categorías
        exit(); // Terminar el script después de redirigir
    } else {
        echo "Error al actualizar la categoría.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

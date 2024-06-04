<?php
include "../conexion.php";

// Obtener datos del formulario
$id = $_POST["idEdit"];
$cat = $_POST["catEdit"];
$catPadre = $_POST["catPadreEdit"];

if(isset($_FILES["img"]["name"]) && strlen($_FILES["img"]["name"]) > 0) {

    $img = "img/Menu/" . $_FILES["img"]["name"];
} else {
    $img = $_POST["imgNoChange"];
}
$desc = $_POST["descEdit"];

try {

    $stmt = $conn->prepare("UPDATE `cocina2` SET `plato`=:plato, `imagen`=:imagen, `descripcion`=:descripcion WHERE menuId=:menuId");
    
    $stmt->bindParam(':plato', $cat);
    $stmt->bindParam(':imagen', $img);
    $stmt->bindParam(':descripcion', $desc);
    $stmt->bindParam(':menuId', $id);
    
    if ($stmt->execute()) {
      
        include("subirImg.php");
        header("Location: categorias.php"); 
        exit(); // Terminar el script después de redirigir
    } else {
        echo "Error al actualizar la categoría.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>

<?php
include "../conexion.php";

$cat = $_POST["cat"];
$catPadre = isset($_POST["catPadre"]) ? $_POST["catPadre"] : null; 
$img = $_FILES['img']['name'] ? "img/Menu/".$_FILES['img']['name'] : "img/Menu/no-image.png";
$desc = $_POST["desc"];

$stmt = $conn->prepare("INSERT INTO `cocina2`(`plato`, `imagen`, `catPadre`, `descripcion`) VALUES (:categoria, :imagen, :catPadre, :descripcion)");
$stmt->bindParam(':categoria', $cat);
$stmt->bindParam(':imagen', $img);
$stmt->bindParam(':catPadre', $catPadre);
$stmt->bindParam(':descripcion', $desc);

if ($stmt->execute()) {

    if ($_FILES['img']['name']) {
        $targetDir = "../img/Menu/";
        $targetFile = $targetDir . basename($_FILES["img"]["name"]);
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
            // La imagen se ha subido correctamente
        } else {
            echo "Error al subir la imagen.";
            exit();
        }
    }

    header("Location: categorias.php");
} else {
    echo "Error al ejecutar la consulta.";
}

$conn = null;
?>

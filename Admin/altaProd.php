<?php
include "../conexion.php";
$prod=$_POST["prod"];
$catPadre=$_POST["cat"];
//$img="img/catalogo/categorias/".$_POST["img"];
$precio=$_POST["precio"];
$desc=$_POST["desc"];
$fechaReg=$_POST["fechaReg"];

$stmt=$conn->prepare("INSERT INTO `productos`(`producto`,  `catId`, `precio`,  `descripcion`, `fechaReg`) VALUES (?, ?, ?, ?, ?)");
$stmt->bindParam(1, $prod);
$stmt->bindParam(2, $catPadre);
$stmt->bindParam(3, $precio);
$stmt->bindParam(4, $desc);
$stmt->bindParam(5, $fechaReg);

if($stmt->execute()){  header("Location: productos.php");
}

$conn=null;
?>


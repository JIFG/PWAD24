<?php
include "../conexion.php";
$id=$_POST["idEdit"];
$cat=$_POST["catEdit"];
$catPadre=$_POST["catPadreEdit"];
$img=isset($_FILES["img"]["name"]) && strlen($_FILES["img"]["name"])>0 ? "img/catalogo/categorias/".$_FILES["img"]["name"] : $_POST["imgNoChange"];
$desc=$_POST["descEdit"];
try {
    $stmt=$conn->prepare("UPDATE `categorias` SET `categoria`='$cat',`imagen`='$img',`catPadre`='$catPadre',`descripcion`='$desc' WHERE id=:id");
    $stmt->bindParam(':id', $id);
    if($stmt->execute()){
        include("subirImg.php");
        header("Location:categorias.php");
    }
} catch (PDOException $e) {
    echo "Error: ".$e->getMessage();
}

$conn=null;
?>

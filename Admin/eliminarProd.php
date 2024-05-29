<?php
include "../conexion.php";
$id=$_POST["idDel"];
 
$stmt=$conn->prepare("DELETE FROM productos WHERE id=$id");

if($stmt->execute()){ header("Location:productos.php");
}

$conn=null;
?>

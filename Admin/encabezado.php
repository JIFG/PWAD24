<?php
include "seguridad.php";
echo '<!DOCTYPE html>
<html lang="es-MX">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administrador de contenidos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://kit.fontawesome.com/9459b47ce8.css" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../css/estilos.css">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<style>
  .btn-salir {
    background-color: #red;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    cursor: pointer;
  }

  .btn-salir:hover {
    background-color: #555;
  }

  .btn-salir a {
    color: #fff;
    text-decoration: none;
  }
</style>
</head>
<body>
<header class="d-flex justify-content-between">
<div class="d-flex">
<img
src="../img/logos/4u.jpeg"
alt="Logotipo del sitio"
id="logotipo"
class="producto"
/>
<div class="topnav" id="myTopnav">
<a href="users.php">Usuarios</a>
<a href="categorias.php">Menu platillos</a>
</a>
</div>
</div>
<div id="botones">
<form action="">
</form>
<div class="d-block" style="margin-top: 10px;">
<button class="btn-salir"><a href="salir.php">Salir</a></button>
<i class="fa-solid fa-user btos"></i>
</div>
</div>
</header>';
?>

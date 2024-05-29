<!DOCTYPE html>
<html lang="es-MX">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar Sesión - Administrador de Contenidos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://kit.fontawesome.com/9459b47ce8.css" crossorigin="anonymous">
<style>
  body {
    background-color: #f5f5f5;
    color: #333;
    font-family: Arial, sans-serif;
  }
  
  header {
    background-color: #fff;
    padding: 10px;
  }
  
  #logotipo {
    width: 100px;
    height: 100px;
  }
  
  main {
    margin: 50px auto;
    padding: 20px;
    max-width: 500px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    font-size: 24px;
    margin-top: 20px;
    color: #333;
  }
  
  .form {
    margin-top: 20px;
    text-align: left;
  }
  
  .form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
  }
  
  .form input[type="email"],
  .form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 16px;
    color: #555;
  }
  
  .button {
    background-color: #17a2b8;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .button:hover {
    background-color: #117a8b;
  }
  
  .button:active {
    background-color: #0a5b68;
  }
</style>
</head>
<body>
<header class="d-flex justify-content-center">
<img src="../img/escudo.png" alt="Logotipo del sitio" id="logotipo" class="producto" />
</header>
<main class="w-75 text-center">
<h1>Iniciar Sesión</h1>
<form action="login.php" method="POST" class="form">
<div class="">
<label for="user">Usuario</label>
<input type="email" name="user">
</div>
<div class="">
<label for="pss">Contraseña</label>
<input type="password" name="pss">
</div>
<div class="">
<input type="reset" value="Cancelar" class="button mx-2">
<input type="submit" value="Iniciar sesión" class="button mx-2">
</div>
</form>
</main>
</body>
</html>

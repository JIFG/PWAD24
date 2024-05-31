<?php 
include "conexion.php";
?>
<!DOCTYPE html>
<html lang="es-MX">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi primer página HTML</title>
  <meta description="Este documento contiene información de bla bla bla" />
  <meta
    keywords="compras, compras en línea, pantalones, blusas, camisetas, playeras, zapatos, tenis"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
    crossorigin="anonymous"
  />
  <link
    href="bootstrap/css/bootstrap.min.css"
    rel="stylesheet"
    type="text/css"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />
  <link
    rel="stylesheet"
    href="https://kit.fontawesome.com/ee425a55ec.css"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" type="text/css" href="css/estilos.css" />
</head>

<body>
  <!-- el comentario -->
  <header class="d-flex justify-content-between">
    <div class="d-flex">
      <img
        src="./img/escudo.png"
        alt="Logotipo del sitio"
        id="logotipo"
        class="producto"
      />
      <div class="topnav" id="myTopnav">
        <a href="index.html" >Home</a>
        <a href="#" class="active">Catálogo</a>
        <a href="contacto.html">Contacto</a>
        <a href="sucursales.html">Sucursales</a>
        <!-- es el botón hamburguesa -->
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
      </div>
    </div>

    <div id="botones">
      <form action="">
        <input type="text" />
        <i class="fa-solid fa-magnifying-glass btos"></i>
      </form>
      <i class="fa-solid fa-user btos"></i>
      <i class="fa-solid fa-cart-shopping btos"></i>
    </div>
  </header>
  <main>
    <!-- Inicio del Section -->
    <h3 class="m-4">Catálogos</h3>

    <section class="d-flex justify-content-between p-4" id="CardsPropios">
      <!-- inicio de carta -->
      <?php
      try {
        $stmt = $conn->prepare("SELECT * FROM cocina2");
        $stmt->execute();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          echo ' <div class="card" style="width: 18rem">
          <img src="' . $result->imagen . '" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title">' . strtoupper($result->categoria) . '</h5>
            <p class="card-text">' . $result->descripcion . '</p>
            <a href="productos.php" class="btn btn-primary">Ver productos</a>
            <a href="#" class="btn btn-link">Más información</a>
          </div>
        </div>';
        }
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      $conn = null;
      ?>
    </section>
    <!-- Final del Section -->
  </main>
  <footer></footer>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"
  ></script>
  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>
  <script
    src="https://kit.fontawesome.com/ee425a55ec.js"
    crossorigin="anonymous"
  ></script>
</body>

</html>
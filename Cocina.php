<?php 
include "conexion.php";
?>
<?php
session_start();

if (!isset($_SESSION['sessionOn']) || $_SESSION['sessionOn'] !== 'si') {
    // La sesión ha caducado o el usuario no ha iniciado sesión
    // Redirigir a la página de inicio de sesión
    header("Location: logincocina.php");
    exit(); // Asegurarse de detener la ejecución del script después de la redirección
}
?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cocina Moderna</title>
    <meta
      name="description"
      content="Página de muestra para una cocina moderna, con colores azul claro y naranja"
    />
    <meta
      name="keywords"
      content="cocina, muebles, electrodomésticos, decoración, utensilios de cocina"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
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
    <style>
      body {
        margin-top: 70px;
        background-color: #f8f9fa;
      }
      header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        height: 70px;
        padding: 0 20px;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
      header img {
        height: 40px;
        margin-right: 10px;
      }
      .topnav {
        display: flex;
        align-items: center;
        width: 100%;
        justify-content: center;
        position: relative;
      }
      .topnav h3 {
        margin: 0;
      }
      .topnav a {
        color: #333;
        text-decoration: none;
        margin-right: 10px;
        font-weight: bold;
      }
      .topnav a:hover {
        color: #17a2b8;
      }
      .topnav a.active {
        color: #17a2b8;
      }
      #botones {
        display: flex;
        align-items: center;
      }
      #botones form {
        margin-right: 10px;
      }
      #botones input[type="text"] {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
      }
      .btos {
        margin-left: 5px;
      }
      .carousel-item img {
        height: 500px;
        object-fit: cover;
      }
      .card {
        width: 18rem;
        margin-bottom: 1.5rem;
      }
      .card-img-top {
        height: 15rem;
        object-fit: cover;
      }
      .card-title {
        font-size: 1.25rem;
        font-weight: bold;
      }
      .card-text {
        font-size: 0.875rem;
      }
      .btn-primary {
        background-color: #17a2b8;
        border: none;
      }
      .btn-link {
        color: #17a2b8;
      }
      @media screen and (max-width: 600px) {
        .topnav {
          flex-direction: column;
          align-items: flex-start;
          position: relative;
        }
        .topnav a {
          margin-right: 0;
          margin-bottom: 5px;
        }
        .icon {
          position: absolute;
          right: 0;
          top: 0;
        }
        .topnav.responsive {
          display: block;
        }
        .topnav h3 {
          text-align: center;
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
  <?php

// Verificar si el usuario ha iniciado sesión
if(isset($_SESSION['sessionOn']) && $_SESSION['sessionOn'] === 'si') {
    echo "Usuario: " . $_SESSION['user'] . "<br>";
    echo "Contraseña: " . $_SESSION['pss'] . "<br>";
    echo "ID de Socio: " . $_SESSION['socioId'] . "<br>";
} else {
    echo "No has iniciado sesión.";
}
?>
    <header>
      <div class="d-flex align-items-center">
        <img
          src="./img/Cocina/logococina.jpeg"
          alt="Logotipo del sitio"
          id="logotipo"
          class="producto"
        />
      </div>
      <div class="topnav" id="myTopnav">
        <h3>Cafetería</h3>
        <h3>Socio ID: <?php echo $_SESSION['socioId']; ?></h3>
      </div>
    </header>

    <main>
      <!-- Inicio del carrusel -->
      <div
        id="carouselExampleCaptions"
        class="carousel slide"
        data-bs-ride="carousel"
      >
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              src="img/Cocina/cena1.jpg"
              class="d-block w-100"
              alt="Cocina moderna"
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>Cocina Moderna</h5>
              <p>Diseños innovadores y funcionales para tu hogar.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="img/Cocina/pollofeliz.jpg"
              class="d-block w-100"
              alt="Electrodomésticos"
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>Electrodomésticos</h5>
              <p>Última tecnología para facilitar tu vida.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img
              src="img/Cocina/pollofeliz.jpg"
              class="d-block w-100"
              alt="Decoración"
            />
            <div class="carousel-caption d-none d-md-block">
              <h5>Decoración</h5>
              <p>Estilos únicos que transforman tu cocina.</p>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
      </div>
      <!-- Fin del carrusel -->

      <section class="d-flex justify-content-between p-4" id="CardsPropios">
      <?php
      try {
        $stmt = $conn->prepare("SELECT * FROM cocina2");
        $stmt->execute();

        while ($result = $stmt->fetch(PDO::FETCH_OBJ)) {
          echo '<div class="card" style="width: 18rem">
    <img src="' . $result->imagen . '" class="card-img-top" alt="..." />
    <div class="card-body">
        <h5 class="card-title">' . strtoupper($result->categoria) . '</h5>
        <p class="card-text">' . $result->descripcion . '</p>
        <a href="#" onclick="document.getElementById(\'pedidoForm\').submit()" class="btn btn-primary">Pedir</a>

        <form id="pedidoForm" action="agregarpedido.php" method="post" style="display: none;">
            <input type="hidden" name="menuId" value="' . $result->menuId . '">
        </form>
    </div>
</div>';
        }
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      $conn = null;
      ?>
        </section>
      </div>
      <!-- Fin del Section de Catálogos -->
    </main>

    <footer class="bg-dark text-white text-center py-3">
      <p>&copy; Cocina.</p>
      <div class="d-flex align-items-center">
        <img
          src="./img/Cocina/arbol.jpeg"
          alt="Logotipo del sitio"
          id="logotipo"
          class="producto"
        />
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script>
      function myFunction() {
        var x = document.getElementById("myTopnav")
        if (x.className === "topnav") {
          x.className += " responsive"
        } else {
          x.className = "topnav"
        }
      }
    </script>
    <script
      src="https://kit.fontawesome.com/ee425a55ec.js"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

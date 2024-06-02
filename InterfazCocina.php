<?php 
include "conexion.php";
include "admin/seguridad.php";
if (!isset($_SESSION['tipo']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 3)) {
    header("Location: acceso_no_autorizado.php");
    exit();
}
include "admin/footer.php";
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz de Cocina</title>
    <meta name="description" content="Interfaz para visualizar pedidos en una cocina">
    <meta name="keywords" content="cocina, pedidos, base de datos, entregas, diseño de interfaz">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/ee425a55ec.css" crossorigin="anonymous">
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
        }
        .topnav h3 {
            margin: 0;
            text-align: center;
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
        .card {
            width: 18rem;
            margin-bottom: 1.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 1rem;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .card-text {
            font-size: 0.875rem;
            color: #555;
        }
        .btn-primary {
            background-color: #17a2b8;
            border: none;
        }
        .btn-primary:hover {
            background-color: #117a8b;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #bb2d3b;
        }
        @media screen and (max-width: 600px) {
            .topnav {
                flex-direction: column;
                align-items: flex-start;
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
    <header class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="./img/logos/4u.jpeg" alt="Logotipo del sitio" id="logotipo" class="producto" />
        </div>
        <div class="topnav" id="myTopnav">
            <h3>Pedidos en Cocina</h3>
        </div>
        <button class="btn-salir"><a href="admin/salir.php">Salir</a></button>
    </header>

    <main class="container mt-5" style="margin-top: 100px;">
    <div class="row">
        <?php
        try {
            
            $stmt = $conn->prepare("SELECT pt.id, pt.socioId, pt.menuId, pt.fecha_pedido, pt.entregado, c2.descripcion 
                                    FROM Pedidos_Temporales pt 
                                    INNER JOIN Cocina2 c2 ON pt.menuId = c2.menuId");
            $stmt->execute(); 

           
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pedido Socio # ' . $result['socioId'] . '</h5>
                            <p class="card-text">Descripción: ' . $result['descripcion'] . '</p>
                            <p class="card-text">Entregado: ' . ($result['entregado'] ? 'Sí' : 'No') . '</p>
                            <form method="POST" action="admin/eliminarpedido.php" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este pedido?\');">
                                <input type="hidden" name="id" value="' . $result['id'] . '">
                                <button type="submit" class="btn btn-success btn-sm">Entregar</button>
                            </form>
                        </div>
                    </div>
                </div>
                ';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</main>

    <script>
        function recargarPagina() {
            setTimeout(function() {
                location.reload(true); 
            }, 60000);
        }
        recargarPagina();
    </script>
</body>
</html>

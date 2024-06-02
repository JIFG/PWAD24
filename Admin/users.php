<?php
include("../conexion.php");
include "encabezado.php";

// Verificar si el usuario tiene credenciales de administrador
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
    // Si no es un administrador, redirigir a una página de acceso no autorizado
    header("Location: acceso_no_autorizado.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_eliminar'])) {
    $id_usuario = $_POST['id_usuario'];

    // Obtener la ruta de la imagen del usuario
    $stmt_get_avatar = $conn->prepare("SELECT avatar FROM usuarios WHERE id = ?");
    $stmt_get_avatar->execute([$id_usuario]);
    $row = $stmt_get_avatar->fetch(PDO::FETCH_ASSOC);
    $avatar_path = "../" . $row['avatar'];

    // Eliminar la imagen del usuario si existe
    if (file_exists($avatar_path)) {
        unlink($avatar_path);
    }

    // Preparar y ejecutar la consulta para eliminar el usuario
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id_usuario]);

    // Redirigir a la página actual para actualizar la lista de usuarios
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Función para obtener el nombre del nivel de usuario
function obtenerNombreNivel($tipo) {
    $niveles = array(
        1 => "Administrador",
        2 => "Usuario",
        3 => "Cocinero"
    );
    return $niveles[$tipo];
}

?>
<style>
    .avatar-image {
        width: 50px; 
        height: 50px; 
        border-radius: 50%; 
        object-fit: cover; 
    }
</style>
<br>
<h1>ADMINISTRADOR DE USUARIOS</h1>
<hr>

<table class="table">
    <tr>
        <th>USUARIO/EMAIL</th>
        <th>CONTRASEÑA</th>
        <th>NIVEL</th>
        <th>AVATAR</th>
        <th>FECHA DE REGISTRO</th>
        <th>MODIFICAR</th>
        <th>ELIMINAR</th>
    </tr>
    <?php

    $stmt = $conn->prepare("SELECT * FROM usuarios");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
        echo "<tr>";
        echo "<td>" . $row->email . "</td>";
        echo "<td><i class='fa-solid fa-file-pen' style='font-size: 40px'></i></td>";
        echo "<td>" . obtenerNombreNivel($row->tipo) . "</td>";
        // Corregir la ruta de la imagen del avatar para que sea relativa
        echo "<td><img src='../" . $row->avatar . "' class='avatar-image'></td>";
        echo "<td>" . $row->fechaRegistro . "</td>";
        echo "<td><a href='editar_usuario.php?id=" . $row->id . "'><i class='fa-solid fa-edit' style='font-size: 20px'></i> Editar</a></td>";
        echo "<td>
                <form method='POST' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\");'>
                    <input type='hidden' name='id_usuario' value='" . $row->id . "'>
                    <button type='submit' name='confirmar_eliminar' class='btn btn-danger'>
                        <i class='fa-solid fa-trash-can' style='font-size: 20px'></i> Eliminar
                    </button>
                </form>
              </td>";
        echo "</tr>";
    }
    $conn = null;
    ?>
</table>
<button onclick="document.getElementById('altaUsuario').style.display='block'" type="button">Agregar Usuario</button>

<div id="altaUsuario" class="modal">
    <span onclick="document.getElementById('altaUsuario').style.display='none'" class="close" title="Close">&times;</span>
    <form class="modal-content" action="altaUser.php" method="POST" enctype="multipart/form-data">
        <div class="container">
            <h1>Agregar Nuevo Usuario</h1>
            <hr>
            <div class="mb-3">
                <label class="form-label" for="email"><b>Email</b></label>
                <input class="form-control" type="email" placeholder="Email" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="socioId"><b>Socio ID</b></label>
                <input class="form-control" type="text" placeholder="socioId" name="socioId" required>
            </div>
            <div
            class="mb-3">
                <label class="form-label" for="contrasena"><b>Contraseña</b></label>
                <input class="form-control" type="password" placeholder="Contraseña" name="contrasena" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="nivel"><b>Nivel</b></label>
                <select class="form-control" name="nivel" required>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                    <option value="3">Cocinero</option>
                </select>
            </div>
            <div
            class="mb-3">
                <label class="form-label" for="avatar"><b>Avatar</b></label>
                <input class="form-control" type="file" name="avatar">
            </div>
            <div class="clearfix">
                <button type="button" onclick="document.getElementById('altaUsuario').style.display='none'" class="cancelbtn">Cancelar</button>
                <button type="submit" class="signup">Agregar Usuario</button>
            </div>
        </div>
    </form>
</div>
<script src="https://kit.fontawesome.com/9459b47ce8.js" crossorigin="anonymous"></script>

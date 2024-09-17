<?php
include("../conexion.php");
include "encabezado.php";

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 1) {
    // Si no es un administrador, redirigir a una página de acceso no autorizado
    header("Location: acceso_no_autorizado.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar_usuario'])) {
    $id_usuario = $_POST['id_usuario'];
    $email = $_POST['email'];
    $nivel = $_POST['nivel'];
    $socioId = $_POST['socioId'];
    $contrasena = $_POST['contrasena'];

    // Si la contraseña no está vacía, actualiza también la contraseña
    if (!empty($contrasena)) {
        $stmt = $conn->prepare("UPDATE usuarios SET email = ?, tipo = ?, socioId = ?, pss = ? WHERE id = ?");
        $stmt->execute([$email, $nivel, $socioId, $contrasena, $id_usuario]);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET email = ?, tipo = ?, socioId = ? WHERE id = ?");
        $stmt->execute([$email, $nivel, $socioId, $id_usuario]);
    }

    // Redirige a la página de usuarios para actualizar la lista
    header("Location: users.php");
    exit();
}

// Obtiene el ID del usuario a editar
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id_usuario]);
    $usuario = $stmt->fetch(PDO::FETCH_OBJ);
} else {
    header("Location: users.php");
    exit();
}

?>

<h1>Editar Usuario</h1>
<hr>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="id_usuario" value="<?php echo $usuario->id; ?>">
    <div class="mb-3">
        <label class="form-label" for="email"><b>Email</b></label>
        <input class="form-control" type="email" placeholder="Email" name="email" value="<?php echo $usuario->email; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="socioId"><b>Socio ID</b></label>
        <input class="form-control" type="text" placeholder="Socio ID" name="socioId" value="<?php echo $usuario->socioId; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="nivel"><b>Nivel</b></label>
        <select class="form-control" name="nivel" required>
            <option value="1" <?php if ($usuario->tipo == 1) echo "selected"; ?>>Administrador</option>
            <option value="2" <?php if ($usuario->tipo == 2) echo "selected"; ?>>Usuario</option>
            <option value="3" <?php if ($usuario->tipo == 3) echo "selected"; ?>>Cocinero</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label" for="contrasena"><b>Contraseña</b> (déjelo en blanco si no desea cambiarla)</label>
        <input class="form-control" type="password" placeholder="Contraseña" name="contrasena">
    </div>
    <div class="clearfix">
        <button type="submit" name="editar_usuario" class="signup">Guardar Cambios</button>
        <button href="users.php" class="btn btn-danger">Cancelar</button>
    </div>
</form>

<?php
?>

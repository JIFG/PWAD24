<?php
session_start();
if ($_SESSION["sessionOn"] != "si") {
    echo "<script>
        alert('Debes iniciar sesión para ver esta página');
        window.location.href = '../loginCocina.php';
    </script>";
    exit;
}
?>

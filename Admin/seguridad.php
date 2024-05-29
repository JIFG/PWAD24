<?php
session_start();
if ($_SESSION["sessionOn"] != "si") {
        $error = "Debes iniciar sesión para ver esta página";
        echo "<script>alert('" . $error . "'); window.location.href = 'index.php?error=" . urlencode($error) . "';</script>";
        exit;
}
?>
<?php
session_start();

// Verificar si el usuario está autenticado con PHP
if (!isset($_SESSION['user_id']) && !isset($_SESSION['google_user'])) {
    header("Location: /popeyeia/sesion/login.php"); // Redirigir al usuario al formulario de inicio de sesión si no está autenticado
    exit();
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
?>
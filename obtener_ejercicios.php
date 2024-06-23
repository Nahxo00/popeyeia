<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "popeye";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
    $sql = "SELECT nombre, descripcion, video_url FROM ejercicios WHERE categoria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $categoria);
    $stmt->execute();
    $result = $stmt->get_result();

    $ejercicios = [];
    while ($row = $result->fetch_assoc()) {
        $ejercicios[] = $row;
    }

    $stmt->close();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($ejercicios);
}
?>

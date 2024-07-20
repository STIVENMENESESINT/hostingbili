<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['usuario_nombre'];
    $apellido = $_POST['usuario_apellido'];
    $usuario = $_POST['usuario_usuario'];
    $email = $_POST['usuario_email'];
    $clave1 = $_POST['usuario_clave_1'];
    $clave2 = $_POST['usuario_clave_2'];

    if ($clave1 !== $clave2) {
        echo "Las claves no coinciden.";
        exit;
    }

    // Verificar si el usuario ya existe
    $sql_check = "SELECT usuario FROM users WHERE usuario = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $usuario);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "El nombre de usuario ya existe. Por favor, elija otro.";
        $stmt_check->close();
        $conn->close();
        exit;
    }

    // Insertar el nuevo usuario
    $sql_insert = "INSERT INTO users (nombre, apellido, usuario, email, clave) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $hashed_password = password_hash($clave1, PASSWORD_DEFAULT); // Hashear la contraseña
    $stmt_insert->bind_param("sssss", $nombre, $apellido, $usuario, $email, $hashed_password);

    if ($stmt_insert->execute()) {
        echo "Nuevo usuario registrado correctamente.";
    } else {
        echo "Error: " . $stmt_insert->error;
    }

    $stmt_insert->close();
}

$conn->close();
?>

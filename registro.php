<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['Usuario'];
    $correo = $_POST['Correo'];
    $contrasena = $_POST['Contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    if ($contrasena != $confirmar_contrasena) {
        die("Las contraseñas no coinciden");
    }

    // Hash de la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO Usuarios (Usuario, Correo, Contrasena) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $correo, $hashed_password);

    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

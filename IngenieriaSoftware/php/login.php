<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'proyecto_ing_soft');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT idUsuario, email, clave FROM usuario WHERE email = ? AND clave = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $idUsuario = $row['idUsuario'];
        header("Location: /IngenieriaSoftware/homeauthenticated.php?idUser=$idUsuario");
        exit;
    } else {
        echo "Correo o contraseña incorrectos.";
    }

    $stmt->close();
    $conn->close();
} else {
    die("Los campos email y password no fueron enviados.");
}
?>





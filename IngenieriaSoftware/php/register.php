<?php
    $idUsuario = $_POST['idUsuario'];
    $firstname = $_POST['name'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $locality = $_POST['locality'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $fullName = $firstname . " " . $lastName;
    $fullAddress = $address . " " . $locality;
    $idCargo = 2;
    $puntosAcumulados = 0;

    $conn = new mysqli('localhost', 'root', '', 'proyecto_ing_soft');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    $sql = $conn->prepare("INSERT INTO usuario (idUsuario, nombre, direccion, telefono, email, puntosAcumulados, idCargo, clave) VALUES (?,?,?,?,?,?,?,?)");
    $sql->bind_param("issssiis", $idUsuario, $fullName, $fullAddress, $phoneNumber, $email, $puntosAcumulados, $idCargo, $password);

    if ($sql->execute()) {
        header("Location: /IngenieriaSoftware/homeauthenticated.php?idUser=$idUsuario");
        exit;
    } else {
        header("Location: /IngenieriaSoftware/registro.html");
        exit;
    }

    $sql->close();
    $conn->close();
    
?>





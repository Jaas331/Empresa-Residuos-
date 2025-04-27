<?php
// Inicializar las variables
$day_dangerous = null;
$input_day_inorganic = null;
$conn = connectDB();
if (isset($_GET['idUser'])) {
    $idUser = $_GET['idUser'];
}
$idProgramacion = getProgramacionId($conn,$idUser);

    $day_dangerous = $_POST['day-dangerous'];
    $input_day_inorganic = $_POST['input-day-inorganic'] ?? [];// Array en el POST        //Actualización de dias de residuos inorgánicos
    if(count($input_day_inorganic) == 0){
        $stmt = $conn->prepare("UPDATE programacion_usuario 
                                JOIN usuario ON programacion_usuario.idProgramacion = usuario.idProgramacion 
                                SET diaSemanaInorganicos1 = NULL, diaSemanaInorganicos2 = NULL 
                                WHERE programacion_usuario.idProgramacion = ?");
        $stmt->bind_param("i", $idProgramacion);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }elseif(count($input_day_inorganic) == 1){
        $stmt = $conn->prepare("UPDATE programacion_usuario 
                                JOIN usuario ON programacion_usuario.idProgramacion = usuario.idProgramacion 
                                SET diaSemanaInorganicos1 = ?, diaSemanaInorganicos2 = NULL 
                                WHERE programacion_usuario.idProgramacion = ?");
        $stmt->bind_param("si", $input_day_inorganic[0],$idProgramacion);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }elseif (count($input_day_inorganic) == 2){
        $stmt = $conn->prepare("UPDATE programacion_usuario 
                                JOIN usuario ON programacion_usuario.idProgramacion = usuario.idProgramacion 
                                SET diaSemanaInorganicos1 = ?, diaSemanaInorganicos2 = ? 
                                WHERE programacion_usuario.idProgramacion = ?");
        $stmt->bind_param("ssi", $input_day_inorganic[0],$input_day_inorganic[1],$idProgramacion);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    }
    //Actualización de dias de residuos peligrosos
    $stmt = $conn->prepare("UPDATE programacion_usuario 
                            JOIN usuario ON programacion_usuario.idProgramacion = usuario.idProgramacion 
                            SET diaMesPeligrosos = ?
                            WHERE programacion_usuario.idProgramacion = ?");
    $stmt->bind_param("si", $day_dangerous,$idProgramacion);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    header("Location: /IngenieriaSoftware/homeauthenticated.php?idUser=$idUser");
 
function getProgramacionId($conn, $idUser) {
    // Verificar que el usuario ID esté definido
    if (!isset($idUser)) {
        return null; // Retorna nulo si no se proporciona un ID de usuario
    }

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("SELECT idProgramacion FROM usuario WHERE idUsuario = ?");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    
    $stmt->bind_param("i", $idUser);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Obtener el valor de idProgramacion
    $idProgramacion = null;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idProgramacion = $row['idProgramacion'];
    }

    // Cerrar el statement y retornar el valor
    $stmt->close();
    return $idProgramacion;
}

function connectDB() {
    $conn = new mysqli('localhost', 'root', '', 'proyecto_ing_soft');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }
    return $conn;
}

?>

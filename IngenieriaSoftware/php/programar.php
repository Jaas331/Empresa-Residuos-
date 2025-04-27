<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/programarstyles.css">
    <title>Document</title>
    <script src="../js/main.js"></script>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav>
            <div class="nav-bar">
                <span class="logo">
                    <a href="home.html">
                        <img src="../assets/trash-bin_17668000 4.svg" alt="logo_empresa">
                    </a>
                </span>

                <div class="menu">
                    <ul class="nav-links">
                        <li><a href="../home.html">Inicio</a></li>
                        <li><a href="../nosotros.html">Sobre nosotros</a></li>
                        <li><a href="../contactanos.html">Contáctanos</a></li>
                    </ul>
                </div>

                <div class="action-button">
                    <?php
                        function connectDB() {
                            $conn = new mysqli('localhost', 'root', '', 'proyecto_ing_soft');
                            if ($conn->connect_error) {
                                die('Connection Failed: ' . $conn->connect_error);
                            }
                            return $conn;
                        }

                        $conn = connectDB();
                        $organic = null;
                        $inorganic = null;
                        $organic = null;
                        if (isset($_GET['idUser'])) {
                            $idUser = $_GET['idUser'];
                                
                            $stmt = $conn->prepare("SELECT idUsuario,idCargo FROM usuario WHERE idUsuario = ?");
                            $stmt->bind_param("i", $idUser);
                            $stmt->execute();
                            $result = $stmt->get_result();


                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc(); // Almacena la fila para uso posterior
                            }

                            
                            if ($row['idCargo'] == 2) {
                                echo "<a href='programar.php?idUser={$row['idUsuario']}'><button>Programar</button></a>";
                            } elseif ($row['idCargo'] == 3) {
                                echo "<a href='recoleccion.php?idUser={$row['idUsuario']}'><button>Nueva recolección</button></a>";
                            }

                            $stmt->close();
                        } 
                    ?>
                    

                </div>
            </div>
        </nav>
    </header>
    <main>
            <section class="section-organic">
                <div class="title-icon">
                    <img src="../assets/waste1.svg"> 
                    <h2>Residuos orgánicos</h2>
                </div>
                <div class="text-container">
                    <p>Los residuos orgánicos son aquellos desperdicios que se producen en el hogar como: piel de frutas, espinas de pescado, hojas secas, troncos, ramas, entre otros.</p>
                    <p>Día de recolección para la localidad de <strong>Chapinero:</strong></p>
                    <div class="colection-day-organic">

<?php
                        if (isset($_GET['idUser'])) {
                            $idUser = $_GET['idUser'];
                                
                            $stmt = $conn->prepare("SELECT usuario.idUsuario, usuario.idCargo, programacion_usuario.diaSemanaOrganicos, programacion_usuario.diaSemanaInorganicos1, programacion_usuario.diaSemanaInorganicos2, programacion_usuario.diaMesPeligrosos FROM usuario INNER JOIN programacion_usuario ON usuario.idProgramacion = programacion_usuario.idProgramacion WHERE usuario.idUsuario = ?;");
                            $stmt->bind_param("i", $idUser);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $rowresiduos = $result->fetch_assoc(); // Almacena la fila para uso posterior
                            }

                            echo "<p><strong>$rowresiduos[diaSemanaOrganicos]</strong></p>";

                            $stmt->close();
                        } 
?>
                        
                    </div>
                    <p>¿Cambiaste de dirección? Modifica tu localidad <a href="#">aquí</a></p>
                </div>
            </section>

            <section class="section-inorganic">
                    <div class="title-icon">
                        <img src="../assets/recycled-material.svg">
                        <h2>Residuos inorgánicos reciclables</h2>
                    </div>
                    <div class="text-container">
                        <p>Por medio de la gestión de residuos podemos reciclar y reutilizar residuos inorgánicos como: papel, cartón, vidrio, plástico y metales no contaminados.</p>
                        <p>Días de recolección:</p> 
                    </div>
                    <h1>Gestión de Objetos</h1>

                    <!-- Contenedor de los objetos -->
                    <div id="objects-container-inorganic">
                        <?php
                        if (isset($rowresiduos["diaSemanaInorganicos1"]) && !empty($rowresiduos["diaSemanaInorganicos1"])) {
                            echo ("
                                <div class='object-card'>
                                    <span contenteditable='true' name='span-day-inorganic'>{$rowresiduos['diaSemanaInorganicos1']}</span>
                                    <input type='hidden' id='input-day-inorganic' name='input-day-inorganic' value='{$rowresiduos['diaSemanaInorganicos1']}'>
                                    <button class='remove-btn' onclick='removeObject(this)'>x</button>
                                </div>
                            ");
                        }

                        if (!empty($rowresiduos["diaSemanaInorganicos2"])) {
                            echo ("
                            <div class='object-card'>
                                <span contenteditable='true' name='span-day-inorganic'>{$rowresiduos['diaSemanaInorganicos2']}</span>
                                <input type='hidden' id='input-day-inorganic' name='input-day-inorganic' value='{$rowresiduos['diaSemanaInorganicos2']}'>
                                <button class='remove-btn' onclick='removeObject(this)'>x</button>
                            </div>
                                ");
                        }
                        ?>
                    </div>

                    <!-- Botón para agregar -->
                    <button class="add-btn" onclick="addObject()">+</button>

            </section>

            <section class="section-dangerous">
            <?php
                if (isset($_GET['idUser'])) {
                    $idUser = $_GET['idUser'];
                    echo "<form method='POST' id='main-form' action='postprogramar.php?idUser={$row['idUsuario']}'>";
                }
            ?>
            <form method="POST" id="main-form" action="postprogramar.php">
                <div class="title-icon">
                    <img src="../assets/container.svg">
                    <h2>Residuos peligrosos</h2>
                </div>
                <div class="text-container">
                    <p>Los residuos peligrosos son aquellos que, por su composición, podrían representar algún riesgo. Ejemplos: baterías, pilas, aceites usados.</p>
                    <p>Día del mes de recolección: 
                        <strong>
                        <?php
                            if (!empty($rowresiduos["diaMesPeligrosos"])) {
                                echo ("
                                    <span id='editable-span-dangerous' contenteditable='true'>$rowresiduos[diaMesPeligrosos]</span>
                                ");
                            }
                        ?>
                        </strong>
                        <!-- Campo oculto para enviar el valor -->
                        <input type="hidden" id="hidden-input-dangerous" name="day-dangerous">
                    </p>
                </div>
                <button class="save-btn" type="submit">Guardar</button>
            </form>

        </section>

    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
</head>
<body>
    <img src="assets/bgHome.jpg" class="background">
    <!-- Header -->
    <header class="header">
        <nav>
            <div class="nav-bar">
                <span class="logo">
                    <a href="home.html">
                        <img src="assets/trash-bin_17668000 4.svg" alt="logo_empresa">
                    </a>
                </span>

                <div class="menu">
                    <ul class="nav-links">
                        <li><a href="home.html">Inicio</a></li>
                        <li><a href="nosotros.html">Sobre nosotros</a></li>
                        <li><a href="contactanos.html">Contáctanos</a></li>
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
                        if (isset($_GET['idUser'])) {
                            $idUser = $_GET['idUser'];
                                
                            $stmt = $conn->prepare("SELECT idUsuario,idCargo FROM usuario WHERE idUsuario = ?");
                            $stmt->bind_param("i", $idUser);
                            $stmt->execute();
                            $result = $stmt->get_result();


                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc(); // Almacena la fila para uso posterior
                            }

                            if ($row['idCargo'] == 1) {
                                echo "<a href='php/adminusuariosregistrados.php?idUser={$row['idUsuario']}'><button>Reporte usuarios registrados</button></a>";
                            }elseif ($row['idCargo'] == 2) {
                                echo "<a href='php/programar.php?idUser={$row['idUsuario']}'><button>Programar</button></a>";
                            } elseif ($row['idCargo'] == 3) {
                                echo "<a href='php/recoleccion.php?idUser={$row['idUsuario']}'><button>Nueva recolección</button></a>";
                            }

                            $stmt->close();
                        } 
                    ?>
                    

                </div>
            </div>
        </nav>
    </header>
    <script src="js/main.js"></script>
    <section class="medium-screen">
        <h1>Sistema de recolección de basuras privado</h1>
        <?php
            if ($row['idCargo'] == 1) {
                echo "<a href='php/adminusuariosregistrados.php?idUser={$row['idUsuario']}'><button>Reporte usuarios registrados</button></a>";
            }elseif ($row['idCargo'] == 2) {
                echo "<a href='php/programar.php?idUser={$row['idUsuario']}'><button>Programar</button></a>";
            } elseif ($row['idCargo'] == 3) {
                echo "<a href='php/recoleccion.php?idUser={$row['idUsuario']}'><button>Nueva recolección</button></a>";
            }
        ?>
    </section>
</body>
</html>
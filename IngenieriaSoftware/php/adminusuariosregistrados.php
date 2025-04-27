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

                            if ($row['idCargo'] == 1) {
                                echo "<a href='adminusuariosregistrados.php?idUser={$row['idUsuario']}'><button>Reporte usuarios registrados</button></a>";
                            }if ($row['idCargo'] == 2) {
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
        <h1> Usuarios registrados</h1>
        <table id="user-table">
            <thread>
                <th> ID Usuario </td>
                <th> ID Usuario </td>
                <th> ID Usuario </td>
                <th> ID Usuario </td>
            </thread>
            <tbody>
                <tr>
                    <td>101</td>
                    <td>101</td>
                    <td>101</td>
                    <td>101</td>
                </tr> 
            </tbody>                            

    </main>
</body>
</html>
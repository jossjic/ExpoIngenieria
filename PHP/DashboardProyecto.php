<?php
    require_once "dataBase.php";

    session_name("EngineerXpoWeb");
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        header("Location: ../index.php");
    }


    // POST METHOD
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $project_name_error = null;
        $project_pass_error = null;
        
        $project_name = $_POST['project_name'];
        $project_pass = $_POST['project_pass'];

        $valid = true;

        if (empty($project_name)) {
            $project_name_error = 'Por favor ingresa el nombre de tu proyecto';
            $valid = false;
        }

        if (empty($project_pass)) {
            $project_pass_error = 'Por favor ingresa la contraseña de tu proyecto';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $sql = "SELECT * FROM PROYECTO WHERE p_nombre = ? AND p_pass = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($project_name, $project_pass));
            
            if ($q->rowCount() == 1) {

                $project = $q->fetch(PDO::FETCH_ASSOC);
                
                $_SESSION['logged_in'] = true;

                $_SESSION['user_type'] = "project";
                $_SESSION['id'] = $project['p_id'];
                $_SESSION['name'] = $project['p_nombre'];

                header("Location: ../HTML/DashboardProyecto.html");

            } else if ($q->rowCount() == 0) {
                $p1Error = 'El nombre o contraseña que ingresaste no están asociados a un proyecto.';
                $valid = false;
            }

            Database::disconnect();
            //header("Location: ../HTML/InicioSesionJurado.html");
            exit(); // se debe incluir un exit() después de una redirección con header()
        }
    }

    // GET METHOD
    else {

    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard proyecto| EngineerXpoWeb</title>

        <link rel="stylesheet" href="../CSS/HeaderFooterStructure.css">
        <link rel="stylesheet" href="../CSS/Dashboards.css">
    </head>
    <body>
        <header>
            <img class="Logo__EscNegCie" src="../media/logotec-ings.svg" alt="Logotipo de la Escuela de Ingeniería y Ciencias">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Layout de proyectos</a></li>
            </ul>
            <nav>
                <ul>
                    <li><a href="../PHP/logout.php">Cerrar Sesion</a></li>
                </ul>
            </nav>
        </header>

        <main class="Proyect__View">
            <div class="Action__Btn">
                <h1>Estado de tú proyecto</h1>
                <h3>Calificado</h3>
            </div>

            <div class="Counter">
                <p>ExpoIngenieria comienza en:</p>
                <h1>10:24:45:60</h1>
            </div>

            <div class="Info__Other">
                <div class="Info__Tittle">
                    <h2>Nombre tú proyecto</h2>

                    <div class="Proyect__Edit">
                        <a href="#">Editar</a>
                    </div>
                </div>

                <div class="Info__Menu">


                    <div>
                        <h1>Descripcion</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita facere repellat fugit asperiores cupiditate, nulla accusantium rerum eum nobis molestias tempore aperiam nam quaerat aspernatur aut minima et fugiat cum?</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, mollitia, quo error enim commodi ipsa perspiciatis nostrum eum deserunt qui, exercitationem beatae eaque voluptatibus eos? Consequuntur eius explicabo magnam possimus.</p>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Obcaecati non rerum cum rem minima corporis, soluta veniam qui vero similique ducimus. Voluptates, voluptas officia molestias alias similique laboriosam aspernatur culpa!</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente est alias dolores id, maxime amet nobis veritatis, temporibus magni neque reprehenderit. Voluptate magni placeat quos ducimus earum nostrum repudiandae vitae!</p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti culpa debitis ab voluptatum aspernatur, ea harum praesentium eos, quis a voluptatem commodi sit, quaerat distinctio eius rerum veritatis cumque! Quod.
                        Culpa quo possimus consectetur quisquam suscipit. Rerum vel commodi, sequi, quo sapiente accusamus magnam harum corporis quidem facilis exercitationem ullam deserunt est, reiciendis velit tempore! Quos, consequuntur itaque. Optio, deserunt.
                        Perferendis hic explicabo sit quo amet exercitationem nostrum quibusdam, ab aspernatur unde ad quam dicta et distinctio ipsa quidem temporibus ut at soluta tempora, ipsam beatae accusamus dolor illum! Fugit.
                        Eos, suscipit, perferendis unde excepturi architecto tempora consequuntur dicta quos eligendi deleniti voluptatem repellat, pariatur magni exercitationem! Facilis, aperiam labore! Magni minima doloremque neque aperiam dignissimos explicabo dolor harum odio!
                    </div>

                </div>
            </div>

            <div class="Messages__Menu">
                <div class="Messages__Tittle">
                    <h1>Avisos</h1>
                </div>
                <div class="Messages">
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                    <div>
                        <h1>Titulo</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, enim voluptas obcaecati voluptatum debitis provident nulla nesciunt, quam, repellendus a ad? Nihil impedit eius adipisci in voluptates, dolorum nemo soluta.</p>
                        <br>
                    </div>
                </div>
            </div>
        </main>

    </body>
</html>
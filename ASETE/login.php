<?php
    // session_start();

    require "internacionalizacion.php";

    if(isset($_SESSION["usuario"])) {
        header("Location: index.php");
    }

    // $idioma = $_GET["idioma"];
    // //echo $idioma;

    // $fichero = "$idioma.php";
    // //echo $fichero

    // require $fichero;

    $usuarios_validos = [
        "pelayo" => "pelayo", 
        "admin" => "1234"
    ];

    $usuario = $_POST["usuario"] ?? "";
    $contraseña = $_POST["contraseña"] ?? "";
    //$usuarios_validos["pelayo"] = pelayo
    $error = "";


    if(isset($usuarios_validos[$usuario]) 
        && $usuarios_validos[$usuario] == $contraseña) {
            $_SESSION["usuario"] = $usuario;
            header("Location: index.php");
    } else {
        if(!empty($usuario)) 
            $error = "Usuario o contraseña incorrectos";
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-image: url("/fondo.jpg");
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        .container {
            background: white;
            padding: 2.5em;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            width: 340px;
            position: relative;
            text-align: center;
        }

        h2 {
            margin-bottom: 1em;
            color: #2c3e50;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }

        label {
            text-align: left;
            font-weight: bold;
        }

        input {
            padding: 0.6em;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1em;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.8em;
            border-radius: 6px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }

        p.error {
            color: red;
            margin-top: 0.5em;
        }

        /* Estilo del selector de idioma */
        .idioma {
            margin-top: 1em;
            font-size: 0.9em;
        }

        .idioma a {
            color: #3498db;
            text-decoration: none;
            margin: 0 6px;
            font-weight: bold;
        }

        .idioma a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="POST">
            <h2><?= $traducciones["isesion"] ?></h2>
            <label><?= $traducciones["usuario"] ?>:</label>
            <input type="text" name="usuario" required>

            <label><?= $traducciones["contraseña"] ?>:</label>
            <input type="password" name="contraseña" required>

            <button type="submit"><?= $traducciones["entrar"] ?></button>

            <?php if ($error): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
        </form> 
        <div class="idioma">
            <p><?= $traducciones["idactual"] ?>: <?php echo $traducciones["language"]; ?>:</p>
            <a href="?lang=es">Español</a>
            <a href="?lang=en">English</a>
        </div>
    </div>
</body>
</html>




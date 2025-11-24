<?php
session_start();

require "internacionalizacion.php";

// --- Comprobación de sesión ---
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// --- Inicializar array de películas si no existe ---
if (!isset($_SESSION["peliculas"])) {
    $_SESSION["peliculas"] = [
        ["titulo" => "El editor de libros", "año" => 2016, "director" => "Michael Grandage", "actores" => "Colin Firth, Jude Law, Nicole Kidman", "genero" => "Biografía"],
        ["titulo" => "Un amor entre dos mundos", "año" => 2012, "director" => "Juan Diego Solanas", "actores" => "Jim Sturgess, Kirsten Dunst, Timothy Spall", "genero" => "Ciencia ficción"],
        ["titulo" => "Una cuestión de tiempo", "año" => 2013, "director" => "Richard Curtis", "actores" => "Domhnall Gleeson, Rachel McAdams, Bill Nighy", "genero" => "Romance"],
        ["titulo" => "El indomable Will Hunting", "año" => 1997, "director" => "Gus Van Sant", "actores" => "Matt Damon, Robin Williams, Ben Affleck", "genero" => "Drama"],
        ["titulo" => "Descubriendo a Forrester", "año" => 2000, "director" => "Gus Van Sant", "actores" => "Sean Connery, Rob Brown, F. Murray Abraham, Anna Paquin", "genero" => "Drama"],
        ["titulo" => "El club de los poetas muertos", "año" => 1989, "director" => "Peter Weir", "actores" => "Robin Williams, Robert Sean Leonard, Ethan Hawke, Josh Charles", "genero" => "Drama"],
        ["titulo" => "Gattaca", "año" => 1997, "director" => "Andrew Niccol", "actores" => "Ethan Hawke, Uma Thurman, Jude Law, Loren Dean", "genero" => "Ciencia ficción"],
        ["titulo" => "In Time", "año" => 2011, "director" => "Andrew Niccol", "actores" => "Justin Timberlake, Amanda Seyfried, Vincent Kartheiser", "genero" => "Ciencia ficción"],
        ["titulo" => "Una mente maravillosa", "año" => 2001, "director" => "Ron Howard", "actores" => "Russell Crowe, Ed Harris, Jennifer Connelly", "genero" => "Biografía"],
        ["titulo" => "Big Fish", "año" => 2003, "director" => "Tim Burton", "actores" => "Ewan McGregor, Albert Finney, Billy Crudup, Jessica Lange", "genero" => "Drama"],
        ["titulo" => "El club de la lucha", "año" => 1999, "director" => "David Fincher", "actores" => "Edward Norton, Brad Pitt, Helena Bonham Carter", "genero" => "Thriller"],
        ["titulo" => "Eduardo Manostijeras", "año" => 1990, "director" => "Tim Burton", "actores" => "Johnny Depp, Winona Ryder, Dianne Wiest", "genero" => "Fantasía"]
    ];
}

$mensaje = "";
$error = "";

// --- Procesar formulario ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = trim($_POST["titulo"] ?? "");
    $anio = trim($_POST["anio"] ?? "");
    $director = trim($_POST["director"] ?? "");
    $genero = trim($_POST["genero"] ?? "");

    if ($titulo === "" || $anio === "" || $director === "" || $genero === "") {
        $error = "⚠️ Todos los campos son obligatorios.";
    } else {
        // Crear nueva película
        $nueva_peli = [
            "titulo" => $titulo,
            "año" => (int)$anio,
            "director" => $director,
            "actores" => "",
            "genero" => $genero
        ];

        // Añadirla al array en sesión
        $_SESSION["peliculas"][] = $nueva_peli;
        $mensaje = "✅ Película añadida correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir nueva película</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            margin: 0;
            
        }
        main {
            width: 80%;
            max-width: 600px;
            margin: 2em auto;
            background-color: white;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 0.5em;
            margin-top: 0.3em;
            margin-bottom: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.6em 1.2em;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
        .mensaje {
            text-align: center;
            margin-top: 1em;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .exito {
            color: green;
        }
    </style>
</head>
<body>
    <header>
        <h1><?= $traducciones["nPelicula"]?></h1>
        <div>
            <?= $traducciones["language"] ?>: 
            <a href="?lang=es">ES</a> | 
            <a href="?lang=en">EN</a> &nbsp;  
            <label><?= $traducciones["usuario"] ?>: <?= htmlspecialchars($_SESSION["usuario"]) ?> |
            <a href="logout.php" style="color:#e74c3c; margin-left:1em;"><?= $traducciones["csesion"] ?></a>
        </div>
    </header>
    <main>
        <form method="POST">
            <label for="titulo"><?= $traducciones["titulo"]?>:</label>
            <input type="text" name="titulo" id="titulo">

            <label for="anio"><?= $traducciones["anio"]?>:</label>
            <input type="number" name="anio" id="anio">

            <label for="director"><?= $traducciones["director"]?>:</label>
            <input type="text" name="director" id="director">

            <label for="genero"><?= $traducciones["genero"]?>:</label>
            <select name="genero" id="genero">
                <option value="">-- <?= $traducciones["select"]?> --</option>
                <option value="Drama">Drama</option>
                <option value="Ciencia ficción">Ciencia ficción</option>
                <option value="Fantasía">Fantasía</option>
                <option value="Romance">Romance</option>
                <option value="Thriller">Thriller</option>
                <option value="Biografía">Biografía</option>
            </select>

            <button type="submit"><?= $traducciones["aniaPeli"] ?></button>
        </form>

        <?php if ($error): ?>
            <p class="mensaje error"><?= $error ?></p>
        <?php elseif ($mensaje): ?>
            <p class="mensaje exito"><?= $mensaje ?></p>
        <?php endif; ?>

        <p style="text-align:center; margin-top:1em;">
            <a href="catalogo.php">← <?= $traducciones["vCatalogo"] ?></a>
        </p>
    </main>
</body>
</html>

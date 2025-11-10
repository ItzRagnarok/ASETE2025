<?php
session_start();

require "internacionalizacion.php"; 

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
    
// Recuperar filtros guardados en sesión (si los hay)
$genero = $_SESSION["filtros"]["genero"] ?? "";
$anio = $_SESSION["filtros"]["anio"] ?? "";
$director = $_SESSION["filtros"]["director"] ?? "";
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $traducciones["title"] ?? "Catálogo de Películas" ?></title>
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
            padding: 1em 2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 80px); /* Centra verticalmente */
        }

        .formulario {
            width: 100%;
            max-width: 400px; /* 🔹 Reduce el ancho */
            background-color: white;
            padding: 2em;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            gap: 1.2em;
        }

        label {
            font-weight: bold;
            margin-bottom: 0.3em;
            display: block;
        }

        select, input[type="number"], input[type="text"], button {
            width: 100%;
            padding: 0.6em;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: bold;
            margin-top: 0.5em;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .idioma a {
            color: white;
            font-weight: bold;
            margin-left: 10px;
        }

    </style>
</head>
<body>
    <header>
        <h1><?= $traducciones["title"] ?? "Filtrar Películas" ?></h1>

        <div>
            <?= $traducciones["language"] ?>: 
            <a href="?lang=es">ES</a> | 
            <a href="?lang=en">EN</a> &nbsp;  
            <label><?= $traducciones["usuario"] ?>: <?= htmlspecialchars($_SESSION["usuario"]) ?> |
            <a href="logout.php" style="color:#e74c3c;"><?= $traducciones["csesion"] ?? "Cerrar sesión" ?></a>
        </div>
    </header>

    <main>
    <form action="catalogo.php" method="GET" class="formulario">
        <div>
            <label for="genero"><?= $traducciones["genero"] ?? "Género" ?>:</label>
            <select name="genero" id="genero">
                <option value="">-- <?= $traducciones["todos"] ?? "Todos" ?> --</option>
                <option value="Drama" <?= $genero === "Drama" ? "selected" : "" ?>>Drama</option>
                <option value="Ciencia ficción" <?= $genero === "Ciencia ficción" ? "selected" : "" ?>>Ciencia ficción</option>
                <option value="Fantasía" <?= $genero === "Fantasía" ? "selected" : "" ?>>Fantasía</option>
                <option value="Romance" <?= $genero === "Romance" ? "selected" : "" ?>>Romance</option>
                <option value="Thriller" <?= $genero === "Thriller" ? "selected" : "" ?>>Thriller</option>
                <option value="Biografía" <?= $genero === "Biografía" ? "selected" : "" ?>>Biografía</option>
            </select>
        </div>

        <div>
            <label for="anio"><?= $traducciones["anio"] ?? "Año" ?>:</label>
            <input type="number" name="anio" id="anio" value="<?= htmlspecialchars($anio) ?>" placeholder="2020">
        </div>

        <div>
            <label for="director"><?= $traducciones["director"] ?? "Director" ?>:</label>
            <input type="text" name="director" id="director" value="<?= htmlspecialchars($director) ?>" placeholder="Nombre o parte del nombre">
        </div>

        <button type="submit"><?= $traducciones["buscar"] ?? "Buscar" ?></button>
    </form>
</main>

</body>
</html>

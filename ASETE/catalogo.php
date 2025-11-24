<?php

session_start();

require "internacionalizacion.php";
require_once "pelicula.php"

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
if (!isset($_SESSION["peliculas"])) {
    $_SESSION["peliculas"] = [
    new Pelicula("El editor de libros", 2016, "Michael Grandage", "Colin Firth, Jude Law, Nicole Kidman", "Biografía"),
    new Pelicula("Un amor entre dos mundos", 2012, "Juan Diego Solanas", "Jim Sturgess, Kirsten Dunst, Timothy Spall", "Ciencia ficción"),
    new Pelicula("Una cuestión de tiempo", 2013, "Richard Curtis", "Domhnall Gleeson, Rachel McAdams, Bill Nighy", "Romance"),
    ["titulo" => "El indomable Will Hunting", "año" => 1997, "director" => "Gus Van Sant", "actores" => "Matt Damon, Robin Williams, Ben Affleck", "genero" => "Drama"],
    ["titulo" => "Descubriendo a Forrester", "año" => 2000, "director" => "Gus Van Sant", "actores" => "Sean Connery, Rob Brown, F. Murray Abraham, Anna Paquin", "genero" => "Drama"],
    ["titulo" => "El club de los poetas muertos", "año" => 1989, "director" => "Peter Weir", "actores" => "Robin Williams, Robert Sean Leonard, Ethan Hawke, Josh Charles", "genero" => "Drama"],
    ["titulo" => "Gattaca", "año" => 1997, "director" => "Andrew Niccol", "actores" => "Ethan Hawke, Uma Thurman, Jude Law, Loren Dean", "genero" => "Ciencia ficción"],
    ["titulo" => "In Time", "año" => 2011, "director" => "Andrew Niccol", "actores" => "Justin Timberlake, Amanda Seyfried, Vincent Kartheiser", "genero" => "Ciencia ficción"],
    ["titulo" => "Una mente maravillosa", "año" => 2001, "director" => "Ron Howard", "actores" => "Russell Crowe, Ed Harris, Jennifer Connelly", "genero" => "Biografía"],
    ["titulo" => "Big Fish", "año" => 2003, "director" => "Tim Burton", "actores" => "Ewan McGregor, Albert Finney, Billy Crudup, Jessica Lange", "genero" => "Drama"],
    ["titulo" => "El club de la lucha", "año" => 1999, "director" => "David Fincher", "actores" => "Edward Norton, Brad Pitt, Helena Bonham Carter", "genero" => "Thriller"],
    ["titulo" => "Eduardo Manostijeras", "año" => 1990, "director" => "Tim Burton", "actores" => "Johnny Depp, Winona Ryder, Dianne Wiest", "genero" => "Fantasía"],
    new Serie("Peaky blinders", 2012, "Algiuen", "Cilian Murphy", "Drama", 5),
    new Serie("Sons of Anarchy", 2010, "Alguien", "Charlie Hunnan", "Drama", 7)
]; 
}


//if(!isset($_SESSION))

$peliculas = $_SESSION["peliculas"];

$genero = $_GET["genero"] ?? "";
$anio = $_GET["anio"] ?? "";
$director = $_GET["director"] ?? "";

// Guardar filtros en sesión
$_SESSION["filtros"] = [
    "genero" => $genero,
    "anio" => $anio,
    "director" => $director
];

// Filtrado
$resultados = array_filter($peliculas, function ($p) use ($genero, $anio, $director) {
    if ($genero && $p["genero"] !== $genero) return false;
    if ($anio && $p["año"] != $anio) return false;
    if ($director && stripos($p["director"], $director) === false) return false;
    return true;
});
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Películas</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; margin: 0; padding: 0; }
        header { background: #2c3e50; color: white; text-align: center; padding: 1em; }
        main { width: 90%; max-width: 900px; margin: 2em auto; background: white; padding: 2em; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 1em; }
        th, td { border: 1px solid #ddd; padding: 0.8em; text-align: left; }
        th { background-color: #3498db; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .csesion { text-decoration: none; color: #e74c3c; }
        a { text-decoration: none; color: #3498db; }
        a:hover { text-decoration: underline; }
        .top { display: flex; justify-content: space-between; align-items: center; }
        .top h1 {
            margin: 0;
        }
    </style>
</head>
<body>
<header>
    <div class="top">
        <h1><?= $traducciones["catPelis"]?></h1>
        <div style="margin-right:2em;">
            <?= $traducciones["language"] ?>: 
            <a href="?lang=es">ES</a> | 
            <a href="?lang=en">EN</a> &nbsp;  
            <label><?= $traducciones["usuario"] ?>: <?= htmlspecialchars($_SESSION["usuario"]) ?> |
            <a class="csesion" href="logout.php"><?= $traducciones["csesion"] ?></a>
        </div>
    </div>
</header>
<main>
    <p style="text-align:right; margin-bottom:1em;">
    <a href="nueva_pelicula.php" style="background:#27ae60; color:white; padding:0.5em 1em; border-radius:4px; text-decoration:none;">+ <?= $traducciones["nPelicula"]?></a>
</p>

    <?php if (count($resultados) > 0): ?>
        <p><strong><?= count($resultados) ?></strong> resultado(s) encontrado(s).</p>
        <table>
            <tr>
                <th><?= $traducciones["titulo"]?></th>
                <th><?= $traducciones["genero"]?></th>
                <th><?= $traducciones["anio"]?></th>
                <th><?= $traducciones["director"]?></th>
                <th><?= $traducciones["actor"]?></th>
                <th>Temporadas</th>
                
            </tr>
            <?php foreach ($resultados as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p["titulo"]) ?></td>
                    <td><?= htmlspecialchars($p["genero"]) ?></td>
                    <td><?= htmlspecialchars($p["año"]) ?></td>
                    <td><?= htmlspecialchars($p["director"]) ?></td>
                    <td><?= htmlspecialchars($p["actores"]) ?></td>
                    <?php if($pelicula instanceof Serie): ?>
                        <td><?= $pelicula->num_temporadas ?></td>
                    <?php endif; ?> 
                </tr>
                <?php echo $pelicula->toJSON(); ?>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay películas que cumplan los filtros seleccionados.</p>
    <?php endif; ?>

    <a href="index.php">← <?= $traducciones["vfiltrado"]?></a>
</main>
</body>
</html>

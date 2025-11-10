<?php
    session_start();

    $user = $_GET["usuario"] ?? "";
    $pass = $_GET["contraseña"] ?? "";

    $_SESSION["user"] = $user;

    session_unset();
    session_destroy();

    //isset($_GET["usuario"]);

    echo $user . $pass;

    $nombre = "Carlos";

    if($nombre == "Pelayo") {
        echo "Hola Pelayo";

    }else {
        echo "adios";
    }

    //BUCLES    

    $array = ["pedro", "pepe", "sara"];
/*
    for($i = 0; $i < count($array); $i++) {}

    foreach($array as $nombre) {

    }

    //BUCLE ARRAY ASOCIATIVO

    $array2 = [
        "usuario" => "pelayo", 
        "contrasena" => "1234"
    ];

    foreach($array2 as $clave => $valor) {

    }
*/


?>

<html>

    <?php if($nombre == "Pelayo"): ?>
        <h1>Hola <?php echo $nombre ?></h1>
        <p>Parrafo del primer mensaje</p>
    <?php else: ?>
        <h1>Hola <?php echo $nombre ?></h1>
        <p>Parrafo del segundo mensaje</p>
    <?php endif; ?>


    <ul> 
        <?php foreach($array as $nombre): ?>
            <li><?php echo $nombre ?></li>
        <?php endforeach; ?>
    </ul>


    <form action="" method="GET">
        <input type = "text" name="usuario">
        <input type = "password" name="contraseña">
        <input type = "submit">
    </form>
<a hreff="logout.php"> Cerrar sesión</a>
</html>

<?php

    $nombre = "Pelayo";

    $nombre2 = $nombre;

    $nombre2 = "Pepe";

    echo "El nombre es $nombre<br>";
    echo "El nombre es $nombre2<br>";

    $nombre3 = &$nombre;

    $nombre3 = "Pedro";

    echo "El nombre es $nombre<br>";
    echo "El nombre es $nombre3<br>";

    function saludar() {
        global $nombre;
        $nombre = "Juan";
        echo "¡Hola $nombre!<br>";
    }

    saludar();
    //Pasar VARIABLE por Copia
    function saludarParametros($nombre) {
        static $contadror = 0;
        $contadror++;
        echo $contadror;
        $nombre = "No es Carlos";
        echo "¡Hola $nombre!<br>";
    }
    
    $otro_nombre = "Carlos";
    echo "$otro_nombre<br>";
    saludarParametros($otro_nombre);
    echo "$otro_nombre<br>";
    saludarParametros($otro_nombre);

    //Pasar variable por referencia lleva &
    function saludarParametros2(&$nombre) {
        static $contadror = 0;
        $contadror++;
        echo $contadror;
        $nombre = "No es Carlos";
        echo "¡Hola $nombre!<br>";
    }
    
    $otro_nombre = "Carlos";
    echo "$otro_nombre<br>";
    saludarParametros2($otro_nombre);
    echo "$otro_nombre<br>";
    saludarParametros2($otro_nombre);

    include "Asignatura.php";

    $asignatura = new Asignatura("ASETE");

    echo $asignatura->mostrarInfo();

    Asignatura::saludar();


?>
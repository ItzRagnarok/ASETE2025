<?php
	if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    //Recuperamos el idioma por GET
    $lang = $_GET["lang"] ?? "es";

    //Construir archivo
    $file = "lang/$lang.php";

    //Cargar archivo del idioma
    if (file_exists($file)) {
        require $file; //error
        //include $file; //warning
    } else {
        require "lang/es.php";
    }
	


?>
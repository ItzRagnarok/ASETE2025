<?php

    class Asignatura {

        public $nombre;

        public function __construct($nombre){
            $this->nombre = $nombre;
        }

        public function mostrarInfo() {
            return "<p>Asignatura: " . $this->nombre . "</p>";
        }

        public static function saludar() {
            return "<p>Hola otra vez</p>";
        }

    }

?>
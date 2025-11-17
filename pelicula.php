<?php

    require_once "traits.php";

    class Pelicula {

        use Formatear;

        public $titulo;
        public $año;
        public $director;
        public $actores;
        public $genero;

        public function __construct($titulo, $año, $director, $actores, $genero) {
            $this->titulo = $titulo;
            $this->año = $año;
            $this->director = $director;
            $this->actores = $actores;
            $this->genero = $genero;
        }

        public function mostrarPelicula() {
            return "<p>$this->pelicula</p>";
        }

    }

    class Serie extends Pelicula {
        public $num_temporadas;
        public function __construct($titulo, $año, $director, $actores, $genero, $num_temporadas) {
            Pelicula::__construct($titulo, $año, $director, $actores, $genero);
            $this->num_temporadas = $num_temporadas;
        }

        public function mostrarPelicula() {
            return "<p>$this->pelicula de la serie</p>";
        }
    }

?>
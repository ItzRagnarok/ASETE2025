<?php

    trait Formatear {
        public function toHTML() {
            return "<p>$this->titulo</p>";
        }

        public function toJSON() {
            return json_encode($this);
        }
    }

?>
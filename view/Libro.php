<?php
class Libro {
    public $id;
    public $nombre;
    public $autor;
    public $tema;
    public $ISBN;

    public function __construct($nombre, $autor, $tema, $ISBN) {
        $this->nombre = $nombre;
        $this->autor = $autor;
        $this->tema = $tema;
        $this->ISBN = $ISBN;
    }
}
?>

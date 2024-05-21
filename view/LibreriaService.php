<?php
require_once 'conexion.php';
require_once 'Libro.php';

class LibreriaService {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::getConexion();
    }

    public function AgregarLibro(Libro $libro) {
        $sql = "INSERT INTO libro (nombre, autor, tema, ISBN) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $libro->nombre, $libro->autor, $libro->tema, $libro->ISBN);
        return $stmt->execute();
    }

    public function ListarLibros() {
        $sql = "SELECT * FROM libro";
        $result = $this->conn->query($sql);
        $libros = [];
        while ($row = $result->fetch_assoc()) {
            $libros[] = $row;
        }
        return $libros;
    }
    public function EditarLibro(Libro $libro, $id) {
        $sql = "UPDATE libro SET nombre = ?, autor = ?, tema = ?, ISBN = ? WHERE idlibro = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $libro->nombre, $libro->autor, $libro->tema, $libro->ISBN, $id);
        return $stmt->execute();
    }
    public function BuscarLibro($id) {
        $sql = "SELECT * FROM libro WHERE idlibro = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function EliminarLibroPorId($id) {
        $sql = "DELETE FROM libro WHERE idlibro = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>

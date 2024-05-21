<?php
require_once 'LibreriaService.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['id_libro'])) {
        $id_libro_a_eliminar = $_POST['id_libro'];
        $libreriaService = new LibreriaService();

        if ($libreriaService->EliminarLibroPorId($id_libro_a_eliminar)) {
            echo '<div class="alert alert-success" role="alert">El libro se eliminó correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al eliminar el libro.</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">Por favor, proporcione el ID del libro a eliminar.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Eliminar Libro</h1>
        <form action="eliminar_libro.php" method="post">
            <div class="mb-3">
                <label for="id_libro" class="form-label">ID del Libro a Eliminar:</label>
                <input type="text" class="form-control" id="id_libro" name="id_libro" required>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</body>
</html>

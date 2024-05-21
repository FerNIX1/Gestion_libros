<?php
include 'vista.php';
require_once 'LibreriaService.php';

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['id'])) {
    // Verificar si se han enviado todos los campos del formulario
    if (isset($_POST['nombre'], $_POST['autor'], $_POST['tema'], $_POST['ISBN'])) {
        $idLibro = $_GET['id'];
        $libroEditado = new Libro($_POST['nombre'], $_POST['autor'], $_POST['tema'], $_POST['ISBN']);
        $libreriaService = new LibreriaService();
        if ($libreriaService->EditarLibro($libroEditado, $idLibro)) {
            $mensaje = "Libro editado exitosamente";
            // Redireccionar a vista.php
            header("Location: vista.php");
            exit();
        } else {
            $error = "Error al editar el libro";
        }
    } else {
        $error = "Por favor, complete todos los campos del formulario";
    }
}

// Obtener el ID del libro a editar desde la URL
if (isset($_GET['id'])) {
    $idLibro = $_GET['id'];
    $libreriaService = new LibreriaService();
    $libro = $libreriaService->BuscarLibro($idLibro);
    // Verificar si se encontró el libro
    if (!$libro) {
        die("Libro no encontrado");
    }
} else {
    die("ID de libro no proporcionado");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Editar Libro</title>
</head>
<body>

<h1>Editar Libro</h1>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <?php if (isset($mensaje)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $idLibro; ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($libro['nombre']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($libro['autor']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tema" class="form-label">Tema</label>
                    <input type="text" class="form-control" id="tema" name="tema" value="<?php echo htmlspecialchars($libro['tema']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="ISBN" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="ISBN" name="ISBN" value="<?php echo htmlspecialchars($libro['ISBN']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

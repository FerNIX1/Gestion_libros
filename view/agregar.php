<?php
include 'vista.php';
require_once 'LibreriaService.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['nombre'], $_POST['autor'], $_POST['tema'], $_POST['ISBN'])) {
        $nuevoLibro = new Libro($_POST['nombre'], $_POST['autor'], $_POST['tema'], $_POST['ISBN']);
        $libreriaService = new LibreriaService();
        if ($libreriaService->AgregarLibro($nuevoLibro)) {
            $mensaje = "Libro agregado exitosamente";
            header("Location: vista.php");
            exit();
        } else {
            $error = "Error al agregar el libro";
        }
    } else {
        $error = "Por favor, complete todos los campos del formulario";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Agregar Libro</title>
</head>
<body>

<h1>Agregar Nuevo Libro</h1>
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="autor" name="autor" required>
                </div>
                <div class="mb-3">
                    <label for="tema" class="form-label">Tema</label>
                    <select class="form-select" id="tema" name="tema" required>
                        <option value="">Seleccionar Tema</option>
                        <option value="CienciasSociales">Ciencias Sociales</option>
                        <option value="Historia">Historia</option>
                        <option value="Cultura">Cultura</option>
                        <option value="Humanidades">Humanidades</option>
                        <option value="Accion">Acción</option>
                        <option value="Drama">Drama</option>
                        <option value="Terror">Terror</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ISBN" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="ISBN" name="ISBN" required>
                </div>
                <div class="mb-3">
                    <label for="Id_Editorial" class="form-label">Editorial</label>
                    <select class="form-select" id="Id_Editorial" name="Id_Editorial" required>
                        <option value="">Seleccionar Editorial</option>
                        <?php
                        // Realizar la conexión a la base de datos y ejecutar la consulta
                        $conexion = Conexion::getConexion();
                        $query = "SELECT ideditorial, nombre FROM editorial";
                        $result = $conexion->query($query);

                        // Iterar sobre los resultados y crear opciones para el menú desplegable
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['ideditorial']) . '">' . htmlspecialchars($row['nombre']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

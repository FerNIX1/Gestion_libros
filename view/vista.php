<?php




require_once 'conexion.php';


require_once 'Libro.php';


require_once 'LibreriaService.php';


try {
    $dbConnection = Conexion::getConexion();
    echo "Conexión exitosa a la base de datos<br>";
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}


$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$requestUri = str_replace($scriptName, '', $_SERVER['REQUEST_URI']);
$requestUri = trim($requestUri, '/');

$path = explode('/', $requestUri)[0];


if ($path === 'view' || $path === '') {
    $libreriaService = new LibreriaService();
    $libros = $libreriaService->ListarLibros();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Libreria</title>
</head>
<body>
<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid">
    <a href="" class="navbar-brand">Libreria UDB</a>
  </div>
</nav>
<h1>Bienvenido a la libreria UDB</h1>
<h1>Lista de Libros</h1>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Tema</th>
            <th>ISBN</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($libros)): ?>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?php echo htmlspecialchars($libro['idlibro']); ?></td>
                    <td><?php echo htmlspecialchars($libro['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($libro['autor']); ?></td>
                    <td><?php echo htmlspecialchars($libro['tema']); ?></td>
                    <td><?php echo htmlspecialchars($libro['ISBN']); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $libro['idlibro']; ?>" class="btn btn-primary">Editar</a>
                        <a href="eliminar.php?id=<?php echo $libro['idlibro']; ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay libros disponibles</td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6"><a href="agregar.php" class="btn btn-success">Agregar Libro</a></td>
        </tr>
    </tfoot>
</table>
</body>
</html>

<?php
} else {
    echo "Página no encontrada";
}
?>



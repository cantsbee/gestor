<?php
require_once 'funciones.php';

// Filtros
$filtitulo = '';
$filestado = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filtitulo = $_POST["titulo"] ?? '';
    $filestado = $_POST["estado"] ?? '';
}

// Obtener cómics filtrados
$comics = listarComics($filtitulo, $filestado);
?>

<html>
<head>
    <title>Gestión de Cómics</title>
    <script src="funciones.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
// creamos un form para poder llevar a cabo el método post y guardar nuestros cómics
    <form id="frm" name="frm" action="funciones.php" method="post">

        <!-- Campos ocultos para JS -->
        <input type="hidden" id="id" name="id">
        <input type="hidden" id="titulo" name="titulo">
        <input type="hidden" id="autor" name="autor">
        <input type="hidden" id="estado" name="estado">
        <input type="hidden" id="prestado" name="prestado">
        <input type="hidden" id="localizacion" name="localizacion">

        <div id="principal">

            <!-- CABECERA -->
            <div id="cabecera">
                <div>Título</div>
                <div>Autor</div>
                <div>Estado</div>
                <div>Prestado</div>
                <div>Localización</div>
                <div>Acciones</div>
            </div>

            <!-- FILTROS -->
            <div id="filtro">

                <div>
                    <input
                        type="text"
                        id="filTitulo"
                        name="filTitulo"
                        value="<?= htmlspecialchars($filtitulo) ?>"
                        onchange="filtrar()"
                    >
                </div>

                <div>
                    <select id="filEstado" name="filEstado" onchange="filtrar()">
                        <option value=""></option>
                        <option value="pendiente" <?= $filestado === "pendiente" ? "selected" : "" ?>>pendiente</option>
                        <option value="leyendo"   <?= $filestado === "leyendo" ? "selected" : "" ?>>leyendo</option>
                        <option value="leído"     <?= $filestado === "leído" ? "selected" : "" ?>>leído</option>
                    </select>
                </div>

            </div>

            <!-- LISTADO -->
            <div id="listado">

                <?php foreach ($comics as $comic): ?>
                    <div>
                        <input
                            type="text"
                            id="titulo<?= $comic->id ?>"
                            value="<?= htmlspecialchars($comic->titulo) ?>"
                        >
                    </div>

                    <div>
                        <input
                            type="text"
                            id="autor<?= $comic->id ?>"
                            value="<?= htmlspecialchars($comic->autor) ?>"
                        >
                    </div>

                    <div>
                        <select id="estado<?= $comic->id ?>">
                            <option value="pendiente" <?= $comic->estado === "pendiente" ? "selected" : "" ?>>pendiente</option>
                            <option value="leyendo"   <?= $comic->estado === "leyendo" ? "selected" : "" ?>>leyendo</option>
                            <option value="leído"     <?= $comic->estado === "leído" ? "selected" : "" ?>>leído</option>
                        </select>
                    </div>

                    <div>
                        <input
                            type="checkbox"
                            id="prestado<?= $comic->id ?>"
                            <?= $comic->prestado ? "checked" : "" ?>
                        >
                    </div>

                    <div>
                        <select id="localizacion<?= $comic->id ?>">
                            <option value="estanteria1" <?= $comic->localizacion === "estanteria1" ? "selected" : "" ?>>estanteria1</option>
                            <option value="estanteria2" <?= $comic->localizacion === "estanteria2" ? "selected" : "" ?>>estanteria2</option>
                            <option value="mueble"      <?= $comic->localizacion === "mueble" ? "selected" : "" ?>>mueble</option>
                        </select>
                    </div>

                    <!-- BOTONERA -->
                    <div>
                        <input type="button" onclick="anadirFila();" value="ADD">
                        <input type="button" onclick="modificar('<?= $comic->id ?>');" value="MOD">
                        <input type="button" onclick="eliminar('<?= $comic->id ?>');"  value="DEL">
                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </form>
</body>

</html>


<?php

define("FILE_PATH", "comics.json");

/* --------------------------------------------------
   Leer cómics
---------------------------------------------------*/
function leerComics() {
    if (!file_exists(FILE_PATH)) {
        return [];
    }

    $lineas = file(FILE_PATH, FILE_IGNORE_NEW_LINES);
    $comics = [];

    foreach ($lineas as $linea) {
        list($id, $titulo, $autor, $estado, $prestado, $localizacion) = explode(";", $linea);
        $comics[] = [
            "id" => $id,
            "titulo" => $titulo,
            "autor" => $autor,
            "estado" => $estado,
            "prestado" => $prestado === "true",
            "localizacion" => $localizacion
        ];
    }

    return $comics;
}

/* --------------------------------------------------
   Guardar cómics
---------------------------------------------------*/
function guardarComics($comics) {
    $contenido = "";
    foreach ($comics as $c) {
        $contenido .= implode(";", [
            $c["id"],
            $c["titulo"],
            $c["autor"],
            $c["estado"],
            $c["prestado"] ? "true" : "false",
            $c["localizacion"]
        ]) . "\n";
    }
    file_put_contents(FILE_PATH, $contenido);
}

/* --------------------------------------------------
   Agregar cómic
---------------------------------------------------*/
function agregarComic($titulo, $autor, $estado, $prestado, $localizacion) {
    $comics = leerComics();
    $id = count($comics) > 0 ? end($comics)["id"] + 1 : 1;

    $nuevo = [
        "id" => $id,
        "titulo" => $titulo,
        "autor" => $autor,
        "estado" => $estado,
        "prestado" => $prestado,
        "localizacion" => $localizacion
    ];

    $comics[] = $nuevo;
    guardarComics($comics);

    echo "✅ Cómic agregado correctamente<br>";
}
// función para eliminar
   Eliminar

function eliminarComic($id) {
    $comics = leerComics();
    $nuevoArray = [];

    foreach ($comics as $c) {
        if ($c["id"] != $id) {
            $nuevoArray[] = $c;
        }
    }

    guardarComics($nuevoArray);
    echo " Cómic eliminado correctamente<br>";
}

// función q actualiza el estado
   Actualizar estado

function actualizarEstado($id, $nuevoEstado) {
    $comics = leerComics();
    foreach ($comics as &$c) {
        if ($c["id"] == $id) {
            $c["estado"] = $nuevoEstado;
            guardarComics($comics);
            echo "✅ Estado actualizado correctamente<br>";
            return;
        }
    }
    echo "⚠️ Cómic no encontrado<br>";
}
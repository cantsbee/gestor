<?php
// funciones.php — CRUD con JSON

const DB = "comics-data.json";

function leerDB() {
    if (!file_exists(DB)) return [];
    $json = file_get_contents(DB);
    return json_decode($json, true) ?: [];
}

function guardarDB($data) {
    file_put_contents(DB, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$action = $_GET['action'] ?? '';
$data = leerDB();

switch ($action) {
    case 'agregar':
        $nuevo = [
            'id' => time(),
            'titulo' => $_POST['titulo'] ?? '',
            'autor' => $_POST['autor'] ?? '',
            'estado' => $_POST['estado'] ?? '',
            'prestado' => ($_POST['prestado'] ?? 'false') === 'true',
            'localizacion' => $_POST['localizacion'] ?? ''
        ];
        $data[] = $nuevo;
        guardarDB($data);
        break;

    case 'modificar':
        $id = $_POST['id'];
        foreach ($data as &$comic) {
            if ($comic['id'] == $id) {
                $comic['titulo'] = $_POST['titulo'] ?? $comic['titulo'];
                $comic['autor'] = $_POST['autor'] ?? $comic['autor'];
                $comic['estado'] = $_POST['estado'] ?? $comic['estado'];
                $comic['prestado'] = ($_POST['prestado'] ?? 'false') === 'true';
                $comic['localizacion'] = $_POST['localizacion'] ?? $comic['localizacion'];
                break;
            }
        }
        guardarDB($data);
        break;

    case 'eliminar':
        $id = $_POST['id'];
        $data = array_filter($data, fn($c) => $c['id'] != $id);
        guardarDB(array_values($data));
        break;
}

header("Location: index.php");
exit;
?>

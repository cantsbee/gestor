function anadir() {
    let titulo = document.getElementById('titulo0').value;
    let autor = document.getElementById('autor0').value;
    let estado = document.getElementById('estado0').value;
    let prestado = document.getElementById('prestado0').checked ? 1 : 0;
    let localizacion = document.getElementById('localizacion0').value;

    document.getElementById('titulo').value = titulo;
    document.getElementById('autor').value = autor;
    document.getElementById('estado').value = estado;
    document.getElementById('prestado').value = prestado;
    document.getElementById('localizacion').value = localizacion;

    let frm = document.getElementById('frm');
    frm.action = 'funciones.php?action=anadir';
    frm.submit();
}


function anadirFila() {
    let listado = document.getElementById('listado');
    let lhtml = listado.innerHTML;

    let fila = `
        <div><input type="text" id="titulo0" placeholder="Título" /></div>

        <div><input type="text" id="autor0" placeholder="Autor" /></div>

        <div>
            <select id="estado0">
                <option value=""></option>
                <option value="pendiente">pendiente</option>
                <option value="leyendo">leyendo</option>
                <option value="leído">leído</option>
            </select>
        </div>

        <div>
            <input type="checkbox" id="prestado0" />
        </div>

        <div>
            <select id="localizacion0">
                <option value="estanteria1">estanteria1</option>
                <option value="estanteria2">estanteria2</option>
                <option value="mueble">mueble</option>
            </select>
        </div>

        <div>
            <input type="button" onclick="anadir();" value="ADD" />
        </div>
    `;

    listado.innerHTML = lhtml + fila;
}


function modificar(id) {
    console.log("id", id);

    let titulo = document.getElementById('titulo' + id).value;
    let autor = document.getElementById('autor' + id).value;
    let estado = document.getElementById('estado' + id).value;
    let prestado = document.getElementById('prestado' + id).checked ? 1 : 0;
    let localizacion = document.getElementById('localizacion' + id).value;

    document.getElementById('titulo').value = titulo;
    document.getElementById('autor').value = autor;
    document.getElementById('estado').value = estado;
    document.getElementById('prestado').value = prestado;
    document.getElementById('localizacion').value = localizacion;
    document.getElementById('id').value = id;

    let frm = document.getElementById('frm');
    frm.action = 'funciones.php?action=guardar';
    frm.submit();
}


function eliminar(id) {
    let titulo = document.getElementById('titulo' + id).value;
    let salida = confirm(`Va a eliminar el cómic "${titulo}". ¿Desea continuar?`);

    if (salida) {
        document.getElementById('id').value = id;

        let frm = document.getElementById('frm');
        frm.action = 'funciones.php?action=eliminar';
        frm.submit();
    }
}


function filtrar() {
    let titulo = document.getElementById('filTitulo').value;
    let estado = document.getElementById('filEstado').value;

    document.getElementById('titulo').value = titulo;
    document.getElementById('estado').value = estado;

    let frm = document.getElementById('frm');
    frm.action = 'index.php?action=filtrar';
    frm.submit();
}

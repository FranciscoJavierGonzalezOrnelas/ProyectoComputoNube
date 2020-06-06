$(document).ready(function() {

    let editar = false;
    $('#form-productos').trigger('reset');
    mostrarProductos();


    $("#form-productos").on("submit", function(e) {
        e.preventDefault();
        let uri = editar === false ? 'agregarProducto.php' : 'editarProducto.php';
        var frmData = new FormData($('#form-productos')[0]);
        $.ajax({
            data: frmData,
            url: uri,
            type: "POST",
            contentType: false,
            processData: false,
            beforesend: function() {},
            success: function(response) {
                $('#form-productos').trigger('reset');
                mostrarProductos();
                alert(response);
                console.log(response);
            },
        });
        var x;
        x = document.getElementById("imagen");
        x.setAttribute('required', '');
        editar = false;
    });


    function mostrarProductos() {
        $.ajax({
            url: 'visualizarProductos.php',
            type: 'GET',
            success: function(response) {
                const productos = JSON.parse(response);
                let plantilla = '';
                productos.forEach(producto => {
                    plantilla += `
                            <tr productId="${producto.Id}">
                                <td class="id"># ${producto.Id}</td>
                                <td class="tipo">${producto.tipo}</td>
                                <td class="nombre">${producto.nombre}</td>
                                <td class="precio">${producto.precio} MXN</td>
                                <td class="stock">${producto.stock} Pza(s)</td>
                                <td class="descripcion">${producto.descripcion}</td>
                                <td class="row-imagen"><img class="imagen" src="${producto.imagen}"></td>
                                <td>
                                    <button class="btn-edit">
                                        Editar
                                    </button>
                                </td>
                                <td>
                                    <button class="btn-delete">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                            `
                });
                $('#productos').html(plantilla);
            }
        });
    }

    $(document).on('click', '.btn-delete', function() {
        if (confirm('¿Esta Seguro que desea eliminar este producto?')) {
            let elemento = $(this)[0].parentElement.parentElement;
            let id = $(elemento).attr('productId');
            $.post('eliminarProducto.php', { id }, function(response) {
                //console.log(response);
                $('#form-productos').trigger('reset');
                mostrarProductos();
                alert(response);
            });
        }
        editar = false;
    });

    $(document).on('click', '.btn-edit', function(e) {
        var x;
        x = document.getElementById("imagen");
        x.removeAttribute('required');
        let elemento = $(this)[0].parentElement.parentElement;
        let id = $(elemento).attr('productId');
        $.post('obtenerProducto.php', { id }, function(response) {
            const producto = JSON.parse(response);
            $('#Id').val(producto.id);
            $('#tipo').val(producto.tipo);
            $('#nombre').val(producto.nombre);
            $('#precio').val(producto.precio);
            $('#stock').val(producto.stock);
            $('#descripcion').val(producto.descripcion);
            //$('#imagen').val(producto.imagen);
            editar = true;
        });

        e.preventDefault();
    });

    $(document).on('click', '.btn-cancelar', function() {
        var x;
        x = document.getElementById("imagen");
        x.setAttribute('required', '');
        $('#form-productos').trigger('reset');
        editar = false;
    });

});

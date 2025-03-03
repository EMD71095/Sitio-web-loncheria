<?php

$Productos = ControladorProductos::consultaProductosview();



$eliminar = new ControladorProductos;
$eliminar->eliminarProducto();


?>


<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="index.php?seccion=registroProducto" style="margin-bottom: 22px;">Añadir nuevo producto</a>
            <table class="table text-center" id="myTable">
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">ID</th>
                        <th style="text-align: center;" scope="col">Nombre</th>
                        <th style="text-align: center;" scope="col">Descripción</th>
                        <th style="text-align: center;" scope="col">Precio</th>
                        <th style="text-align: center;" scope="col">Categoría</th>
                        <th style="text-align: center;" scope="col">Imagen</th>
                        <th style="text-align: center;" scope="col">Accion</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    foreach ($Productos as $row => $item) {
                        echo '<tr>
                            <th style="text-align: center;" scope="row">' . $item[0] . '</th>
                            <td>' . $item[1] . '</td>
                            <td>' . $item[2] . '</td>
                            <td>' . $item[3] . '</td>
                            <td>' . $item[5] . '</td>
                            <td><img src="' . $item[4] . '" alt="Imagen representativa" height="70"></td>
                            <td>
                            <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="index.php?seccion=editarProducto&idProducto=' . $item[0] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a class="btn btn-danger btn-circle btn-sm" onclick="deleteConfirmation(' . $item[0] . ')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deleteConfirmation(id) {
        swal({
                title: "¿Estás seguro?",
                text: "No volveras a recuperar el producto",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminalo!",
                cancelButtonText: "No, cancelalo!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    console.log(id);
                    window.location.href = "index.php?seccion=Productos&eliminar=1&idProducto=" + id;
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {
                    swal("Cancelado", "El producto esta a salvo :)", "error");
                }
            });
    }


    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
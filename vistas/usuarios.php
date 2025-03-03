<?php
if($_SESSION["rol"] == 0)
{
    $Usuarios = ControladorUsuarios::consultaUsuarios();
}
else{
    $Usuarios = ControladorUsuarios::consultaUsuarios_n();
}



$eliminar = new ControladorUsuarios;  //no array de regreso
$eliminar->eliminarUsuario();



?>



<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="index.php?seccion=registroUsuario" style="margin-bottom: 22px;">Añadir nuevo usuario</a>
            <table class="table text-center" id="myTable">
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">ID</th>
                        <th style="text-align: center;" scope="col">Nombre</th>
                        <th style="text-align: center;" scope="col">Email</th>
                        <th style="text-align: center;" scope="col">Contraseña</th>
                        <th style="text-align: center;" scope="col">Tipo de usuario</th>
                        <th style="text-align: center;" scope="col">Imagen de perfil</th>
                        <th style="text-align: center;" scope="col">Accion</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    foreach ($Usuarios as $row => $item) {
                        echo '<tr>
                            <th style="text-align: center;" scope="row">' . $item[0] . '</th>
                            <td>' . $item[1] . '</td>
                            <td>' . $item[2] . '</td>
                            <td>' . $item[3] . '</td>
                            <td>' . $item[4] . '</td>
                            <td><img src="' . $item[5] . '" alt="Foto de perfil" height="70"></td>
                            <td>
                            <a href="index.php?seccion=detalleUsuarios&idUsuario=' . $item[0] . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="index.php?seccion=editarUsuario&idUsuario=' . $item[0] . '"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a class="btn btn-danger btn-circle btn-sm" onclick="deleteConfirmation('.$item[0].')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>




<!-- <script type="text/javascript">
    function deleteConfirmation(id) {
        swal({
            title: '¿Estas seguro?',
            text: "Esta accion no se podra revertir",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            closeOnConfirm: false,
            closeOnCancel: false,
        },
        function(isConfirm)
        {
            if (isConfirm)
            {
                console.log(id);
                    window.location.href="index.php?seccion=usuarios&eliminar=1&idUsuario="+id;
            }
            else
            {
                swal("Cancelado", "Nadie fue eliminado", "Error");
            }
        });
            
    }
</script> -->

<script type="text/javascript">
    function deleteConfirmation(id)
    {
        swal({
            title: "¿Estás seguro?",
            text: "No volveras a recuperar el usuario",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, eliminalo!",
            cancelButtonText: "No, cancelalo!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
        if (isConfirm) {
            console.log(id);
            window.location.href="index.php?seccion=usuarios&eliminar=1&idUsuario="+id;
            //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelado", "El usuario esta a salvo :)", "error");
        }
        });
    }
</script>
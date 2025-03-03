<?php
    //$nuevo = new ControladorProgramas;//respuestas boleanas
   // $nuevo -> registrarPrograma();
    //invocamos así al metodo cuando esperamos  un array de regreso
    $Categorias = ControladorCategorias::consultaCategorias();//aquiiii va consultar program
   //invocar metodo para eliminar programa
   //así invocamos cuando solo esperemos un booleano
    $eliminar = new ControladorCategorias;
    $eliminar -> eliminarCategoria();

    //var_dump($programas);//respuestas con metadatos

    //$conexion = new Conexion;
    //$conexion -> conectar();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="index.php?seccion=registroCategorias" style="margin-bottom: 22px;">Añadir nueva Categoria</a>
            <table class="table text-center" id="myTable">
                <thead>
                    <tr>
                    <th style="text-align: center;" scope="col">ID</th>
                    <th style="text-align: center;" scope="col">Nombre</th>
                    <th style="text-align: center;" scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($Categorias as $row => $item)
                        {
                            echo '<tr>
                            <th style="text-align: center;" scope="row">'.$item[0].'</th>
                            <td>'.$item[1].'</td>
                            <td>
                            <a href="index.php?seccion=detalleCategoria&idCategoria='.$item[0].'"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="index.php?seccion=editarCategoria&idCategoria='.$item[0].'"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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

<script type="text/javascript">
    function deleteConfirmation(id)
    {
        swal({
            title: "¿Estás seguro?",
            text: "No volveras a recuperar la categoria",
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
            window.location.href="index.php?seccion=categorias&eliminar=1&idCategoria="+id;
            //swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelado", "La categoria esta a salvo :)", "error");
        }
        });
    }
</script>
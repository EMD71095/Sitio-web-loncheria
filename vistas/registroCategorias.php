<?php
$nuevo = new ControladorCategorias; //respuestas boleanas
$nuevo->registrarCategoria();

// $programas = ControladorProgramas::consultaProgramas();//aquiiii va consultar program
// var_dump($programas);//respuestas con metadatos
//$conexion = new Conexion;
//$conexion -> conectar();
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Administración de Categorias</h3>
            <div class="card">
                <div class="card-header">Registrar Categoria</div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre de la Categoria:</label>
                            <input required name="nombre" type="text" class="form-control" id="name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Descripción de la Categoria:</label>
                            <input required name="descripcion" type="text" class="form-control" id="desc" aria-describedby="emailHelp">
                        </div>
                        <button name="nuevo" value="newCustomer" type="submit" class="btn btn-primary" style="margin-top: 22px;">Registrar Categoria</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="preloader-wrapper">
    <div class="preloader">
    </div>
</div>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
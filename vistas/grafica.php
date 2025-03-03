<?php
$ordenes = ControladorOrdenes::consultaordenesview();
$grafica = ControladorOrdenes::grafica();
?>

<style>
    body {
        background-image: url(bg.jpg);
        /* background-size: cover; */
        /* background-repeat: no-repeat; */
    }

    h1 {
        color: white;
        /* position: absolute; */
        bottom: auto;
        /* Coloca el h1 en la parte inferior de la página */
        left: 0;
        /* Alinea el h1 a la izquierda */
        width: 100%;
        /* Ancho completo */
        padding: 20px;
        /* Agrega espacio alrededor del h1 si es necesario */
    }

    .content-row {
        margin-bottom: 20px;
    }

    .vacante-card {
        margin-bottom: 20px;
    }

    .grafica-card {
        margin-top: 5px;
        margin-bottom: 200px;
    }
</style>

<div class="content-row">
    <h4 class="content-row-title text-center">Ordenes realizadas: <?= count($ordenes) ?></h4>
</div>

<div class="container mt-4 mb-4 grafica-card">
    <div class="row v-50 justify-content-center align-items-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Grafica de popularidad</h4>
                </div>
                <div class="card-body">
                    <canvas id="grafica"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Graficas -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = <?php echo json_encode(array_column($grafica, 0)); ?>;
    const dataValues = <?php echo json_encode(array_column($grafica, 1)); ?>;

    const data = {
        labels: labels,
        datasets: [{
            label: 'Productos más cotizados',
            data: dataValues,
            backgroundColor: [
                'rgba(255,99,132, 0.2)',
                'rgba(255,159,64, 0.2)',
                'rgba(255,205,86, 0.2)',
                'rgba(75,192,192, 0.2)',
                'rgba(54,162,235, 0.2)',
                'rgba(153,102,255, 0.2)',
                'rgba(201,203,207, 0.2)'
            ],
            borderColor: [
                'rgb(255,99,132)',
                'rgb(255,159,64)',
                'rgb(255,205,86)',
                'rgb(75,192,192)',
                'rgb(54,162,235)',
                'rgb(153,102,252)',
                'rgb(201,203,202)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    var myChart = new Chart(
        document.getElementById('grafica'),
        config
    );
</script>
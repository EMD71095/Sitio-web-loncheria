<?php
$producto = ControladorProductos::consultaProductosview();
// $part = Modeloproductos::selectproductosgrafica();
// $array = $part->fetch_all();
$ca = new ControladorOrdenes;
$totalOrdenes = $ca->countOrdenes();

$ordenes = ControladorOrdenes::consultaordenesview();
$grafica = ControladorOrdenes::grafica();
// Definir la cantidad de productos por página
$productos_por_pagina = 9;

// Obtener el número total de productos
$total_productos = count($producto);

// Calcular el número total de páginas
$total_paginas = ceil($total_productos / $productos_por_pagina);

// Obtener la página actual de la URL, si no está definida, es la página 1
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

// Asegurarse de que la página actual esté dentro de los límites válidos
if ($pagina_actual < 1) {
    $pagina_actual = 1;
} elseif ($pagina_actual > $total_paginas) {
    $pagina_actual = $total_paginas;
}

$producto_li = ControladorProductos::consultaProductosviewLimit();
?>

<style>
    .btno {
        border: none;
        width: 9em;
        height: 3em;
        border-radius: 2em;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 12px;
        background: #1C1A1C;
        cursor: pointer;
        transition: all 450ms ease-in-out;
    }

    .sparkle {
        fill: #AAAAAA;
        transition: all 800ms ease;
    }

    .text {
        font-weight: 600;
        color: #AAAAAA;
        font-size: medium;
    }

    .btno:hover {
        background: linear-gradient(0deg, #91d47c, #6bb252);
        box-shadow:
            inset 0px 1px 0px 0px rgba(255, 255, 255, 0.4),
            inset 0px -4px 0px 0px rgba(0, 0, 0, 0.2),
            0px 0px 0px 4px rgba(255, 255, 255, 0.2),
            0px 0px 50px 10px rgba(107, 178, 82, 0.7),
            /* Más luz verde */
            0px 0px 180px 20px rgba(107, 178, 82, 0.5);
        /* Halo verde más intenso */
        transform: translateY(-2px);
    }

    .btno:hover .text {
        color: white;
    }

    .btno:hover .sparkle {
        fill: white;
        transform: scale(1.2);
    }
</style>

<div class="content-row">
    <h4 class="content-row-title text-center">Ordenes realizadas: <?= count($ordenes) ?></h4>
</div>
<div class="container mt-4 mb-4 grafica-card">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <!-- Primera tarjeta -->
                <div class="card flex-fill mx-2 h-100">
                    <div class="card-header text-center">
                        <h4>Grafica de popularidad</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="grafica"></canvas>
                    </div>
                </div>
                <!-- Segunda tarjeta -->
                <div class="card flex-fill mx-2 h-200">
                    <div class="card-header text-center">
                        <h4>Total Ordenes</h4>
                    </div>
                    <div class="card-body text-center">
                        <h1 class="display-4"><?= $totalOrdenes ?></h1>
                        <p>Ordenes realizadas hasta ahora.</p>
                        <a href="index.php?seccion=ordenes" class="btn mt-4">
                            <button class="btno">
                                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" class="sparkle">
                                    <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z"></path>
                                </svg>
                                <span class="text">Ordenes</span>
                            </button>
                        </a>
                    </div>
                </div>
                <!-- Tercera tarjeta -->
                <div class="card flex-fill mx-2 h-200">
                    <div class="card-header text-center">
                        <h4>Total Productos</h4>
                    </div>
                    <div class="card-body text-center">
                        <h1 class="display-4"><?= $total_productos ?></h1>
                        <p>Productos disponibles actualmente.</p>
                        <a href="index.php?seccion=productos" class="btn mt-4">
                            <button class="btno">
                                <svg height="24" width="24" fill="#FFFFFF" viewBox="0 0 24 24" data-name="Layer 1" id="Layer_1" class="sparkle">
                                    <path d="M10,21.236,6.755,14.745.264,11.5,6.755,8.255,10,1.764l3.245,6.491L19.736,11.5l-6.491,3.245ZM18,21l1.5,3L21,21l3-1.5L21,18l-1.5-3L18,18l-3,1.5ZM19.333,4.667,20.5,7l1.167-2.333L24,3.5,21.667,2.333,20.5,0,19.333,2.333,17,3.5Z"></path>
                                </svg>
                                <span class="text">Productos</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <h2 class="text-center">Productos</h2>
</div>

<section id="latest-products" class="products-carousel">
    <div class="container-lg overflow-hidden pb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header d-flex justify-content-between my-4">
                    <h2 class="section-title">Nuestros productos</h2>
                    <div class="d-flex align-items-center">
                        <a href="index.php?seccion=productos" class="btn btn-primary me-2">Ver todos</a>
                        <div class="swiper-buttons">
                            <button
                                class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                            <button
                                class="swiper-next products-carousel-next btn btn-primary">❯</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <!-- Aqui empieza -->
                        <?php
                        foreach ($producto as $row => $item) {
                            echo '
                                <div class="product-item swiper-slide">
                            <figure>
                                <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '" title="' . $item[1] . '">
                                    <img src="' . $item[4] . '"
                                        alt="img producto" class="tab-image">
                                </a>
                            </figure>
                            <div class="d-flex flex-column text-center">
                                <h3 class="fs-6 fw-normal">' . $item[1] . '</h3>
                                <div
                                    class="d-flex justify-content-center align-items-center gap-2">
                                    <del>$' . ($item[3] + 15) . '</del>
                                    <span class="text-dark fw-semibold">$' . $item[3] . '</span>
                                    <span
                                        class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">Descuento</span>
                                </div>
                                <div class="button-area p-3 pt-0">
                                        <div class="row g-1 mt-2">
                                            <div class="col-3">
                                                <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '" class="btn btn-outline-dark rounded-1 p-2 fs-6">
                                                    <i class="fas fa-heart" style="font-size: 15px;"></i>
                                                </a>
                                            </div>
                                            <div class="col-7">
                                                <a href="index.php?seccion=editarProducto&idProducto=' . $item[0] . '" class="btn btn-primary rounded-1 p-2 fs-7 btn-cart">Editar</a>
                                            </div>
                                            <div class="col-2">
                                                <a href="index.php?seccion=detalleProducto&idProducto=' . $item[0] . '" class="btn btn-outline-dark rounded-1 p-2 fs-6">
                                                    <i class="fas fa-star" style="font-size: 15px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
</section>

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

<div class="preloader-wrapper">
    <div class="preloader">
    </div>
</div>

<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
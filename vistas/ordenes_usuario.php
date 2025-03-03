<?php
$ordenes = ControladorOrdenes::consultaOrdenesUsuario();

?>

<style>
    /* From Uiverse.io by vinodjangid07 */
    .Documents-btn {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: fit-content;
        height: 45px;
        border: none;
        padding: 0px 15px;
        border-radius: 5px;
        background-color: rgb(49, 49, 83);
        gap: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .folderContainer {
        width: 40px;
        height: fit-content;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        position: relative;
    }

    .fileBack {
        z-index: 1;
        width: 80%;
        height: auto;
    }

    .filePage {
        width: 50%;
        height: auto;
        position: absolute;
        z-index: 2;
        transition: all 0.3s ease-out;
    }

    .fileFront {
        width: 85%;
        height: auto;
        position: absolute;
        z-index: 3;
        opacity: 0.95;
        transform-origin: bottom;
        transition: all 0.3s ease-out;
    }

    .text {
        color: white;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .Documents-btn:hover .filePage {
        transform: translateY(-5px);
    }

    .Documents-btn:hover {
        background-color: rgb(58, 58, 94);
    }

    .Documents-btn:active {
        transform: scale(0.95);
    }

    .Documents-btn:hover .fileFront {
        transform: rotateX(30deg);
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="index.php?seccion=inicio" style="margin-bottom: 22px;">¡Seguir comprando!</a>
            <table class="table text-center" id="myTable">
                <thead>
                    <tr>
                        <th style="text-align: center;" scope="col">ID</th>
                        <th style="text-align: center;" scope="col">Fecha</th>
                        <th style="text-align: center;" scope="col">Total</th>
                        <th style="text-align: center;" scope="col">Estado</th>
                        <th style="text-align: center;" scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($ordenes as $row => $item) {
                        echo '<tr>
                            <th style="text-align: center;" scope="row">' . $item[0] . '</th>
                            <td class="text-center">' . $item[2] . '</td>
                            <td class="text-center">$' . $item[3] . '</td>
                            <td class="text-center">' . $item[6] . '</td>
                            <td>';
                        if ($item[6] == "Pendiente") {
                            echo ' <a class="btn  text-center" href="pdf.php?id_orden=' . $item[0] . '&id_usuario=' . $_SESSION["id"] . '" target="new">
                                <button class="Documents-btn">
                                    <span class="folderContainer">
                                        <svg
                                        class="fileBack"
                                        width="146"
                                        height="113"
                                        viewBox="0 0 146 113"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <path
                                            d="M0 4C0 1.79086 1.79086 0 4 0H50.3802C51.8285 0 53.2056 0.627965 54.1553 1.72142L64.3303 13.4371C65.2799 14.5306 66.657 15.1585 68.1053 15.1585H141.509C143.718 15.1585 145.509 16.9494 145.509 19.1585V109C145.509 111.209 143.718 113 141.509 113H3.99999C1.79085 113 0 111.209 0 109V4Z"
                                            fill="url(#paint0_linear_117_4)"
                                        ></path>
                                        <defs>
                                            <linearGradient
                                            id="paint0_linear_117_4"
                                            x1="0"
                                            y1="0"
                                            x2="72.93"
                                            y2="95.4804"
                                            gradientUnits="userSpaceOnUse"
                                            >
                                            <stop stop-color="#8F88C2"></stop>
                                            <stop offset="1" stop-color="#5C52A2"></stop>
                                            </linearGradient>
                                        </defs>
                                        </svg>
                                        <svg
                                        class="filePage"
                                        width="88"
                                        height="99"
                                        viewBox="0 0 88 99"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <rect width="88" height="99" fill="url(#paint0_linear_117_6)"></rect>
                                        <defs>
                                            <linearGradient
                                            id="paint0_linear_117_6"
                                            x1="0"
                                            y1="0"
                                            x2="81"
                                            y2="160.5"
                                            gradientUnits="userSpaceOnUse"
                                            >
                                            <stop stop-color="white"></stop>
                                            <stop offset="1" stop-color="#686868"></stop>
                                            </linearGradient>
                                        </defs>
                                        </svg>

                                        <svg
                                        class="fileFront"
                                        width="160"
                                        height="79"
                                        viewBox="0 0 160 79"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        >
                                        <path
                                            d="M0.29306 12.2478C0.133905 9.38186 2.41499 6.97059 5.28537 6.97059H30.419H58.1902C59.5751 6.97059 60.9288 6.55982 62.0802 5.79025L68.977 1.18034C70.1283 0.410771 71.482 0 72.8669 0H77H155.462C157.87 0 159.733 2.1129 159.43 4.50232L150.443 75.5023C150.19 77.5013 148.489 79 146.474 79H7.78403C5.66106 79 3.9079 77.3415 3.79019 75.2218L0.29306 12.2478Z"
                                            fill="url(#paint0_linear_117_5)"
                                        ></path>
                                        <defs>
                                            <linearGradient
                                            id="paint0_linear_117_5"
                                            x1="38.7619"
                                            y1="8.71323"
                                            x2="66.9106"
                                            y2="82.8317"
                                            gradientUnits="userSpaceOnUse"
                                            >
                                            <stop stop-color="#C3BBFF"></stop>
                                            <stop offset="1" stop-color="#51469A"></stop>
                                            </linearGradient>
                                        </defs>
                                        </svg>
                                    </span>
                                    <p class="text">Ver</p>
                                    </button>
                            </a>';
                        } else {
                            echo '<a class="btn btn-primary" title="Listo!" href="#"><i class="fa fa-check" aria-hidden="true"></i></a>
                            ';
                        }
                        echo '</td>
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
                text: "No volveras a recuperar el usuario",
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
                    window.location.href = "index.php?seccion=usuarios&eliminar=1&idUsuario=" + id;
                } else {
                    swal("Cancelado", "El usuario esta a salvo :)", "error");
                }
            });
    }
</script>

<div class="content-page">
        <div class="conatiner-fluid content-inner mt-5 py-0">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between flex-wrap mb-4">
                    <h4>Panel Super Admin</h4>
                </div>
                
                <!-- Estadísticas generales -->
                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Empresas Activas</h5>
                                    <h2 class="mb-0"><?= $estadisticas['empresas_activas'] ?? 0 ?></h2>
                                    <small>Total de empresas registradas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total de Ventas</h5>
                                    <h2 class="mb-0">$<?= number_format($estadisticas['total_ventas'] ?? 0, 2) ?></h2>
                                    <small>Ingresos totales del sistema</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total de Visitas</h5>
                                    <h2 class="mb-0"><?= number_format($estadisticas['total_visitas'] ?? 0) ?></h2>
                                    <small>Visitas registradas en el sistema</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lista de empresas -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Lista de Empresas</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Estado</th>
                                            <th>Fecha de Alta</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($empresas) && !empty($empresas)): ?>
                                            <?php foreach ($empresas as $empresa): ?>
                                                <tr>
                                                    <td><?= esc($empresa['nombre']) ?></td>
                                                    <td>
                                                        <span class="badge <?= $empresa['activo'] ? 'bg-success' : 'bg-danger' ?>">
                                                            <?= $empresa['activo'] ? 'Activo' : 'Inactivo' ?>
                                                        </span>
                                                    </td>
                                                    <td><?= date('d/m/Y', strtotime($empresa['fecha_alta'])) ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="<?= base_url('superadmin/impersonar/' . $empresa['id']) ?>" 
                                                               class="btn btn-sm btn-primary">
                                                                Ver Panel
                                                            </a>
                                                            <button type="button" 
                                                                    class="btn btn-sm <?= $empresa['activo'] ? 'btn-warning' : 'btn-success' ?>"
                                                                    onclick="toggleEmpresa(<?= $empresa['id'] ?>, <?= $empresa['activo'] ? 'false' : 'true' ?>)">
                                                                <?= $empresa['activo'] ? 'Desactivar' : 'Activar' ?>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No hay empresas registradas</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <h5>Service</h5>
                                        </div>
                                        <div class="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="card service-card">
                                                <div class="d-flex justify-content-between">
                                                    <div class="card-body">
                                                        <h5>Cloud Services</h5>
                                                        <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <h6 class="fw-bold">$42,00 <span class="fw-lighter">/Monthly</span></h6>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <svg width="80" viewBox="0 0 66 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path id="Vector" d="M20.6612 1.22217H10.8563V5.26543H20.6612M20.6612 1.22217V5.26543M20.6612 1.22217H30.4654V5.26543H20.6612M35.3689 5.26441H25.564V9.30767H35.3689M35.3689 5.26441V9.30767M35.3689 5.26441H45.173M35.3689 9.30767H45.173M45.173 5.26441V9.30767M45.173 5.26441H54.9772V9.30767H45.173M10.8049 9.308H1V13.3513H10.8049M10.8049 9.308V13.3513M10.8049 9.308H20.609V13.3513H10.8049M40.2202 9.308H30.4154V13.3513H40.2202M40.2202 9.308V13.3513M40.2202 9.308H50.0244V13.3513H40.2202M25.5126 13.3502H15.7077V17.3935H25.5126M25.5126 13.3502V17.3935M25.5126 13.3502H35.3167V17.3935H25.5126M30.6334 17.3938H20.8286V21.4371H30.6334M30.6334 17.3938V21.4371M30.6334 17.3938H40.2549C38.917 18.5367 37.8068 19.907 36.9969 21.4371H30.6334M15.9258 21.4361H6.12088V25.4793H15.9258M15.9258 21.4361V25.4793M15.9258 21.4361H25.7299V25.4793H15.9258M10.9672 25.477H1.16229V29.5202H10.9672M10.9672 25.477V29.5202M10.9672 25.477H20.7713V29.5202H10.9672M30.5784 25.477H20.7735V29.5202H30.5784M30.5784 25.477V29.5202M30.5784 25.477H35.6365C35.5312 26.1362 35.477 26.8127 35.477 27.4993C35.477 28.1859 35.5312 28.861 35.6365 29.5202H30.5784M15.8707 29.5192H6.06582V33.5625H15.8707M15.8707 29.5192V33.5625M15.8707 29.5192H25.6749M15.8707 33.5625H25.6749M25.6749 29.5192V33.5625M25.6749 29.5192H35.479V33.5625H25.6749M1.05506 1.22217H10.86V5.26543H1.05506V1.22217ZM30.4704 1.22217H40.2753V5.26543H30.4704V1.22217ZM40.2717 1.22217H50.0766V5.26543H40.2717V1.22217ZM5.95279 5.26441H15.7577V9.30767H5.95279V5.26441ZM15.7627 5.26441H25.5676V9.30767H15.7627V5.26441ZM20.6054 9.308H30.4103V13.3513H20.6054V9.308ZM5.89773 13.3502H15.7026V17.3935H5.89773V13.3502ZM45.118 13.3502V14.6227C43.3001 15.2488 41.6494 16.1959 40.2496 17.3921H35.3131V13.3502H45.118ZM54.9279 13.3502V14.483C53.4553 14.0239 51.879 13.7763 50.2407 13.7763C48.4414 13.7763 46.718 14.0757 45.123 14.6227V13.3502H54.9279ZM1.21735 17.3938H11.0222V21.4371H1.21735V17.3938ZM11.0186 17.3938H20.8235V21.4371H11.0186V17.3938ZM25.7263 21.4361H35.5312V25.4793H25.7263V21.4361ZM36.998 21.4361C36.3321 22.6869 35.8676 24.0471 35.64 25.4779H35.5362V21.4361H36.998ZM36.994 33.561H35.4812V29.5192H35.6376C35.8636 30.95 36.3297 32.3102 36.994 33.561ZM65 27.5004C65 35.0788 58.3911 41.2222 50.2369 41.2222C44.4255 41.2222 39.3992 38.1016 36.9913 33.5631C36.327 32.3123 35.8609 30.9521 35.6349 29.5213C35.5296 28.8621 35.4754 28.187 35.4754 27.5004C35.4754 26.8138 35.5296 26.1373 35.6349 25.4781C35.8625 24.0473 36.327 22.6871 36.9929 21.4362C37.8027 19.9062 38.913 18.5359 40.2509 17.393C41.6507 16.1968 43.3013 15.2497 45.1192 14.6236C46.7141 14.0766 48.4376 13.7772 50.2369 13.7772C51.8752 13.7772 53.4515 14.0248 54.9241 14.484C60.7804 16.3048 65 21.4434 65 27.5004ZM51.9509 17.792C51.9418 17.7365 51.8621 17.7113 51.81 17.7466C50.9151 18.3463 49.6372 19.3694 48.6535 20.9191C47.0201 23.4894 47.1948 25.9412 47.3511 26.987C47.3572 27.0298 47.3143 27.0676 47.2622 27.0676C45.3347 27.0198 44.2927 25.4826 43.9525 24.0967C43.9372 24.0362 43.8453 24.0161 43.7993 24.0665C43.0179 24.8955 42.2425 25.654 41.8533 26.6695C41.4703 27.6674 41.3661 28.7383 41.5561 29.774C41.6787 30.4443 41.9116 31.107 42.2579 31.7218C42.5766 32.2913 42.9964 32.823 43.5051 33.2917C45.9414 35.5344 50.2992 36.1719 53.5261 34.7583C55.659 33.8234 57.1606 32.0544 57.6755 30.1267C58.2822 27.8538 57.2863 25.5784 55.8429 23.6507C54.5742 21.9573 52.7753 20.6193 52.1563 18.6235C52.0643 18.3413 52 18.0616 51.9509 17.792ZM51.108 27.283C51.1056 27.2586 51.0796 27.2451 51.0606 27.2614C50.7622 27.5405 50.336 28.0147 50.0091 28.7327C49.4645 29.925 49.5213 31.0631 49.5758 31.5482C49.5781 31.5699 49.5639 31.5861 49.545 31.5861C48.9032 31.5645 48.5551 30.8518 48.4414 30.2096C48.4366 30.1825 48.4059 30.1716 48.3893 30.196C48.1288 30.5808 47.8706 30.9331 47.7404 31.4046C47.6125 31.8679 47.5794 32.3638 47.6409 32.8462C47.6812 33.1578 47.7593 33.464 47.8754 33.7512C47.9819 34.0141 48.1217 34.2634 48.2898 34.4801C49.1021 35.5207 50.5562 35.8161 51.6314 35.1603C52.3418 34.7267 52.8439 33.9057 53.0144 33.0115C53.2181 31.9574 52.8841 30.9006 52.4034 30.0063C51.9795 29.2205 51.3803 28.6 51.1743 27.6732C51.1459 27.5378 51.1222 27.4077 51.108 27.283Z" stroke="black" stroke-miterlimit="10" />
                                                        </svg>
                                                        <a type="button" class="btn btn-primary text-white btn-sm mt-4">Setup Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="card service-card">
                                                <div class="d-flex justify-content-between">
                                                    <div class="card-body">
                                                        <h5>Firewall services</h5>
                                                        <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <h6 class="fw-bold">$28,00 <span class="fw-lighter">/Monthly</span></h6>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <svg width="80" viewBox="0 0 66 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path id="Vector" d="M20.6612 1.22217H10.8563V5.26543H20.6612M20.6612 1.22217V5.26543M20.6612 1.22217H30.4654V5.26543H20.6612M35.3689 5.26441H25.564V9.30767H35.3689M35.3689 5.26441V9.30767M35.3689 5.26441H45.173M35.3689 9.30767H45.173M45.173 5.26441V9.30767M45.173 5.26441H54.9772V9.30767H45.173M10.8049 9.308H1V13.3513H10.8049M10.8049 9.308V13.3513M10.8049 9.308H20.609V13.3513H10.8049M40.2202 9.308H30.4154V13.3513H40.2202M40.2202 9.308V13.3513M40.2202 9.308H50.0244V13.3513H40.2202M25.5126 13.3502H15.7077V17.3935H25.5126M25.5126 13.3502V17.3935M25.5126 13.3502H35.3167V17.3935H25.5126M30.6334 17.3938H20.8286V21.4371H30.6334M30.6334 17.3938V21.4371M30.6334 17.3938H40.2549C38.917 18.5367 37.8068 19.907 36.9969 21.4371H30.6334M15.9258 21.4361H6.12088V25.4793H15.9258M15.9258 21.4361V25.4793M15.9258 21.4361H25.7299V25.4793H15.9258M10.9672 25.477H1.16229V29.5202H10.9672M10.9672 25.477V29.5202M10.9672 25.477H20.7713V29.5202H10.9672M30.5784 25.477H20.7735V29.5202H30.5784M30.5784 25.477V29.5202M30.5784 25.477H35.6365C35.5312 26.1362 35.477 26.8127 35.477 27.4993C35.477 28.1859 35.5312 28.861 35.6365 29.5202H30.5784M15.8707 29.5192H6.06582V33.5625H15.8707M15.8707 29.5192V33.5625M15.8707 29.5192H25.6749M15.8707 33.5625H25.6749M25.6749 29.5192V33.5625M25.6749 29.5192H35.479V33.5625H25.6749M1.05506 1.22217H10.86V5.26543H1.05506V1.22217ZM30.4704 1.22217H40.2753V5.26543H30.4704V1.22217ZM40.2717 1.22217H50.0766V5.26543H40.2717V1.22217ZM5.95279 5.26441H15.7577V9.30767H5.95279V5.26441ZM15.7627 5.26441H25.5676V9.30767H15.7627V5.26441ZM20.6054 9.308H30.4103V13.3513H20.6054V9.308ZM5.89773 13.3502H15.7026V17.3935H5.89773V13.3502ZM45.118 13.3502V14.6227C43.3001 15.2488 41.6494 16.1959 40.2496 17.3921H35.3131V13.3502H45.118ZM54.9279 13.3502V14.483C53.4553 14.0239 51.879 13.7763 50.2407 13.7763C48.4414 13.7763 46.718 14.0757 45.123 14.6227V13.3502H54.9279ZM1.21735 17.3938H11.0222V21.4371H1.21735V17.3938ZM11.0186 17.3938H20.8235V21.4371H11.0186V17.3938ZM25.7263 21.4361H35.5312V25.4793H25.7263V21.4361ZM36.998 21.4361C36.3321 22.6869 35.8676 24.0471 35.64 25.4779H35.5362V21.4361H36.998ZM36.994 33.561H35.4812V29.5192H35.6376C35.8636 30.95 36.3297 32.3102 36.994 33.561ZM65 27.5004C65 35.0788 58.3911 41.2222 50.2369 41.2222C44.4255 41.2222 39.3992 38.1016 36.9913 33.5631C36.327 32.3123 35.8609 30.9521 35.6349 29.5213C35.5296 28.8621 35.4754 28.187 35.4754 27.5004C35.4754 26.8138 35.5296 26.1373 35.6349 25.4781C35.8625 24.0473 36.327 22.6871 36.9929 21.4362C37.8027 19.9062 38.913 18.5359 40.2509 17.393C41.6507 16.1968 43.3013 15.2497 45.1192 14.6236C46.7141 14.0766 48.4376 13.7772 50.2369 13.7772C51.8752 13.7772 53.4515 14.0248 54.9241 14.484C60.7804 16.3048 65 21.4434 65 27.5004ZM51.9509 17.792C51.9418 17.7365 51.8621 17.7113 51.81 17.7466C50.9151 18.3463 49.6372 19.3694 48.6535 20.9191C47.0201 23.4894 47.1948 25.9412 47.3511 26.987C47.3572 27.0298 47.3143 27.0676 47.2622 27.0676C45.3347 27.0198 44.2927 25.4826 43.9525 24.0967C43.9372 24.0362 43.8453 24.0161 43.7993 24.0665C43.0179 24.8955 42.2425 25.654 41.8533 26.6695C41.4703 27.6674 41.3661 28.7383 41.5561 29.774C41.6787 30.4443 41.9116 31.107 42.2579 31.7218C42.5766 32.2913 42.9964 32.823 43.5051 33.2917C45.9414 35.5344 50.2992 36.1719 53.5261 34.7583C55.659 33.8234 57.1606 32.0544 57.6755 30.1267C58.2822 27.8538 57.2863 25.5784 55.8429 23.6507C54.5742 21.9573 52.7753 20.6193 52.1563 18.6235C52.0643 18.3413 52 18.0616 51.9509 17.792ZM51.108 27.283C51.1056 27.2586 51.0796 27.2451 51.0606 27.2614C50.7622 27.5405 50.336 28.0147 50.0091 28.7327C49.4645 29.925 49.5213 31.0631 49.5758 31.5482C49.5781 31.5699 49.5639 31.5861 49.545 31.5861C48.9032 31.5645 48.5551 30.8518 48.4414 30.2096C48.4366 30.1825 48.4059 30.1716 48.3893 30.196C48.1288 30.5808 47.8706 30.9331 47.7404 31.4046C47.6125 31.8679 47.5794 32.3638 47.6409 32.8462C47.6812 33.1578 47.7593 33.464 47.8754 33.7512C47.9819 34.0141 48.1217 34.2634 48.2898 34.4801C49.1021 35.5207 50.5562 35.8161 51.6314 35.1603C52.3418 34.7267 52.8439 33.9057 53.0144 33.0115C53.2181 31.9574 52.8841 30.9006 52.4034 30.0063C51.9795 29.2205 51.3803 28.6 51.1743 27.6732C51.1459 27.5378 51.1222 27.4077 51.108 27.283Z" stroke="black" stroke-miterlimit="10" />
                                                        </svg>
                                                        <a type="button" class="btn btn-primary text-white btn-sm mt-4">Setup Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="card service-card">
                                                <div class="d-flex justify-content-between">
                                                    <div class="card-body">
                                                        <h5>Cyber security</h5>
                                                        <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <h6 class="fw-bold">$79,00 <span class="fw-lighter">/Monthly</span></h6>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <svg width="80" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path id="Vector 37" d="M44.8405 22.4918H53.5137L55.4109 23.7142V57.7798M55.4109 57.7798H63C63 57.7798 63 60.2247 63 62.0991C63 63.1161 60.9672 62.9956 60.9672 62.9956H2.69405C2.69405 62.9956 1.00016 62.3233 1.00006 61.2842C0.999927 59.8987 1.00006 57.7798 1.00006 57.7798H7.97929M55.4109 57.7798H7.97929M7.97929 57.7798V23.7142L9.33448 22.4918H18.8208M22.7509 51.1786H24.3093M28.7137 51.1786H34.812M39.2164 51.1786H40.7071M37.3191 39.6875H22.7509C22.7509 39.6875 20.7778 39.8969 20.176 40.9915C19.5776 42.0799 19.6528 43.1897 20.176 44.3328C20.7364 45.5571 22.7509 46.1258 22.7509 46.1258H37.3191M37.3191 39.6875H41.4525C41.4525 39.6875 43.1358 40.5011 43.553 41.6435C43.9042 42.6051 43.9252 43.3828 43.553 44.3328C43.1243 45.4273 41.4525 46.1258 41.4525 46.1258H37.3191M37.3191 39.6875V46.1258M25.025 13.6146L23.564 13.6901V31.7009H40.7071V13.6901H38.975M25.025 13.6146L29.5268 13.6901M25.025 13.6146V8.47435M38.975 13.6901V6.55992C38.975 6.55992 38.0556 4.84597 36.65 3.42365C35.875 2.6394 33.2536 1.03736 32.1964 1.00198C30.8142 0.955721 29.478 1.72772 28.125 2.6394C26.6823 3.61152 25.025 6.55992 25.025 6.55992V8.47435M38.975 13.6901H34.3377M29.5268 13.6901H34.3377M29.5268 13.6901V8.47435M34.3377 13.6901V7.65938C34.3377 7.65938 33.8238 6.50416 33.2536 6.11094C32.4272 5.54106 31.6709 5.60972 30.8142 6.11094C30.1749 6.48506 29.5268 7.65938 29.5268 7.65938V8.47435M25.025 8.47435H29.5268M29.188 22.7363H34.3377" stroke="black" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <a type="button" class="btn btn-primary text-white btn-sm mt-4">Setup Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="card service-card">
                                                <div class="d-flex justify-content-between">
                                                    <div class="card-body">
                                                        <h5>Data analytics</h5>
                                                        <p class="mt-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <h6 class="fw-bold">$20,00 <span class="fw-lighter">/Monthly</span></h6>
                                                    </div>
                                                    <div class="card-body text-center">
                                                        <svg width="80" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M33.6897 37.7375H13.9653" stroke="#232D42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M33.6897 26.528H13.9653" stroke="#232D42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M21.4917 15.3478H13.9653" stroke="#232D42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M34.3156 50.9438C34.2801 50.9438 13.31 50.9519 13.31 50.9519C5.70434 50.9519 1 46.0715 1 38.6185V13.9999C1 6.58433 5.66882 1.72272 13.2089 1.67721C13.2417 1.67721 34.2145 1.6665 34.2145 1.6665C41.8201 1.6665 46.5272 6.54685 46.5272 13.9999V38.6185" stroke="#232D42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            <ellipse cx="42.1804" cy="46.6463" rx="8.92942" ry="8.75027" stroke="#232D42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M48.3909 53.1865L51.8917 56.6082" stroke="#232D42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <a type="button" class="btn btn-secondary text-white btn-sm mt-4">Setup Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="card overflow-hidden">
                                <div class="card-header d-flex justify-content-between flex-wrap">
                                    <h5>Transaction History</h5>
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton7">
                                            <a class="dropdown-item " href="javascript:void(0);">Action</a>
                                            <a class="dropdown-item " href="javascript:void(0);">Another action</a>
                                            <a class="dropdown-item " href="javascript:void(0);">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive mt-4">
                                        <table id="basic-table" class="table table-striped table-hover" role="grid">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Date and Time</th>
                                                    <th class="text-end">Amount</th>
                                                    <th class="text-center">Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="">
                                                            <h6 class="text-primary">#12345678</h6>
                                                            <p class="mb-0">Payment Number 1</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Oct 16, 2021, 10.45am
                                                    </td>
                                                    <td class="text-end">$10.00</td>
                                                    <td class="text-center">
                                                        <div class="badge rounded-pill bg-soft-success">
                                                            Completed
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                            </svg>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="">
                                                            <h6 class="text-primary">#12345678</h6>
                                                            <p class="mb-0">Payment Number 2</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Mar 01, 2021, 5.30pm
                                                    </td>
                                                    <td class="text-end">$20.00</td>
                                                    <td class="text-center">
                                                        <div class="badge rounded-pill bg-soft-warning">
                                                            Pending
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                            </svg>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="">
                                                            <h6 class="text-primary">#12345678</h6>
                                                            <p class="mb-0">Payment Number 3</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Apr 05, 2021, 1:40pm
                                                    </td>
                                                    <td class="text-end">$30.00</td>
                                                    <td class="text-center">
                                                        <div class="badge rounded-pill bg-soft-info">
                                                            For Pickup
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                            </svg>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="">
                                                            <h6 class="text-primary">#12345678</h6>
                                                            <p class="mb-0">Payment Number 4</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Dec 20, 2021, 4:30pm
                                                    </td>
                                                    <td class="text-end">$40.00</td>
                                                    <td class="text-center">
                                                        <div class="badge rounded-pill bg-soft-danger">
                                                            Declined
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                            </svg>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="">
                                                            <h6 class="text-primary">#12345678</h6>
                                                            <p class="mb-0">Payment Number 5</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Dec 20, 2021, 4.30pm
                                                    </td>
                                                    <td class="text-end">$40.00</td>
                                                    <td class="text-center">
                                                        <div class="badge rounded-pill bg-soft-warning">
                                                            Pending
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                            </svg>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="">
                                                            <h6 class="text-primary">#12345678</h6>
                                                            <p class="mb-0">Payment Number 6</p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        Oct 16, 2021, 10.45am
                                                    </td>
                                                    <td class="text-end">$40.00</td>
                                                    <td class="text-center">
                                                        <div class="badge rounded-pill bg-soft-success">
                                                            Completed
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                            </svg>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                                <li><a class="dropdown-item" href="#">This Week</a></li>
                                                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

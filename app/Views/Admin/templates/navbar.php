
 
<aside class="sidebar sidebar-default navs-rounded">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="<?= base_url('admin') ?>" class="navbar-brand">
                <!--Logo start-->
                <div class="iq-logo" style="background: linear-gradient(135deg, #FE9436 0%, #FF6B35 100%); padding: 8px 12px; border-radius: 8px; display: inline-block;">
                    <img src="<?= base_url('public/assets/images/logos/logo.png') ?>" alt="Comeya" style="height: 32px; width: auto;">
                </div>
                <!--logo End-->
                <img src="<?= base_url('public/assets/images/logos/ico.png') ?>" alt="Comeya" class="logo-mini mt-2" style="height: 32px; width: auto;">
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="navbar-collapse" id="sidebar">
                <!-- Sidebar Menu Start -->
                <ul class="navbar-nav iq-main-menu">
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon text-primary">Mi Restaurante</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= base_url('admin') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 3.87479 3.02811 3 6.5 3C9.97189 3 10 3.87479 10 6.5C10 9.12521 10.0111 10 6.5 10C2.98893 10 3 9.12521 3 6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 6.5C14 3.87479 14.0281 3 17.5 3C20.9719 3 21 3.87479 21 6.5C21 9.12521 21.0111 10 17.5 10C13.9889 10 14 9.12521 14 6.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.5C3 14.8748 3.02811 14 6.5 14C9.97189 14 10 14.8748 10 17.5C10 20.1252 10.0111 21 6.5 21C2.98893 21 3 20.1252 3 17.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14 17.5C14 14.8748 14.0281 14 17.5 14C20.9719 14 21 14.8748 21 17.5C21 20.1252 21.0111 21 17.5 21C13.9889 21 14 20.1252 14 17.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </i>
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/menu') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </i>
                            <span class="item-name">Mi Menú / Productos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/apariencia') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1L9 7V9C9 10.1 9.9 11 11 11V22H13V11C14.1 11 15 10.1 15 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </i>
                            <span class="item-name">Apariencia del Menú</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/pedidos') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3H5L5.4 5M7 13H17L21 5H5.4M7 13L5.4 5M7 13L4.7 15.3C4.3 15.7 4.6 16.5 5.1 16.5H17M17 13V16.5M9 19.5C9.8 19.5 10.5 20.2 10.5 21S9.8 22.5 9 22.5 7.5 21.8 7.5 21 8.2 19.5 9 19.5ZM20 19.5C20.8 19.5 21.5 20.2 21.5 21S20.8 22.5 20 22.5 18.5 21.8 18.5 21 19.2 19.5 20 19.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </i>
                            <span class="item-name">Pedidos en Tiempo Real</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/reportes') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3V21H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 9L12 6L16 10L22 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </i>
                            <span class="item-name">Reportes / Ventas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/promociones') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </i>
                            <span class="item-name">Promociones / Marketing</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/plan') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </i>
                            <span class="item-name">Mi Plan y Facturación</span>
                        </a>
                    </li>
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon text-primary">Configuración</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/configuracion') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19.4 15C19.2669 15.3016 19.2272 15.6362 19.286 15.9606C19.3448 16.285 19.4995 16.5843 19.73 16.82L19.79 16.88C19.976 17.0657 20.1235 17.2863 20.2241 17.5291C20.3248 17.7719 20.3766 18.0322 20.3766 18.295C20.3766 18.5578 20.3248 18.8181 20.2241 19.0609C20.1235 19.3037 19.976 19.5243 19.79 19.71C19.6043 19.896 19.3837 20.0435 19.1409 20.1441C18.8981 20.2448 18.6378 20.2966 18.375 20.2966C18.1122 20.2966 17.8519 20.2448 17.6091 20.1441C17.3663 20.0435 17.1457 19.896 16.96 19.71L16.9 19.65C16.6643 19.4195 16.365 19.2648 16.0406 19.206C15.7162 19.1472 15.3816 19.1869 15.08 19.32C14.7842 19.4468 14.532 19.6572 14.3543 19.9255C14.1766 20.1938 14.0813 20.5082 14.08 20.83V21C14.08 21.5304 13.8693 22.0391 13.4942 22.4142C13.1191 22.7893 12.6104 23 12.08 23C11.5496 23 11.0409 22.7893 10.6658 22.4142C10.2907 22.0391 10.08 21.5304 10.08 21V20.91C10.0723 20.579 9.96512 20.2583 9.77251 19.9887C9.5799 19.7191 9.31074 19.5143 9 19.4C8.69838 19.2669 8.36381 19.2272 8.03941 19.286C7.71502 19.3448 7.41568 19.4995 7.18 19.73L7.12 19.79C6.93425 19.976 6.71368 20.1235 6.47088 20.2241C6.22808 20.3248 5.96783 20.3766 5.705 20.3766C5.44217 20.3766 5.18192 20.3248 4.93912 20.2241C4.69632 20.1235 4.47575 19.976 4.29 19.79C4.10405 19.6043 3.95653 19.3837 3.85588 19.1409C3.75523 18.8981 3.70343 18.6378 3.70343 18.375C3.70343 18.1122 3.75523 17.8519 3.85588 17.6091C3.95653 17.3663 4.10405 17.1457 4.29 16.96L4.35 16.9C4.58054 16.6643 4.73519 16.365 4.794 16.0406C4.85282 15.7162 4.81312 15.3816 4.68 15.08C4.55324 14.7842 4.34276 14.532 4.07447 14.3543C3.80618 14.1766 3.49179 14.0813 3.17 14.08H3C2.46957 14.08 1.96086 13.8693 1.58579 13.4942C1.21071 13.1191 1 12.6104 1 12.08C1 11.5496 1.21071 11.0409 1.58579 10.6658C1.96086 10.2907 2.46957 10.08 3 10.08H3.09C3.42099 10.0723 3.74171 9.96512 4.01131 9.77251C4.28091 9.5799 4.48571 9.31074 4.6 9C4.73312 8.69838 4.77282 8.36381 4.714 8.03941C4.65519 7.71502 4.50054 7.41568 4.27 7.18L4.21 7.12C4.02405 6.93425 3.87653 6.71368 3.77588 6.47088C3.67523 6.22808 3.62343 5.96783 3.62343 5.705C3.62343 5.44217 3.67523 5.18192 3.77588 4.93912C3.87653 4.69632 4.02405 4.47575 4.21 4.29C4.39575 4.10405 4.61632 3.95653 4.85912 3.85588C5.10192 3.75523 5.36217 3.70343 5.625 3.70343C5.88783 3.70343 6.14808 3.75523 6.39088 3.85588C6.63368 3.95653 6.85425 4.10405 7.04 4.29L7.1 4.35C7.33568 4.58054 7.63502 4.73519 7.95941 4.794C8.28381 4.85282 8.61838 4.81312 8.92 4.68H9C9.29577 4.55324 9.54802 4.34276 9.72569 4.07447C9.90337 3.80618 9.99872 3.49179 10 3.17V3C10 2.46957 10.2107 1.96086 10.5858 1.58579C10.9609 1.21071 11.4696 1 12 1C12.5304 1 13.0391 1.21071 13.4142 1.58579C13.7893 1.96086 14 2.46957 14 3V3.09C14.0013 3.41179 14.0966 3.72618 14.2743 3.99447C14.452 4.26276 14.7042 4.47324 15 4.6C15.3016 4.73312 15.6362 4.77282 15.9606 4.714C16.285 4.65519 16.5843 4.50054 16.82 4.27L16.88 4.21C17.0657 4.02405 17.2863 3.87653 17.5291 3.77588C17.7719 3.67523 18.0322 3.62343 18.295 3.62343C18.5578 3.62343 18.8181 3.67523 19.0609 3.77588C19.3037 3.87653 19.5243 4.02405 19.71 4.21C19.896 4.39575 20.0435 4.61632 20.1441 4.85912C20.2448 5.10192 20.2966 5.36217 20.2966 5.625C20.2966 5.88783 20.2448 6.14808 20.1441 6.39088C20.0435 6.63368 19.896 6.85425 19.71 7.04L19.65 7.1C19.4195 7.33568 19.2648 7.63502 19.206 7.95941C19.1472 8.28381 19.1869 8.61838 19.32 8.92V9C19.4468 9.29577 19.6572 9.54802 19.9255 9.72569C20.1938 9.90337 20.5082 9.99872 20.83 10H21C21.5304 10 22.0391 10.2107 22.4142 10.5858C22.7893 10.9609 23 11.4696 23 12C23 12.5304 22.7893 13.0391 22.4142 13.4142C22.0391 13.7893 21.5304 14 21 14H20.91C20.5882 14.0013 20.2738 14.0966 20.0055 14.2743C19.7372 14.452 19.5268 14.7042 19.4 15Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </i>
                            <span class="item-name">Mi Cuenta</span>
                        </a>
                    </li>
                    <li class="nav-item mb-5">
                        <a class="nav-link" href="<?= base_url('logout') ?>">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 3H19C20.1046 3 21 3.89543 21 5V19C21 20.1046 20.1046 21 19 21H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 17L15 12L10 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15 12H3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </i>
                            <span class="item-name">Cerrar Sesión</span>
                        </a>
                    </li>
                </ul>
                <!-- Sidebar Menu End -->
            </div>
        </div>
    </aside>

    <main class="main-content">

<!--Nav Start-->
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar border-bottom">
                <div class="container-fluid navbar-inner">
                    <a href="../dashboard/index.html" class="navbar-brand">
                        <!--Logo start-->
                        <svg width="88" class="iq-logo" viewBox="0 0 88 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 33.0964V2.00584L5 0V33.0964H0Z" fill="#FE9436" />
                            <path d="M32.4599 13.3035C32.0607 14.1452 32.5455 15.6849 32.5455 15.6849L33.2074 15.1367C33.4419 14.9424 33.8351 14.7486 34.0002 15.0045C34.1533 15.2419 33.8716 15.5141 33.6509 15.6906C33.4232 15.8726 33.1385 16.1252 32.9734 16.3653C32.6511 16.8338 32.4758 17.1587 32.4599 17.7261C32.4246 18.9938 33.4012 19.7673 34.7703 20.0224C36.5859 20.3606 37.5941 18.4065 38.022 17.7261C38.4499 17.0457 38.2578 16.397 38.7066 15.6849C39.133 15.0082 40.1612 14.239 40.1612 14.239C40.1612 14.239 40.6378 13.865 40.9314 13.9839C41.1064 14.0548 41.2483 14.1379 41.2737 14.3241C41.2997 14.516 41.0169 14.7493 41.0169 14.7493C41.0169 14.7493 39.7391 15.4373 39.3055 16.1952C38.997 16.7346 38.8777 17.7261 38.8777 17.7261L38.4498 18.5766C38.4498 18.5766 39.1238 18.7768 39.5623 18.7467C40.0157 18.7155 40.5035 18.4916 40.5891 18.4065C40.8458 18.1515 40.5035 17.8962 41.1881 16.8756C41.8482 15.8915 42.9915 15.6743 43.0706 14.4942C43.1562 13.2185 41.5489 12.6761 41.3592 11.2623C41.1881 9.98666 42.2149 8.79589 42.2149 8.79589C42.2149 8.79589 41.1236 7.96126 40.3324 8.03044C39.6015 8.09434 38.7066 8.96598 38.7066 8.96598C38.7066 8.96598 40.3324 9.81656 40.418 11.2623C40.4716 12.1679 40.061 12.6917 39.4767 13.3886C39.0488 13.8988 37.9364 14.239 37.3374 14.6643C36.8179 15.0331 36.4706 15.2274 36.1395 15.7699C35.9943 16.0077 35.8874 16.3475 35.8168 16.628L35.8163 16.6298C35.7343 16.9555 35.6173 17.4202 35.2838 17.3859C35.0054 17.3573 34.962 16.9752 35.02 16.7014C35.0995 16.3261 35.2414 15.7867 35.4549 15.4297C35.8172 14.8241 36.2061 14.6193 36.7384 14.154C37.6573 13.3507 38.9561 13.5336 39.3055 12.368C39.7483 10.8907 39.3507 10.0356 38.2787 9.56133C37.2843 9.12135 36.3796 9.63111 35.626 10.4118C34.9562 11.1058 34.993 12.5674 35.06 13.2963C35.0856 13.5742 35.0479 13.9554 34.7703 13.9839C34.4404 14.0178 34.3425 13.5466 34.3425 13.215V11.8577C34.3425 11.8577 32.8562 12.4682 32.4599 13.3035Z" fill="#FE9436" />
                            <path d="M47.2635 20.0225C46.6641 20.082 45.8088 19.5122 45.8088 19.5122C45.8088 19.5122 46.255 18.8187 46.4078 18.3215C46.4857 18.0681 46.5284 17.7324 46.5517 17.4579C46.5794 17.1317 46.5612 16.6641 46.2367 16.6205C45.916 16.5774 45.8623 17.0641 45.85 17.3875C45.8407 17.6304 45.7901 17.9334 45.6377 18.2364C45.2954 18.9168 44.8676 20.1926 43.3273 20.0225C41.6914 19.8418 41.4448 19.3421 41.4448 18.0663C41.4448 16.8756 43.5496 16.5353 43.8407 14.6643C44.1318 12.7933 41.5471 12.2093 42.1293 10.582C42.5174 9.4975 43.1116 8.59081 44.2686 8.54082C46.2367 8.45577 46.9212 10.582 46.9212 10.582C46.9212 10.582 48.1518 10.2315 48.9749 10.7521C49.9162 11.3474 50.0018 12.7082 50.0018 12.7082C50.0018 12.7082 51.2442 12.9805 51.7132 13.5587C52.4833 14.5082 52.141 15.5999 52.141 15.5999L51.3709 15.1747L50.7719 15.0896C50.7719 15.0896 49.865 13.5543 48.8894 13.1335C48.2087 12.8399 47.0068 12.8783 47.0068 12.8783C47.0068 12.8783 46.5232 11.8215 45.98 11.3474C45.6129 11.0272 45.0012 10.7832 44.5751 10.6404C44.2692 10.5379 43.791 10.5165 43.7552 10.8371C43.7132 11.2126 44.2878 11.2968 44.6454 11.4188C44.8974 11.5049 45.1835 11.6245 45.381 11.7727C45.8988 12.1613 46.3223 13.1335 46.3223 13.1335L45.659 13.5392C45.3687 13.7167 45.0049 14.0524 45.2099 14.3241C45.4605 14.6564 45.9773 14.2712 46.3498 14.0855C46.8625 13.83 47.6697 13.5559 48.4615 13.8139C49.7668 14.2392 50.2585 15.9401 50.2585 15.9401C50.2585 15.9401 52.3122 15.9401 52.4833 17.471C52.6074 18.581 51.1997 18.7467 51.1997 18.7467C51.1997 18.7467 50.9617 19.5871 50.5152 19.7673C50.1079 19.9317 49.4028 19.5972 49.4028 19.5972L49.6595 19.0869V18.4065L50.3424 17.8844C50.6193 17.6727 50.9706 17.2476 50.6863 17.0458C50.4485 16.8769 50.1393 17.1346 49.9054 17.3089L49.5739 17.5561L49.307 17.0254C49.1594 16.732 48.7554 16.4517 48.5471 16.7056C48.5438 16.7095 48.5408 16.7137 48.5379 16.7181C48.3531 17.0014 48.6334 17.3646 48.7467 17.6833C48.8269 17.9089 48.8988 18.1794 48.8894 18.4065C48.8524 19.2982 48.157 19.9338 47.2635 20.0225Z" fill="#FE9436" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M70.1034 1.12295L67.7126 2.24589L67.6955 11.1053L67.6784 19.9647H74.285H80.8917L80.7266 19.6788C80.6358 19.5216 80.2211 18.7334 79.8049 17.9275L79.0483 16.462L82.1446 13.3189C83.8476 11.5901 85.3051 10.118 85.3834 10.0475C85.4617 9.97701 85.5258 9.89379 85.5258 9.8625C85.5258 9.83122 84.1969 9.80565 82.5726 9.80565H79.6194L76.129 13.4555C74.2092 15.463 72.6137 17.1154 72.5834 17.1277C72.5531 17.14 72.5207 13.2913 72.5113 8.57506L72.4942 0L70.1034 1.12295ZM59.6142 0.283781C59.0394 0.412687 58.5879 0.673055 58.1572 1.12416C57.0105 2.32522 57.0237 4.06181 58.1884 5.22533C59.3782 6.414 61.2548 6.37895 62.3969 5.14668C62.8516 4.65601 63.0651 4.22563 63.1645 3.5992C63.4867 1.56867 61.6274 -0.167591 59.6142 0.283781ZM17.4717 9.33685C15.0035 9.61471 13.0875 10.5103 11.44 12.1562C9.70535 13.8891 8.6676 16.1031 8.24883 18.9642C8.19125 19.3575 8.14418 19.7434 8.14418 19.822V19.9647H10.5903H13.0363L13.1126 19.477C13.3123 18.2006 13.8916 16.8213 14.6031 15.928C15.6426 14.6229 16.9516 13.9555 18.6503 13.8645C21.9002 13.6905 24.2498 15.8967 24.8781 19.7124L24.9197 19.9647H27.3705H29.8214L29.7931 19.7461C29.3457 16.2892 28.4494 14.1846 26.6179 12.2908C25.1487 10.7717 23.3747 9.8399 21.2363 9.46415C20.323 9.30362 18.3571 9.23721 17.4717 9.33685ZM57.8462 14.8852V19.9647H60.2707H62.6952V14.8852V9.80565H60.2707H57.8462V14.8852ZM8.11414 23.4464C8.33793 25.6952 8.77225 27.3114 9.56499 28.8455C11.0236 31.6682 13.4962 33.4935 16.6299 34.0607C17.4712 34.213 19.6464 34.2708 20.5215 34.164C24.7076 33.6534 27.7584 31.1416 29.1105 27.0924C29.4682 26.0213 29.8299 24.1103 29.8299 23.2916V23.0595H27.4084H24.987L24.9536 23.2782C24.7158 24.8353 24.4064 25.8926 23.9495 26.7085C23.436 27.6256 22.6366 28.4692 21.809 28.9671C20.4897 29.761 18.2639 29.8798 16.7181 29.2389C15.2025 28.6105 14.0219 27.1965 13.4123 25.2797C13.2201 24.6756 12.9932 23.558 12.9932 23.2159V23.0595H10.5344H8.07568L8.11414 23.4464ZM32.4914 23.48C32.7305 25.8961 33.1048 27.3828 33.8675 28.9464C35.1693 31.6153 37.4365 33.4364 40.235 34.0613C40.8759 34.2044 42.7731 34.2659 43.5118 34.1675C45.1874 33.9444 46.5146 33.3172 47.5673 32.2511L48.0303 31.7822L47.9948 33.2573C47.9562 34.8622 47.8967 35.2063 47.5308 35.9434C46.7955 37.4243 45.3157 38.3427 42.8716 38.8349C41.9366 39.0232 40.8015 39.1773 39.8478 39.2453C39.4866 39.2711 39.1911 39.3025 39.1911 39.3152C39.1911 39.3562 41.489 42.8703 41.5721 42.9564C41.7601 43.1511 44.8064 42.6577 46.2537 42.1981C49.6947 41.1055 51.594 39.2337 52.3896 36.1513C52.8189 34.4879 52.8174 34.5136 52.8451 28.5259L52.8704 23.0595H50.442H48.0136V24.9664V26.8733L47.6853 27.3403C46.9782 28.3462 45.8994 29.1308 44.7809 29.4526C44.059 29.6604 42.7724 29.7081 42.0148 29.5554C39.6298 29.0746 38.0095 27.0912 37.4813 24.0064C37.4216 23.6576 37.3728 23.3019 37.3728 23.2159V23.0595H34.9112H32.4498L32.4914 23.48ZM57.8462 28.3745V33.6895H60.2707H62.6952V28.3745V23.0595H60.2707H57.8462V28.3745ZM67.6789 28.3745V33.6895H70.1034H72.5279V28.3745V23.0595H70.1034H67.6789V28.3745ZM77.2422 23.084C77.2422 23.1368 82.6231 33.5751 82.6793 33.6312C82.7129 33.6648 83.8948 33.6834 85.3697 33.6735L88.0002 33.6559L85.2405 28.3577L82.4808 23.0595H79.8615C78.4209 23.0595 77.2422 23.0705 77.2422 23.084Z" fill="black" />
                        </svg>
                        <!--logo End-->
                    </a>
                    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                        <i class="icon">
                            <svg width="20px" height="20px" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                            </svg>
                        </i>
                    </div>
                    <div class="input-group search-input">
                        <span class="input-group-text" id="search-input">
                            <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                        <input type="search" class="form-control" placeholder="Search...">
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <span class="navbar-toggler-bar bar1 mt-2"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="align-items-center navbar-nav ms-auto navbar-list mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link" id="notification-drop" data-bs-toggle="dropdown">
                                    <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 17.8476C17.6392 17.8476 20.2481 17.1242 20.5 14.2205C20.5 11.3188 18.6812 11.5054 18.6812 7.94511C18.6812 5.16414 16.0452 2 12 2C7.95477 2 5.31885 5.16414 5.31885 7.94511C5.31885 11.5054 3.5 11.3188 3.5 14.2205C3.75295 17.1352 6.36177 17.8476 12 17.8476Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M14.3889 20.8572C13.0247 22.3719 10.8967 22.3899 9.51953 20.8572" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="bg-danger dots"></span>
                                </a>
                                <div class="sub-drop dropdown-menu dropdown-menu-end p-0" aria-labelledby="notification-drop">
                                    <div class="card shadow-none m-0">
                                        <div class="card-header d-flex justify-content-between bg-primary py-3">
                                            <div class="header-title">
                                                <h5 class="mb-0 text-white">All Notifications</h5>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <img class="avatar-40 rounded-pill bg-soft-primary p-1" src="<?= base_url('public/assets/images/shapes/01.png') ?>" alt="">
                                                    <div class="ms-3 w-100">
                                                        <h6 class="mb-0 ">Emma Watson Bni</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0">95 MB</p>
                                                            <small class="float-end font-size-12">Just Now</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <img class="avatar-40 rounded-pill bg-soft-primary p-1" src="<?= base_url('public/assets/images/shapes/02.png') ?>" alt="">
                                                    </div>
                                                    <div class="ms-3 w-100">
                                                        <h6 class="mb-0 ">New customer is join</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0">Cyst Bni</p>
                                                            <small class="float-end font-size-12">5 days ago</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <img class="avatar-40 rounded-pill bg-soft-primary p-1" src="<?= base_url('public/assets/images/shapes/03.png') ?>" alt="">
                                                    <div class="ms-3 w-100">
                                                        <h6 class="mb-0 ">Two customer is left</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0">Cyst Bni</p>
                                                            <small class="float-end font-size-12">2 days ago</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="d-flex align-items-center">
                                                    <img class="avatar-40 rounded-pill bg-soft-primary p-1" src="<?= base_url('public/assets/images/shapes/04.png') ?>" alt="">
                                                    <div class="w-100 ms-3">
                                                        <h6 class="mb-0 ">New Mail from Fenny</h6>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <p class="mb-0">Cyst Bni</p>
                                                            <small class="float-end font-size-12">3 days ago</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('public/assets/images/avatars/01.png') ?>" alt="User-Profile" class="img-fluid avatar avatar-40 avatar-rounded">
                                    <div class="caption ms-3 d-none d-md-block ">
                                        <h6 class="mb-0 caption-title">James Patterson</h6>
                                        <p class="mb-0 caption-sub-title">Marketing Administrator</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="../dashboard/app/user-profile.html">Profile</a></li>
                                    <li><a class="dropdown-item" href="../dashboard/app/user-privacy-setting.html">Privacy Setting</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="../dashboard/auth/sign-in.html">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--Nav End-->

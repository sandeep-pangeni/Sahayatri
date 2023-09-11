<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-80 img-radius" src="assets/images/avatar-4.jpg" alt="User-Profile-Image">
                        <div class="user-details">
                            <span id="more-details"><?= $_SESSION['ausername'] ?></span>
                        </div>
                    </div>
                </div>

                <ul class="pcoded-item pcoded-left-item mt-4">
                    <li class="active">
                        <a href="<?= base_url('index.php') ?>" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                            <span class="pcoded-mtext">Dashboard</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigation-label show d-flex">Pages</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="pcoded-hasmenu active pcoded-trigger">
                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-id-badge"></i><b>A</b></span>
                            <span class="pcoded-mtext">Pages</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="<?= base_url('add-vehicle-category.php') ?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>S</b></span>
                                    <span class="pcoded-mtext">Vehicle Category</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                            <li class="">
                                <a href="<?=base_url('add-vehicle.php') ?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"></span>
                                    <span class="pcoded-mtext">Add Vehicle</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="auth-sign-up.html" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext">Registration</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="sample-page.html" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>S</b></span>
                                    <span class="pcoded-mtext">Sample Page</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
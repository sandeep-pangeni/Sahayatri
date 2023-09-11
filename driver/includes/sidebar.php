<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="<?=base_url()?>"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                    <div class="main-menu-header">
                        <?php
                        $driver_p = $obj->select('drivers', '*', 'id', array($did));
                        $driver_profile =  $driver_p[0]['profile'];
                        ?>

                        <img class="img-80 img-radius" src="<?= file_url($driver_profile) ?>" alt="User-Profile-Image" class="img-thumbnail">
                        <div class="user-details">
                            <span id="more-detailss"><?= $_SESSION['dname'] ?></span>
                            <small class="text-light">Driver</small>
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
                            <span class="pcoded-mtext">Bookings</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="">
                                <a href="<?= base_url('new-bookings.php') ?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>S</b></span>
                                    <span class="pcoded-mtext">New Bookings</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?= base_url('confirmed-bookings.php') ?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"></span>
                                    <span class="pcoded-mtext">Confirmed Bookings</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?= base_url('cancelled-bookings.php') ?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext">Cancelled Bookings</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                            <li class="">
                                <a href="<?= base_url('all-bookings.php') ?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext">All Bookings</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
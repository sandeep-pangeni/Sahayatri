<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?= base_url('') ?>" class="site_title"><i class="fa fa-car"></i> <span>Sahayatri</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <?php
              $image_quer = $obj->select('users', '*', 'id', array($_SESSION['u_id']));
              $username = $image_quer[0]['name'];
              $user_avatar = $image_quer[0]['profile'];
              ?>
              <?php if (!empty($user_avatar)) { ?>
                <img src="<?= file_user_url($user_avatar) ?>" alt="" class="img-circle profile_img">
              <?php } else {  ?>
                <img src="assets/images/empty-user-profile.png" alt="" class="img-circle profile_img">
              <?php } ?>
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2 class="text-capitalize"><?= $username ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <div class="mt-3 mb-4">
                <a href="<?= base_url('') ?>" class="text-info text-nowrap ml-3"> <strong><i class="fa fa-home"> Dashboard</i> </strong>
                </a>
              </div>


              <ul class="nav side-menu">
                <li class="mt-3"><a><i class="fa fa-bar-chart"></i> My Bookings <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu d-block" style="transition:none">
                    <li><a href="<?= base_url('pending-bookings.php') ?>">Pending Bookings</a></li>
                    <li><a href="<?= base_url('confirmed-bookings') ?>">Confirmed Bookings</a></li>
                    <li><a href="<?= base_url('cancelled-bookings.php') ?>">Cancelled Bookings</a></li>
                  </ul>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
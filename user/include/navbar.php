<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    <li class="d-inline-flex position-absolute pt-3"><a href="<?=exit_url('')?>" class="text-primary"> <i class="fa fa-chevron-circle-left"></i> Back to site</a></li>
    <nav class="nav navbar-nav">
      <ul class="navbar-right">
        <li class="nav-item dropdown open" style="padding-left: 15px;">
          <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
            <?php if (!empty($user_avatar)) { ?>
              <img src="<?= file_user_url($user_avatar) ?>" alt="" class="img-circle"> <?= $username ?>
            <?php } else {  ?>
              <img src="assets/images/empty-user-profile.png" alt="" class="img-circle"> <?= $username ?>
            <?php } ?>
          </a>
          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="javascript:;"> Profile</a>
            
            </a>
            <a class="dropdown-item" href="<?= base_url('logout.php') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
          </div>
        </li>

        <li role="presentation" class="nav-item dropdown open">
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->
<?php
$vehicles = $obj->select('category');
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('') ?>"><img src="<?= base_url('assets/images/logo.png') ?>" alt="Sahayatri logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarText">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Vehicle Catagories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php foreach ($vehicles as $key => $value) : ?>
                            <li class="nav-link"><a href="<?= base_url('pages/search.php?id=' . $value['id']) ?>"><?= $value['vname'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>

                <style>
                    input {
                        /* display: block; */
                        /* width: 400px; */
                        /* padding: 0 20px; */
                    }

                    input,
                    input::placeholder {
                        font: 17px/3 sans-serif;
                    }
                </style>

                <li class="nav-item mx-5">
                        <input type="search" class="form-control border border-dark shadow-none" placeholder="Search Vehicles..    &#128269;" id="search_vehicle">
                </li>
            </ul>

            <ul class="navbar-nav mx-auto d-flex justify-content-end">
                <?php
                if (isset($_SESSION['user-status']) == "userLoggedIn") { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            $isUser = $obj->select('users', '*', 'id', array($_SESSION['u_id']));
                            $username = $isUser[0]['name'];
                            $user_avatar = $isUser[0]['profile'];
                            ?>
                            <?php if (!empty($user_avatar)) { ?>
                                <img src="<?= file_user_url($user_avatar) ?>" alt="" class="img-circle">
                            <?php } else {  ?>
                                <img src="assets/images/empty-user-profile.png" alt="" class="img-circle">
                            <?php } ?> <h6 class="d-inline-flex px-2"><?= $username ?></h6>
                            <i class="bi bi-caret-down-fill"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li class="nav-link"><a href="<?= base_url('user') ?>">Dashboard</a></li>
                            <li class="nav-link"><a href="<?= base_url('logout.php') ?>">Logout</a></li>

                        </ul>
                    </li>
                <?php } else { ?>
                    <li class="nav-item dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Login</a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li class="nav-link"><a href="<?= base_url('driver') ?>">Driver</a></li>
                            <li class="nav-link"><a href="<?= base_url('user') ?>">User</a></li>

                        </ul>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</nav>

<div class="list-group" id="show-vehicle-list">
</div>

<script>
    $(document).ready(function() {
        $("#search_vehicle").keyup(function() {
            var searchText = $(this).val();
            if (searchText != '') {
                $.ajax({
                    url: '<?= base_url('pages/recommend.php') ?>',
                    method: 'post',
                    data: {
                        query: searchText
                    },
                    success: function(response) {
                        $("#show-vehicle-list").html(response);
                    }
                });
            } else {

                $("#show-vehicle-list").html('');
            }
        });

        $(document).on('click', 'abbr', function() {
            $("#search_vehicle").val($(this).text());
            $("#show-vehicle-list").html('');
        });
    });
</script>
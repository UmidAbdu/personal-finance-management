<?php
session_start();
$query = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
$select_user_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_user_id)){

    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $profile_picture = $row['profile_picture'];
}
?>
<div class="d-flex flex-column" id="content-wrapper">
    <div id="content">
        <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
            <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                <ul class="navbar-nav flex-nowrap ms-auto">
                    <div class="d-none d-sm-block topbar-divider"></div>
                    <li class="nav-item dropdown no-arrow">
                        <div class="nav-item dropdown no-arrow">
                            <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                <span class="d-none d-lg-inline me-2 text-gray-600 small">
                                    <?=$firstname . ' ' . $lastname?>
                                </span>
                                <img class="border rounded-circle img-profile" src="../img/<?=$profile_picture?>">
                            </a>
                            <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                <a class="dropdown-item" href="../profile.php">
                                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400">
                                    </i>&nbsp;Profile</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
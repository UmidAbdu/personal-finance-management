<?php
include "includes/db.php";
include "includes/header.php";
include "includes/sidebar.php";
include "includes/navigation.php";

    $query = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
    $select_user_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_id)){

        $user_id =$row['user_id'];
        $username = $row['username'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $phone_number = $row['phone_number'];
        $profile_picture = $row['profile_picture'];
        $address = $row['address'];
        $city = $row['city'];
        $country = $row['country'];
    }

if(isset($_POST['save_settings'])){

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    //updating image
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_picture_temp = $_FILES['profile_picture']['tmp_name'];

    move_uploaded_file($profile_picture_temp, "img/$profile_picture");

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}',";
    $query .= "firstname = '{$firstname}',";
    $query .= "lastname = '{$lastname}',";
    $query .= "email = '{$email}', ";
    $query .= "profile_picture = '{$profile_picture}' ";
    $query .= "WHERE user_id = {$_SESSION['user_id'] }";

    $update_user = mysqli_query($connection, $query);

    if(!$update_user){
        die('QUERY FAILED ' . mysqli_error($connection));
    }
}

if(isset($_POST['contact_settings'])){

    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $query = "UPDATE users SET ";
    $query .= "address = '{$address}', ";
    $query .= "city = '{$city}', ";
    $query .= "country = '{$country}' ";
    $query .= "WHERE user_id = {$_SESSION['user_id']}";

    $update_contacts = mysqli_query($connection, $query);

    if(!$update_contacts){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4"><?=$lang['profile']?></h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body text-center shadow">
                    <img class="rounded-circle mb-3 mt-4" src="img/<?=$profile_picture?>" width="160" height="160">
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm" type="button" onclick="document.getElementById('getFile').click()"><?=$lang['changePhoto']?></button>
                        <input type='file' id="getFile" name="profile_picture" style="display:none">
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="text-primary fw-bold m-0">Projects</h6>
                </div>
                <div class="card-body">
                    <h4 class="small fw-bold">Server migration<span class="float-end">20%</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="visually-hidden">20%</span></div>
                    </div>
                    <h4 class="small fw-bold">Sales tracking<span class="float-end">40%</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="visually-hidden">40%</span></div>
                    </div>
                    <h4 class="small fw-bold">Customer Database<span class="float-end">60%</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="visually-hidden">60%</span></div>
                    </div>
                    <h4 class="small fw-bold">Payout Details<span class="float-end">80%</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="visually-hidden">80%</span></div>
                    </div>
                    <h4 class="small fw-bold">Account setup<span class="float-end">Complete!</span></h4>
                    <div class="progress progress-sm mb-3">
                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">100%</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row mb-3 d-none">
                <div class="col">
                    <div class="card textwhite bg-primary text-white shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card textwhite bg-success text-white shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold"><?=$lang['userSettings']?></p>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="username">
                                                <strong><?=$lang['username_holder']?></strong>
                                            </label>
                                            <input class="form-control" type="text" id="username" value="<?=$username?>" name="username">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="email">
                                                <strong><?=$lang['email_holder']?></strong></label>
                                            <input class="form-control" type="email" id="email" value="<?=$email?>" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="first_name">
                                                <strong><?=$lang['firstname_holder']?></strong>
                                            </label>
                                            <input class="form-control" type="text" id="first_name" value="<?=$firstname?>" name="firstname">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="last_name">
                                                <strong><?=$lang['Lastname_holder']?></strong>
                                            </label>
                                            <input class="form-control" type="text" id="last_name" value="<?=$lastname?>" name="lastname">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"><input class="btn btn-primary btn-sm" type="submit" name="save_settings" value="<?=$lang['saveSettings']?>"></div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold"><?=$lang['contactSetting']?></p>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="mb-3">
                                    <label class="form-label" for="address">
                                        <strong><?=$lang['address']?></strong>
                                    </label>
                                    <input class="form-control" type="text" id="address" value="<?=$address?>" name="address">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="city">
                                                <strong><?=$lang['city']?></strong>
                                            </label>
                                            <input class="form-control" type="text" id="city" value="<?=$city?>" name="city">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="country">
                                                <strong><?=$lang['country']?></strong>
                                            </label>
                                            <input class="form-control" type="text" id="country" value="<?=$country?>" name="country">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3"><input class="btn btn-primary btn-sm" type="submit" name="contact_settings" value="<?=$lang['saveSettings']?>">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<?php
include "includes/footer.php";
?>
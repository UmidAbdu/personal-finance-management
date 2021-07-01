<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>
<?php
include "includes/db.php";
$first_name = '';
$username = '';
$password = '';
$confirm_password = '';
$phone_number = '';
$email = '';


$isFirstnameValid = true;
$isUserNameValid = true;
$isPasswordValid = true;
$isNewPasswordValid = true;
$isPhoneNumberValid = true;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //taking data from form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['password_repeat'];

    //validation using regex
    $isNameValid = preg_match("/[A-Za-z]{2,20}/", $first_name);
    $isLastnameValid = preg_match("/[A-Za-z]{2,20}/", $last_name);
    $isUserNameValid = preg_match("/^[a-z0-9_-]{3,16}/", $username);
    $isPasswordValid = preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password); //at least one letter and one number
    $isNewPasswordValid = $password == $confirm_password;
    $isMobilePhoneValid = preg_match("/^(\+)?([ 0-9]){5,16}$/", $phone_number);
    $isEmailValid = preg_match("/^[A-Za-z0-9+_.-]+@(.+)$/", $email);

    $isValid = ($isNameValid and $isLastnameValid and $isUserNameValid and $isPasswordValid and $isNewPasswordValid
    and $isMobilePhoneValid and $isEmailValid);

    echo $isValid;

    if ($isValid) {
        //inserting new user into database
        $query = "INSERT INTO users(firstname, lastname, username, phone_number, email, password) ";
        $query .= "VALUES('{$first_name}', '{$last_name}','{$username}', '{$phone_number}', '{$email}', '{$password}' )";

        $insert_user = mysqli_query($connection, $query);

        //checking connection
        if (!$insert_user) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
}

?>
<body class="bg-gradient-primary">
<div class="container">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex">
                    <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;image2.jpeg&quot;);"></div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h4 class="text-dark mb-4">Create an Account!</h4>
                        </div>
                        <form action="" class="user" method="post">
                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="First Name" name="first_name" required>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-user" type="text" id="exampleLastName" placeholder="Last Name" name="last_name" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address" name="email" required>
                                    <span class="<?=$isEmailValid? '' : 'is-invalid'?>"></span>
                                    <div class="invalid-feedback">
                                        Please, enter valid email
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-user" type="tel" placeholder="Phone number" name="phone_number" required>
                                    <span class="<?= $isPhoneNumberValid? '' : 'is-invalid' ?>"></span>
                                    <div class="invalid-feedback">
                                        Please, enter valid phone number
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input class="form-control form-control-user" type="text" id="exampleFirstName" placeholder="Username" name="username" required>
                                <span class="<?= $isUserNameValid? '' : 'is-invalid' ?>"></span>
                                <div class="invalid-feedback">
                                    Username should contain at least 5 characters
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input class="form-control form-control-user" type="password" id="examplePasswordInput" placeholder="Password" name="password" required>
                                    <span class="<?= $isPasswordValid? '' : 'is-invalid' ?>"></span>
                                    <div class="invalid-feedback">
                                        Password should contain at least 8 characters and one letter, one number
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-user" type="password" id="exampleRepeatPasswordInput" placeholder="Repeat Password" name="password_repeat" required>
                                    <span class="<?= $isNewPasswordValid? '' : 'is-invalid' ?>"></span>
                                    <div class="invalid-feedback">
                                        Password did not match
                                    </div>
                                </div>
                            </div><input class="btn btn-primary d-block btn-user w-100" type="submit" name="register" value="Register Account">
                            <hr>
                        </form>
                        <div class="text-center"><a class="small" href="forgot-password.html">Forgot Password?</a></div>
                        <div class="text-center"><a class="small" href="login.php">Already have an account? Login!</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="assets/js/theme.js"></script>
</body>

</html>
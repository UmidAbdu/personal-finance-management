<?php
ob_start();
session_start();
//include "includes/header.php";
include "includes/db.php";
include "functions.php";

if(isset($_GET['lang']) and !empty($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang'];

    if(isset($_SESSION['lang']) and $_SESSION['lang'] != $_GET['lang']){
        echo "<script type='text/javascript'> location.reload(); </script>";
    }

    if(isset($_SESSION['lang'])){
        include "languages/" . $_SESSION['lang'] . ".php";
    } else {
        include "languages/ru.php";
    }
} else{
    include "languages/ru.php";
}


if(isset($_POST['login'])){
$username = escape($_POST['username']);
$password = escape($_POST['password']);

$query = "SELECT * FROM users WHERE username = '{$username}'";
$select_user_query = mysqli_query($connection, $query);
$row = mysqli_fetch_array($select_user_query);
if(isset($row)){
   //  $row = mysqli_fetch_array($select_user_query);
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_email = $row['email'];
        $db_user_password = $row['password'];
        $db_user_firstname = $row['firstname'];
        $db_user_lastname = $row['lastname'];
        $db_user_picture = $row['profile_picture'];
    if($username === $db_username and $password === $db_user_password){
        $_SESSION['user_id'] = $db_id;
        $_SESSION['username'] = $db_username;
        header("Location:index.php");
    }else{
        echo "<p class='bg-danger text-white shadow' >Неправильный логин или пароль</p>";
    }
} else{
    echo "<p class='bg-danger text-white shadow' >Неправильный логин или пароль</p>";
}

}



?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?=$lang['title']?></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;img/image3.jpeg&quot;);"></div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                </div>
                                <div class="p-5">
                                    <form method="get" action=""  id="language-form">
                                    <select name="lang" class="form-control" onchange="changeLanguage()">
                                        <option value="ru" <?php if(isset($_SESSION['lang']) and $_SESSION['lang'] == 'ru'){echo "selected";} ?>>русский</option>
                                        <option value="eng" <?php if(isset($_SESSION['lang']) and $_SESSION['lang'] == 'eng'){echo "selected";} ?>>english</option>
                                    </select>
                                    </form>
                                    <div class="text-center">
                                        <br>
                                        <h4 class="text-dark mb-4"><?=$lang['login']?></h4>
                                        <br>
                                    </div>
                                    <form action="" class="user" method="post">
                                        <div class="mb-3"><input class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="<?=$lang['pholder']?>" name="username" required></div>
                                        <br>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="<?=$lang['pholerp']?>" name="password" required</div>
                                        <div class="mb-3">

                                            <br>
                                            <br>

                                        </div><input class="btn btn-primary d-block btn-user w-100" type="submit" name="login" value="<?=$lang['btnlog']?>">

                                        <br>

                                    </form>
                                    <div class="text-center"><a class="small" href="register.php"><?=$lang['create_account']?></a></div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeLanguage(){
            document.getElementById('language-form').submit();
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
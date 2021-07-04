<?php
session_start();
$query = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
$select_user_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_user_id)){

    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $profile_picture = $row['profile_picture'];
}

if (isset($_POST['submit'])){
    $type = $_POST['type'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $comment = $_POST['comment'];

    $query = "INSERT INTO transactions ( transaction_type, amount, t_date, category, comment) 
    VALUES ( '{$type}', '{$amount}', now(), '{$category}', '{$comment}')";

    $send_query = mysqli_query($connection, $query);

    if(!$send_query){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}
?>
<div class="d-flex flex-column" id="content-wrapper">
    <div id="content">
        <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
            <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                <form action="" method="post">
                    <style>
                        .show {
                            display: block;
                        }

                        .hide {
                            display: none;
                        }
                    </style>
                    <select name="type" id="list" onchange="jumb()">
                        <option id='dis'>select type:</option>
                        <option value="income" >income</option>
                        <option value="expense">expense</option>
                    </select>
                    <select name="category" class="sel-1" id="list-2">
                        <option  id="dis"></option>
                        <option value="salary " class="income">Salary</option>
                        <option value="inc " class="income">Income</option>
                        <option value="food" class="expense">Food</option>
                        <option value="transport " class="expense">Transport</option>
                        <option value="mobile " class="expense">Mobile</option>
                        <option value="internet " class="expense">Internet</option>
                        <option value="fun " class="expense">Fun</option>
                        <option value="other" class="expense">Other</option>
                    </select>

                    <script>
                        function jumb() {
                            let a = document.getElementById('list').value;
                            let len = document.getElementsByClassName('sel-1')[0].length //9ta
                            for (let i = 0; i < len; i++) {
                                document.getElementsByClassName('sel-1')[0][0].style.display = 'none'
                                let set = document.getElementsByClassName('sel-1')[0][i]
                                if (set.className == a) {
                                    set.classList.toggle("show")
                                } else {
                                    set.classList.toggle("hide")
                                }
                                document.getElementById('list-2').value = ''
                            }
                            document.getElementById('dis').style.display = 'none'

                        }
                    </script>
                <input style="margin-right: 5px" type="number" name="amount" placeholder="amount" required>
                    <input type="text" name="comment" placeholder="comment">
                <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                </form>
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
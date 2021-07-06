<?php
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
    $comment = escape($_POST['comment']);

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
                    <select name="type" id="list" onchange="jumb()" required>
                        <option id='dis' disabled selected value ><?=$lang['type']?></option>
                        <option value="income" ><?=$lang['income']?></option>
                        <option value="expense"><?=$lang['expense']?></option>
                    </select>
                    <select name="category" class="sel-1" id="list-2" required>
                        <option  id="dis" disabled selected value><?=$lang['category']?></option>
                        <option value="salary " class="income"><?=$lang['salary']?></option>
                        <option value="inc " class="income"><?=$lang['inc']?></option>
                        <option value="food" class="expense"><?=$lang['food']?></option>
                        <option value="transport " class="expense"><?=$lang['transport']?></option>
                        <option value="mobile " class="expense"><?=$lang['mobile']?></option>
                        <option value="internet " class="expense"><?=$lang['internet']?></option>
                        <option value="fun " class="expense"><?=$lang['fun']?></option>
                        <option value="other" class="expense"><?=$lang['other']?></option>
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
                <input style="margin-right: 5px" type="number" min="1000" name="amount" placeholder="<?=$lang['amount']?>" required>
                    <input type="text" name="comment" placeholder="<?=$lang['comment']?>">
                <input class="btn btn-primary" type="submit" value="<?=$lang['submit']?>" name="submit">
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
                                    </i>&nbsp;<?=$lang['profile']?></a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" href="../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;<?=$lang['logout']?></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
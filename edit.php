<?php
include "includes/db.php";
include "includes/header.php";
include "includes/sidebar.php";

$id = $_GET['edit'];

$query = "SELECT * FROM transactions WHERE transaction_id = {$id}";
$select_action = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_action)){
$transaction_id = $row['transaction_id'];
$amount = $row['amount'];
$type = $row['transaction_type'];
$category = $row['category'];
$date = $row['t_date'];
$comment = $row['comment'];

}

if(isset($_POST['update']))
{
    if (isset($_POST['update'])){

        $type = $_POST['type'];
        $category = escape($_POST['category']);
        $input_date=$_POST['date'];
        $date=date("Y-m-d",strtotime($input_date));
        $amount = $_POST['amount'];
        $comment  = $_POST['comment'];

        $query = "UPDATE transactions SET ";
        $query .= "transaction_type = '{$type}', ";
        $query .= "category = '{$category}', ";
        $query .= "t_date = '{$date}', ";
        $query .= "amount = '{$amount}', ";
        $query .= "comment = '{$comment}' ";
        $query .= "WHERE transaction_id = '{$id}' ";

        header("Location:table.php");

    }


    $edit = mysqli_query($connection,$query);

    if(!$edit){
        die('QUERY FAILED' . mysqli_error($connection));
    }
}
?>

<div class="container-fluid">
    <br>
    <br>
    <h3 class="text-dark mb-4"><?=$lang['update']?></h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold"><?=$lang['edit']?></p>
        </div>
        <div class="card-body">
            <div class="row">

                <form method="POST">
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
                        <option value="income"
                        <?php
                        if($type == 'income'){
                            echo 'selected';
                        }
                        ?>
                        ><?=$lang['income']?></option>
                        <option value="expense"
                            <?php
                            if($type == 'expense'){
                                echo 'selected';
                            }
                            ?>
                        ><?=$lang['expense']?></option>
                    </select>
                    <select name="category" class="sel-1" id="list-2" required>
                        <option  id="dis" disabled selected value><?=$lang['category']?></option>
                        <option value="salary" class="income"
                        <?php
                        if($category == 'salary'){
                            echo 'selected';
                        }
                        ?>
                        ><?=$lang['salary']?></option>
                        <option value="inc" class="income"
                            <?php
                            if($category == 'inc'){
                                echo 'selected';
                            }
                            ?>
                        ><?=$lang['inc']?></option>
                        <option value="food" class="expense"
                            <?php
                            if($category == 'food'){
                                echo 'selected';
                            }
                            ?>
                        ><?=$lang['food']?></option>
                        <option value="transport" class="expense"
                            <?php
                            if($category == 'transport'){
                                echo 'selected';
                            }
                            ?>
                        ><?=$lang['transport']?></option>
                        <option value="mobile" class="expense"
                            <?php
                            if($category == 'mobile'){
                                echo 'selected';
                            }
                            ?>
                        ><?=$lang['mobile']?></option>
                        <option value="internet" class="expense"
                            <?php
                            if($category == 'internet'){
                                echo 'selected';
                            }
                            ?>
                        ><?=$lang['internet']?></option>
                        <option value="fun" class="expense"
                            <?php
                            if($category == 'fun'){
                                echo 'selected';
                            }
                            ?>
                        ><?=$lang['fun']?></option>
                        <option value="other" class="expense"
                            <?php
                            if($category == 'other'){
                                echo 'selected';
                            }
                            ?>
                        ><?=$lang['other']?></option>
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
                    <input type="date" name="date" value="<?=$date?>">
                    <input type="number" name="amount" value="<?=$amount?>" required>
                    <input type="text" name="comment" value="<?=$comment?>">
                    <input type="submit" name="update" value="<?=$lang['edit']?>">
                </form>
                <div class="row">
                    <div class="col-md-6 align-self-center">
                    </div>
                    <div class="col-md-6">
                        <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


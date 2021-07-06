<?php
include "includes/db.php";

$months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$dictionary = array(null, null, null,null,null,null,null,null,null,null,null,null);
$previous= 0;
$lp = range(0, date('m')-1);
//print_r($lp);
foreach ($lp as $i) {
    $query = "SELECT * FROM transactions WHERE monthname(t_date) = '{$months[$i]}'";
    $select_month = mysqli_query($connection, $query);
    $temp = 0;
    while ($row = mysqli_fetch_assoc($select_month)){

        $type = $row['transaction_type'];
        if($type == 'income') {
            $temp += $row['amount'];
        } else{
            $temp -= $row['amount'];
        }
    }
    $temp += $previous;
$dictionary[$i] = $temp;
$previous = $temp;
echo $temp;
}
print_r($dictionary);

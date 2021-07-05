
<?php
include("includes/db.php");

$query = "SELECT * FROM transactions ORDER BY t_date DESC";
if (!$result = mysqli_query($connection, $query)) {
    exit(mysqli_error($connection));
}

$transactions = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $transactions[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=transactions.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('ID', 'Type', 'category', 'amount', 'data', 'comment'));

if (count($transactions) > 0) {
    foreach ($transactions as $row) {
        fputcsv($output, $row);
    }
}
?>
<?php
include "includes/db.php";
include "includes/header.php";
include "includes/sidebar.php";
include "includes/navigation.php";

$query = "SELECT * FROM transactions";

$select_transaction = mysqli_query($connection, $query);

if(!$select_transaction)
{
    die('QUERY FAILED' . mysqli_error($connection));
}
$amount = 0;

while ($row = mysqli_fetch_assoc($select_transaction)){

    $type = $row['transaction_type'];
    if($type == 'income') {
        $amount += $row['amount'];
    } else{
        $amount -= $row['amount'];
    }
}


?>

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0"><?=$lang['dashboard']?></h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="export.php"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;<?=$lang['generate']?></a>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span><?=$lang['currentBalance']?></span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span><?=number_format($amount, '2', '.', ' ') ?></span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-balance-scale fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <?php

                                $query = "SELECT amount FROM transactions WHERE transaction_type = 'expense' ";
                                $select_expenses = mysqli_query($connection, $query);

                                $expense = 0;

                                while ($row = mysqli_fetch_assoc($select_expenses)){
                                    $expense += $row['amount'];
                                }

                                ?>
                                <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span><?=$lang['totalExpenses']?></span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span><?=number_format($expense,'2', '.', ' ')?></span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-shopping-bag fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-info py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <?php

                                $query = "SELECT amount, category FROM transactions WHERE transaction_type = 'expense' AND 
                                             MONTH(t_date) = MONTH(CURRENT_DATE()) AND YEAR(t_date) = YEAR(CURRENT_DATE())";
                                $select_incomes = mysqli_query($connection, $query);

                                $expenses = 0;

                                while ($row = mysqli_fetch_assoc($select_incomes)){
                                    $expenses += $row['amount'];
                                }

                                ?>
                                <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span><?=$lang['monthlyExpense']?></span></div>
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto">
                                        <div class="text-dark fw-bold h5 mb-0 me-3"><span><?=number_format($expenses, '2', '.', ' ')?></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto"><i class="fas fa-money-bill fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <div class="card shadow border-start-warning py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <?php

                                $query = "SELECT * FROM transactions WHERE MONTH(t_date) = MONTH(CURRENT_DATE()) AND 
                                            YEAR(t_date) = YEAR(CURRENT_DATE()) AND transaction_type = 'income'" ;
                                $select_monthly = mysqli_query($connection, $query);

                                $monthly = 0;

                                while ($row = mysqli_fetch_assoc($select_monthly)){
                                    $monthly += $row['amount'];
                                }

                                ?>
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span><?=$lang['monthlyIncome']?></span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span><?=number_format($monthly, '2', '.', ' ')?></span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-xl-8">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0"><?=$lang['earningsOverview']?></h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <?php
                            $query = "SELECT * FROM transactions WHERE monthname(t_date) = 'January'";
                            $select_jan = mysqli_query($connection, $query);
                            $jan = 0;

                            while ($row = mysqli_fetch_assoc($select_jan)){

                                $type = $row['transaction_type'];
                                if($type == 'income') {
                                    $jan += $row['amount'];
                                } else{
                                    $jan -= $row['amount'];
                                }
                            }

                            $query = "SELECT * FROM transactions WHERE monthname(t_date) = 'February'";
                            $select_feb = mysqli_query($connection, $query);
                            $feb = $jan;

                            while ($row = mysqli_fetch_assoc($select_feb)){

                                $type = $row['transaction_type'];
                                if($type == 'income') {
                                    $feb += $row['amount'];
                                } else{
                                    $feb -= $row['amount'];
                                }
                            }

                            $query = "SELECT * FROM transactions WHERE monthname(t_date) = 'March'";
                            $select_march = mysqli_query($connection, $query);
                            $march = $feb;

                            while ($row = mysqli_fetch_assoc($select_march)){

                                $type = $row['transaction_type'];
                                if($type == 'income') {
                                    $march += $row['amount'];
                                } else{
                                    $march -= $row['amount'];
                                }
                            }

                            $query = "SELECT * FROM transactions WHERE monthname(t_date) = 'April'";
                            $select_april = mysqli_query($connection, $query);
                            $april = $march;

                            while ($row = mysqli_fetch_assoc($select_april)){

                                $type = $row['transaction_type'];
                                if($type == 'income') {
                                    $april += $row['amount'];
                                } else{
                                    $april -= $row['amount'];
                                }
                            }

                            $query = "SELECT * FROM transactions WHERE monthname(t_date) = 'May'";
                            $select_may = mysqli_query($connection, $query);
                            $may = $april;

                            while ($row = mysqli_fetch_assoc($select_may)){

                                $type = $row['transaction_type'];
                                if($type == 'income') {
                                    $may += $row['amount'];
                                } else{
                                    $may -= $row['amount'];
                                }
                            }

                            $query = "SELECT * FROM transactions WHERE monthname(t_date) = 'June'";
                            $select_june = mysqli_query($connection, $query);
                            $june = $may;

                            while ($row = mysqli_fetch_assoc($select_june)){

                                $type = $row['transaction_type'];
                                if($type == 'income') {
                                    $june += $row['amount'];
                                } else{
                                    $june -= $row['amount'];
                                }
                            }

                            $query = "SELECT * FROM transactions WHERE monthname(t_date) = 'July'";
                            $select_july = mysqli_query($connection, $query);
                            $july = $june;

                            while ($row = mysqli_fetch_assoc($select_july)){

                                $type = $row['transaction_type'];
                                if($type == 'income') {
                                    $july += $row['amount'];
                                } else{
                                    $july -= $row['amount'];
                                }
                            }

                            ?>
                            <canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{
                                        &quot;labels&quot;: [&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;, &quot;Sep&quot;,  &quot;Oct&quot;,  &quot;Nov&quot;,  &quot;Dec&quot;],
                                        &quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;<?=$jan?>&quot;,&quot;<?=$feb?>&quot;,&quot;<?=$march?>&quot;,&quot;<?=$april?>&quot;,&quot;<?=$may?>&quot;,&quot;<?=$june?>&quot;,&quot;<?=$july?>&quot;],
                                        &quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},
                                        &quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,
                                        &quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},
                                        &quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,
                                        &quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,
                                        &quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],
                                        &quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}],
                                        &quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,
                                        &quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},
                                        &quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;padding&quot;:20}}]}}}"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="text-primary fw-bold m-0"><?=$lang['expenses']?></h6>

                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <?php

                            $query = "SELECT * FROM transactions WHERE transaction_type = 'expense'";
                            $select_all_expenses = mysqli_query($connection, $query);

                            $food = 0;
                            $transport = 0;
                            $mobile = 0;
                            $internet = 0;
                            $fun = 0;
                            $other = 0;

                            while ($row = mysqli_fetch_assoc($select_all_expenses)){
                                $category = $row['category'];
                                if($category == 'food'){
                                    $food += $row['amount'];
                                } elseif ($category == 'transport'){
                                    $transport += $row['amount'];
                                } elseif ($category == 'mobile'){
                                    $mobile += $row['amount'];
                                } elseif ($category == 'internet'){
                                    $internet += $row['amount'];
                                } elseif ($category == 'fun'){
                                    $fun += $row['amount'];
                                } else{
                                    $other += $row['amount'];
                                }
                            }

                            $all = $food + $transport + $mobile + $internet + $fun + $other;

                            $pfood = number_format($food / $all * 100);
                            $ptransport = number_format($transport / $all * 100);
                            $pmobile = number_format($mobile / $all * 100);
                            $pinternet = number_format($internet / $all * 100);
                            $pfun = number_format($fun / $all * 100);
                            $pother = number_format($other / $all * 100);

                            ?>
                            <canvas data-bss-chart="
                                                {&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:
                                                {&quot;labels&quot;:
                                                [&quot;<?=$lang['food']?>&quot;,&quot;<?=$lang['transport']?>&quot;,&quot;<?=$lang['mobile']?>&quot;,&quot;<?=$lang['internet']?>&quot;,&quot;<?=$lang['fun']?>&quot;,&quot;<?=$lang['other']?>&quot;],&quot;datasets&quot;:
                                                [{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:
                                                [&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;,&quot;#f6c23e&quot;, &quot;#e74a3b&quot;,&quot;#858796&quot;],&quot;borderColor&quot;:
                                                [&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:
                                                [&quot;<?=$pfood?>&quot;,&quot;<?=$ptransport?>&quot;,&quot;<?=$pmobile?>&quot;,&quot;<?=$pinternet?>&quot;,&quot;<?=$pfun?>&quot;,&quot;<?=$pother?>&quot;]}]},&quot;options&quot;:
                                                {&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:
                                                {&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}">

                            </canvas>
                        </div>
                        <div class="text-center small mt-4">
                                        <span class="me-2">
                                            <i class="fas fa-circle text-primary"></i>
                                            &nbsp;<?=$lang['food']?>
                                        </span>
                            <span class="me-2">
                                            <i class="fas fa-circle text-success"></i>
                                            &nbsp;<?=$lang['transport']?>
                                        </span>
                            <br>
                            <span class="me-2">
                                            <i class="fas fa-circle text-info">
                                            </i>
                                            &nbsp;<?=$lang['mobile']?>
                                        </span>
                            <span class="me-2">
                                            <i class="fas fa-circle text-warning"></i>
                                            &nbsp;<?=$lang['internet']?>
                                        </span>
                            <br>
                            <span class="me-2">
                                            <i class="fas fa-circle text-danger"></i>
                                            &nbsp;<?=$lang['fun']?>
                                        </span>
                            <span class="me-2">
                                            <i class="fas fa-circle text-secondary"></i>
                                            &nbsp;<?=$lang['other']?>
                                        </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="text-primary fw-bold m-0"><?=$lang['income']?></h6>
                    </div>
                    <?php

                    $query = "SELECT * FROM transactions WHERE transaction_type = 'income' ";
                    $select_expenses = mysqli_query($connection, $query);

                    $salary = 0;
                    $inc = 0;

                    while ($row = mysqli_fetch_assoc($select_expenses)){
                        $cat = $row['category'];
                        if($cat == 'salary'){
                            $salary += $row['amount'];
                        } else{
                            $inc += $row['amount'];
                        }
                    }

                    ?>
                    <div class="card-body">
                        <h4 class="small fw-bold"><?=$lang['salary']?><span class="float-end"><?=number_format($salary,'2', '.', ' ') . ' UZS'?></span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">80%</span></div>
                        </div>
                        <h4 class="small fw-bold"><?=$lang['inc']?><span class="float-end"><?=number_format($inc,'2', '.', ' '). ' UZS'?></span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">100%</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card textwhite bg-primary text-white shadow">
                            <div class="card-body">
                                <p class="m-0"><?=$lang['food']?></p>
                                <p class="text-white-90 small m-0"><?=number_format($food,'2', '.', ' ') . ' UZS'?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card textwhite bg-success text-white shadow">
                            <div class="card-body">
                                <p class="m-0"><?=$lang['transport']?></p>
                                <p class="text-white-90 small m-0"><?=number_format($transport,'2', '.', ' ') . ' UZS'?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card textwhite bg-info text-white shadow">
                            <div class="card-body">
                                <p class="m-0"><?=$lang['mobile']?></p>
                                <p class="text-white-90 small m-0"><?=number_format($mobile,'2', '.', ' ') . ' UZS'?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card textwhite bg-warning text-white shadow">
                            <div class="card-body">
                                <p class="m-0"><?=$lang['internet']?></p>
                                <p class="text-white-90 small m-0"><?=number_format($internet,'2', '.', ' ') . ' UZS'?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card textwhite bg-danger text-white shadow">
                            <div class="card-body">
                                <p class="m-0"><?=$lang['fun']?></p>
                                <p class="text-white-90 small m-0"><?=number_format($fun,'2', '.', ' ') . ' UZS'?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card textwhite bg-secondary text-white shadow">
                            <div class="card-body">
                                <p class="m-0"><?=$lang['other']?></p>
                                <p class="text-white-90 small m-0"><?=number_format($other,'2', '.', ' ') . ' UZS'?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php include "includes/footer.php"; ?>
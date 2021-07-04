<?php
ob_start();
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
                        <h3 class="text-dark mb-0"><?=$type?></h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Current Balance</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?=number_format($amount)?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
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
                                            <div class="text-uppercase text-danger fw-bold text-xs mb-1"><span>total expenses</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?=number_format($expense)?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
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

                                            $query = "SELECT amount, category FROM transactions WHERE transaction_type = 'income' ";
                                            $select_expenses = mysqli_query($connection, $query);

                                            $income = 0;
                                            $salary = 0;
                                            $inc = 0;

                                            while ($row = mysqli_fetch_assoc($select_expenses)){
                                                $income += $row['amount'];
                                                $cat = $row['category'];
                                                if($cat == 'salary'){
                                                    $salary += $row['amount'];
                                                } else{
                                                    $inc += $row['amount'];
                                                }
                                            }

                                            ?>
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total earnings</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span><?=number_format($income)?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
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

                                            $query = "SELECT amount FROM transactions WHERE transaction_type = 'income' ";
                                            $select_expenses = mysqli_query($connection, $query);

                                            $income = 0;

                                            while ($row = mysqli_fetch_assoc($select_expenses)){
                                                $income += $row['amount'];
                                            }

                                            ?>
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Pending Requests</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>18</span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-xl-8">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary fw-bold m-0">Earnings Overview</h6>
                                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{
                                        &quot;labels&quot;: [&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;, &quot;Sep&quot;,  &quot;Oct&quot;,  &quot;Nov&quot;,  &quot;Dec&quot;],
                                        &quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;72000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],
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
                                    <h6 class="text-primary fw-bold m-0">Expenses(%)</h6>

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
                                                [&quot;Food&quot;,&quot;Transport&quot;,&quot;Mobile&quot;,&quot;Internet&quot;,&quot;Fun&quot;,&quot;Other&quot;],&quot;datasets&quot;:
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
                                            &nbsp;Food
                                        </span>
                                        <span class="me-2">
                                            <i class="fas fa-circle text-success"></i>
                                            &nbsp;Transport
                                        </span>
                                        <span class="me-2">
                                            <i class="fas fa-circle text-info">
                                            </i>
                                            &nbsp;Mobile
                                        </span>
                                        <span class="me-2">
                                            <i class="fas fa-circle text-warning"></i>
                                            &nbsp;Internet
                                        </span>
                                        <span class="me-2">
                                            <i class="fas fa-circle text-danger"></i>
                                            &nbsp;Fun
                                        </span>
                                        <span class="me-2">
                                            <i class="fas fa-circle text-secondary"></i>
                                            &nbsp;Other
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
                                    <h6 class="text-primary fw-bold m-0">Income</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small fw-bold">Salary<span class="float-end"><?=number_format($salary) . ' UZS'?></span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">80%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Income<span class="float-end"><?=number_format($inc). ' UZS'?></span></h4>
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
                                            <p class="m-0">Food</p>
                                            <p class="text-white-90 small m-0"><?=number_format($food) . ' UZS'?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card textwhite bg-success text-white shadow">
                                        <div class="card-body">
                                            <p class="m-0">Transport</p>
                                            <p class="text-white-90 small m-0"><?=number_format($transport) . ' UZS'?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card textwhite bg-info text-white shadow">
                                        <div class="card-body">
                                            <p class="m-0">Mobile</p>
                                            <p class="text-white-90 small m-0"><?=number_format($mobile) . ' UZS'?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card textwhite bg-warning text-white shadow">
                                        <div class="card-body">
                                            <p class="m-0">Internet</p>
                                            <p class="text-white-90 small m-0"><?=number_format($internet) . ' UZS'?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card textwhite bg-danger text-white shadow">
                                        <div class="card-body">
                                            <p class="m-0">Fun</p>
                                            <p class="text-white-90 small m-0"><?=number_format($fun) . ' UZS'?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div class="card textwhite bg-secondary text-white shadow">
                                        <div class="card-body">
                                            <p class="m-0">Other</p>
                                            <p class="text-white-90 small m-0"><?=number_format($other) . ' UZS'?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php include "includes/footer.php"; ?>
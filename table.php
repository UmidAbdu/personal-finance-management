<?php
include "includes/db.php";
include "includes/header.php";
include "includes/sidebar.php";
include "includes/navigation.php";
;?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4"><?=$lang['history']?></h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold"><?=$lang['transactions']?></p>
                        </div>
                        <div class="card-body">
                            <div class="row">


                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th><?=$lang['type']?></th>
                                            <th><?=$lang['category']?></th>
                                            <th><?=$lang['date']?></th>
                                            <th><?=$lang['amount']?></th>
                                            <th><?=$lang['total']?></th>
                                            <th><?=$lang['comment']?></th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $query = "SELECT * FROM transactions WHERE MONTH(t_date) = MONTH(CURRENT_DATE())
                                    AND YEAR(t_date) = YEAR(CURRENT_DATE()) ORDER BY t_date ASC";
                                    $select_action = mysqli_query($connection, $query);

                                    $balance = 0;

                                    while ($row = mysqli_fetch_assoc($select_action)){
                                        $amount = $row['amount'];
                                        $type = $row['transaction_type'];
                                        $category = $row['category'];
                                        $date = $row['t_date'];
                                        $comment = $row['comment'];


                                        if($type == 'income'){
                                            $balance += $row['amount'];
                                        } else{
                                            $balance -= $row['amount'];
                                        }

                                        ?>
                                    <tbody>
                                        <tr>
                                            <td><?=$type?></td>
                                            <td><?=$category?></td>
                                            <td><?=$date?></td>
                                            <td><?=number_format($amount) . ' UZS'?></td>
                                            <td><?=number_format($balance) . ' UZS'?></td>
                                            <td><?=substr($comment,0,20)?></td>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                                    <tfoot>
                                        <tr>
                                            <td><strong><?=$lang['type']?></strong></td>
                                            <td><strong><?=$lang['category']?></strong></td>
                                            <td><strong><?=$lang['date']?></strong></td>
                                            <td><strong><?=$lang['amount']?></strong></td>
                                            <td><strong><?=$lang['total']?></strong></td>
                                            <td><strong><?=$lang['comment']?></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Finance 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
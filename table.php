<?php
include "includes/db.php";
include "includes/header.php";
include "includes/sidebar.php";
include "includes/navigation.php";
;?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">History</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Transactions</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>

                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Total</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <?php

                                    $query = "SELECT * FROM transactions ORDER BY transaction_id DESC ";
                                    $select_action = mysqli_query($connection, $query);


                                    while ($row = mysqli_fetch_assoc($select_action)){
                                        $amount = $row['amount'];
                                        $type = $row['transaction_type'];
                                        $category = $row['category'];
                                        $date = $row['t_date'];
                                        $comment = $row['comment'];


                                        ?>
                                    <tbody>
                                        <tr>
                                            <td><?=$type?></td>
                                            <td><?=$category?></td>
                                            <td><?=$date?></td>
                                            <td><?=$amount?></td>
                                            <td>total</td>
                                            <td><?=$comment?></td>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Type</strong></td>
                                            <td><strong>Category</strong></td>
                                            <td><strong>Data</strong></td>
                                            <td><strong>Amount</strong></td>
                                            <td><strong>Total</strong></td>
                                            <td><strong>Comment</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
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
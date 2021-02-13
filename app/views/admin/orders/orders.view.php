<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders Managements</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/CustomerOrders/">Orders Managements</a> </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title" style="line-height: 2;">Orders List </h3>
                                </div>
                                <div class="col-6">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="users-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order Reference</th>
                                        <th>Payment Method</th>
                                        <th>Number of Items</th>
                                        <th>Order Date</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Order Status</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['orders'] as $order) { ?>
                                        <tr>
                                            <td style="text-align:center"><?php echo ($order->id); ?></td>
                                            <td style="text-align:center"><?php echo ($order->order_refer); ?></td>
                                            <?php if ($order->payment_method == 0)
                                                echo '<td style="text-align:center" >Direct bank transfer</td>';
                                            else if ($order->payment_method == 1)
                                                echo '<td style="text-align:center">Check payments</td>';
                                            else
                                                echo '<td style="text-align:center" >Cash on delivery</td>';
                                            ?>
                                            <td style="text-align:center"><?php echo ($order->numberitem); ?></td>
                                            <td style="text-align:center"><?php echo ($order->created_at); ?></td>
                                            <td style="text-align:center"><?php echo ($order->first_name . ' ' . $order->last_name); ?></td>
                                            <td style="text-align:center"><?php echo ($order->phone_number); ?></td>
                                            <?php if ($order->order_stat > 0) {
                                                echo '<td style="text-align:center"><a class="btn btn-block btn-success trend-t"  style="color: white;"> Confirmed</a></td>';
                                            } else {
                                                echo '<td style="text-align:center"><a class="btn btn-block btn-warning trend-t" id="confirm-order" data-id="' . $order->order_refer . '" style="color: white;"> waiting </a></td>';
                                            } ?>
                                            <td style="text-align:center">
                                                <a href="<?php echo URLROOT ?>/CustomerOrders/details/<?php echo $order->order_refer ?>"><i class="fas fa-sign-out-alt order-ico"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include("../app/views/admin/inc/footer.php"); ?>
<script>
    $(function() {
        $("#users-table").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "columnDefs": [{
                "className": "dt-c",
                "targets": "_all"
            }]
        }).buttons().container().appendTo('#admins-table_wrapper .col-md-6:eq(0)');

    });
    $(document).ready(function() {
        $(document).on("click", "#confirm-order", function() {
            let id = $(this).data('id')
            let element = $(this)
            swal.fire({
                title: 'Are you sure?',
                text: "Do you confirm this Action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                            url: '<?php echo URLROOT; ?>/Dashborad/CustomerOrders/confirm',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'json'
                        })
                        .done(function(response) {
                            if (response.status != 'error') {
                                element.replaceWith('<a class="btn btn-block btn-success trend-t"  style="color: white;"> Confirmed</a>')
                                swal.fire('Done!', "", response.status);
                            } else {
                                swal.fire('Error!', response.message, response.status);
                            }

                        })
                        .fail(function() {
                            swal.fire('Oops...', 'Something went wrong !', 'error');
                        });
                }
            })
        });
    })
</script>
<?php include("inc/header.php"); ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


<div class="banner-wrapper has_background">
    <img src="<?php echo URLROOT ?>/assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
    <div class="banner-wrapper-inner">
        <h1 class="page-title container">Orders</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs container">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="<?php echo URLROOT ?>"><span>Home</span></a></li>
                <li class="trail-item trail-end active"><span>My Orders</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<main class="site-main  main-container no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="page-main-content">
                    <div class="kobolg">
                        <div class="kobolg-notices-wrapper"></div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-6">
                                                <h3 class="card-title" style="line-height: 2;">My Orders History </h3>
                                            </div>
                                            <div class="col-6">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="ordersTab" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Order Reference</th>
                                                    <th>Payment Method</th>
                                                    <th>Number of Items</th>
                                                    <th>Order Date</th>
                                                    <th>Order Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($data['orders'] as $order) { ?>
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
                                                        <?php if ($order->status > 0)
                                                            echo '<td style="text-align:center"><a class="btn btn-block btn-success trend-t" style="color: white;"> Confirmed</a></td>';
                                                        else
                                                            echo '<td style="text-align:center"><a class="btn btn-block btn-warning trend-t" style="color: white;"> waiting </a></td>';
                                                        ?>
                                                        <td style="text-align:center">
                                                            <a href="<?php echo URLROOT ?>/Orders/details/<?php echo $order->order_refer ?>"><i class="fa fa-external-link-square order-ico"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include("inc/footer.php"); ?>
<script src="<?php echo URLROOT; ?>/plugins/datatables/jquery.dataTables.min.js"></script>

<script>
    $(function() {
        $("#ordersTab").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        })

    });
</script>
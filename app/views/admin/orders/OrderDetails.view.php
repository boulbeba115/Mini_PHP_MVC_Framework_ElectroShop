<?php require_once("../app/views/admin/inc/header.php"); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/CustomerOrders/">Orders Managements</a> </li>
                        <li class="breadcrumb-item"><a>Orders Details</a> </li>

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
                            <?php if (isset($data['orders']) && count($data['orders']) > 0) { ?>
                                <div class="col-sm-8" style="margin: 0 auto;" id="invoice">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h3><img src="<?php echo URLROOT ?>/assets/images/logo.png" alt="logo"><small class="float-right">Date: <?php echo $data['orders'][0]->created_at ?></small></h3>
                                        </div>
                                        <!-- /.col -->
                                    </div>

                                    <div class="row invoice-info" style="padding-bottom: 23px;">
                                        <div class="col-sm-4 invoice-col" style="float: left;">
                                            <b>Enterprise : ElectroShop</b><br>
                                            <b>Invoice #<?php echo $data['orders'][0]->order_refer ?></b><br>
                                            <b>Order ID:</b> <?php echo "Ord-" . $data['orders'][0]->id ?><br>
                                            <b>Payment Due:</b> <?php echo $data['orders'][0]->created_at ?><br>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4 invoice-col">
                                            <div style="float:right;">
                                                <address>
                                                    <strong><?php echo $data['orders'][0]->first_name . " " . $data['orders'][0]->last_name ?></strong><br>
                                                    <div style="width: 200px;">
                                                        <span><?php echo $data['orders'][0]->adress ?></span>
                                                    </div>
                                                    Phone: <?php echo $data['orders'][0]->phone_number ?> <br>
                                                    Email: <?php echo $data['orders'][0]->email ?>
                                                </address>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Product Reference</th>
                                                        <th>Product Name</th>
                                                        <th>Qty</th>
                                                        <th>Unit Price</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total = 0;
                                                    foreach ($data["orders"] as $ord) { ?>
                                                        <tr>
                                                            <td><?php echo $ord->prod_refer ?></td>
                                                            <td><?php echo $ord->prod_name ?></td>
                                                            <td><?php echo $ord->quantity ?></td>
                                                            <td><?php echo $ord->prod_price . " TND" ?></td>
                                                            <td><?php echo number_format($ord->prod_price * $ord->quantity) . " TND" ?></td>
                                                        </tr>
                                                    <?php
                                                        $total += $ord->prod_price * $ord->quantity;
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-6">
                                            <h4 class="lead">Payment Methods:
                                                <strong style="text-transform: uppercase;">
                                                    <?php if ($data["orders"][0]->payment_method == 0)
                                                        echo 'Direct bank transfer';
                                                    else if ($data["orders"][0]->payment_method == 1)
                                                        echo 'Check payments';
                                                    else
                                                        echo 'Cash on delivery';
                                                    ?>
                                                </strong>
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-6">
                                            <p class="lead">Amount Due 2/22/2014</p>

                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th style="width:50%">Subtotal:</th>
                                                            <td><?php echo number_format($total) . " TND" ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Shipping:</th>
                                                            <td>0.00 TND</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Total:</th>
                                                            <td><?php echo number_format($total) . " TND" ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <div class="col-sm-8 no-print" style="margin: 0 auto;padding-bottom: 4%;padding-top: 1%;">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary float-right" onclick='printInvoice();' style="margin-right: 5px;">
                                            <i class="fa fa-print"></i> Print Invoice
                                        </button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="main-container text-center error-404 not-found">
                                    <div class="container">
                                        <h1 class="title">No Orders Found !!!</h1>
                                        <a href="<?php echo URLROOT; ?>" class="button">Back to hompage</a>
                                    </div>
                                </div>
                            <?php } ?>
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


<?php include("../app/views/admin/inc/footer.php"); ?>

<script>
    function printInvoice() {

        var divToPrint = document.getElementById('invoice');

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();

        setTimeout(function() {
            newWin.close();
        }, 10);

    }
</script>
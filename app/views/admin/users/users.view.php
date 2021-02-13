<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users Managements</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/users/">Users Managements</a> </li>
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
                                    <h3 class="card-title" style="line-height: 2;">Customers List </h3>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Cin</th>
                                        <th>Adress</th>
                                        <th>Phone</th>
                                        <th>Number of orders</th>
                                        <th>Acount Stauts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data['users'] as $user) {
                                    ?>
                                        <tr>
                                            <td><?php echo $user->id; ?></td>
                                            <td><?php echo $user->first_name . " " . $user->last_name ?></td>
                                            <td><?php echo $user->email ?></td>
                                            <td><?php echo $user->cin ?></td>
                                            <td><?php echo $user->adress ?></td>
                                            <td><?php echo $user->phone_number ?></td>
                                            <td><?php echo $user->nbOrders ?></td>
                                            <?php if (!$user->status) { ?>
                                                <td><a id="banStat" data-id="<?php echo $user->id ?>" class="btn btn-block btn-success"> Active</a></td>
                                            <?php } else { ?>
                                                <td><a id="unbanStat" data-id="<?php echo $user->id ?>" class="btn btn-block btn-danger ">Banned</a></td>
                                            <?php } ?>
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
        $(document).on("click", "#banStat", function() {
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
                            url: '<?php echo URLROOT; ?>/Dashborad/Users/userState/1',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'json'
                        })
                        .done(function(response) {
                            if (response.status != 'error') {
                                element.replaceWith('<a id="unbanStat" data-id="' + id + '" class="btn btn-block btn-danger ">Banned</a>')
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
        $(document).on("click", "#unbanStat", function() {
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
                            url: '<?php echo URLROOT; ?>/Dashborad/Users/userState/0',
                            type: 'POST',
                            data: 'id=' + id,
                            dataType: 'json'
                        })
                        .done(function(response) {
                            if (response.status != 'error') {
                                element.replaceWith('<a id="banStat" data-id="' + id + '" class="btn btn-block btn-success ">Active</a>')
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
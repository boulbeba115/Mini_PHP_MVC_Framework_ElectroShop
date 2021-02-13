<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admins Managements</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/Admins/">Admins Managements</a> </li>
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
                  <h3 class="card-title" style="line-height: 2;">Admins List </h3>
                </div>
                <div class="col-6">
                  <a id="btnAdd" class="btn bg-success" style="float:right;">
                    <i class="fas fa-plus"></i> Add Admin
                  </a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php flash('category_added'); ?>
              <table id="admins-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Is Owner</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data['admins'] as $admin) {
                  ?>
                    <tr>
                      <td><?php echo ($admin->id); ?></td>
                      <td><?php echo ($admin->user_name); ?></td>
                      <?php if ($admin->is_owner) { ?>
                        <td><a class="btn btn-block btn-success" style="width: 150px;margin: 0 auto;"> Owner</a></td>
                      <?php } else { ?>
                        <td><a class="btn btn-block btn-danger " style="width: 150px;margin: 0 auto;"> Not Owner</a></td>
                      <?php } ?>
                      <td>
                        <a href="#" id="deleteAdmin" data-id="<?php echo $admin->id; ?>"><i class="nav-icon fas fa-trash delete-bt"></i></a>
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
<!-- Modal -->
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titeModal">Add Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="UserName" name='username' id='username'>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name='password' id='password'>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitForm">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->
<?php include("../app/views/admin/inc/footer.php"); ?>
<script>
  $(function() {
    $("#admins-table").DataTable({
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
    $(document).on('click', '#btnAdd', function() {
      $('#addAdmin').modal('show');
    })
    $(document).on('click', '#submitForm', function() {
      let admin = {
        userName: $("#username").val(),
        password: $("#password").val()
      }
      $.ajax({
        method: 'POST',
        url: '<?php echo URLROOT; ?>/Dashborad/Admins/create',
        data: admin,
        dataType: 'json',
        success: function(response) {
          let res = response
          if (res.status != "error") {
            let row = [],
              tab = $("#admins-table").dataTable();
            row[0] = res.data.id
            row[1] = res.data.user_name
            row[2] = '<a class="btn btn-block btn-danger " style="width: 150px;margin: 0 auto;"> Not Owner</a>'
            row[3] = '<a href="#" id="deleteAdmin" data-id="' + res.data.id + '"><i class="nav-icon fas fa-trash delete-bt"></i></a>'
            tab.fnAddData(row);
            $('#addAdmin').modal('hide');
            Swal.fire(
              'Added!',
              'Admin Successfully Added',
              'success'
            )
          } else {
            swal.fire('Oops...', response.message, response.status);
            if (res.hasOwnProperty('user_name_err')) {
              $("#username").css("border", "red solid 1px")
              $("#password").after('<span style="color:red">The UserName is Empty <span/>')
            }
            if (res.hasOwnProperty('password_err'))
              $("#password").css("border", "red solid 1px")
            $("#password").after('<span style="color:red">The Password is Empty<span/>')
          }
        }
      });
    })
    $(document).on('click', '#deleteAdmin', function() {
      let id = $(this).data('id');
      let row = $(this).parent().parent();
      swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
      }).then((result) => {
        if (result.value) {
          $.ajax({
              url: '<?php echo URLROOT; ?>/Dashborad/Admins/delete',
              type: 'POST',
              data: 'id=' + id,
              dataType: 'json'
            })
            .done(function(response) {
              if (response.status != 'error')
                row.remove();
              swal.fire('Deleted!', response.message, response.status);
            })
            .fail(function() {
              swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
            });
        }
      })
    })
  })
</script>
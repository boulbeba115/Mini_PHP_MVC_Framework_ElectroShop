<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products Categories</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/Categories/">Categories Managements</a> </li>
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
                  <h3 class="card-title" style="line-height: 2;">Products categories List </h3>
                </div>
                <div class="col-6">
                  <a href="<?php echo URLROOT; ?>/Dashborad/Categories/create" class="btn bg-success" style="float:right;">
                    <i class="fas fa-plus"></i> Add Category
                  </a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php flash('category_added'); ?>
              <table id="catTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data['categories'] as $category) {
                  ?>
                    <tr>
                      <td><?php echo ($category->id); ?></td>
                      <td><?php echo ($category->category_name); ?></td>
                      <td><?php echo ($category->category_description); ?></td>
                      <td>
                        <a href="#" id="showEdit" data-id="<?php echo $category->id; ?>"><i class="nav-icon fas fa-edit edit-bt"></i></a>
                        <a href="#" id="deleteCategory" data-id="<?php echo $category->id; ?>"><i class="nav-icon fas fa-trash delete-bt"></i></a>
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
<div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titeModal">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Category Description</label>
            <textarea class="form-control" id="categorydesc"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitEdit">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->
<?php include("../app/views/admin/inc/footer.php"); ?>
<script>
  $(function() {
    $("#catTable").DataTable({
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
    }).buttons().container().appendTo('#catTable_wrapper .col-md-6:eq(0)');

  });
  $(document).ready(function() {
    $(document).on('click', '#deleteCategory', function() {
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
              url: '<?php echo URLROOT; ?>/Dashborad/Categories/deleteCategory',
              type: 'POST',
              data: 'id=' + id,
              dataType: 'json'
            })
            .done(function(response) {
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

  $(document).on('click', '#showEdit', function() {
    let id = $(this).data('id');
    $.ajax({
      method: 'POST',
      url: '<?php echo URLROOT; ?>/Dashborad/Categories/getCategory',
      data: 'id=' + id,
      dataType: 'json',
      success: function(response) {
        $("#categoryName").val(response.data.category_name)
        $("#categorydesc").val(response.data.category_description)
        $('#editform').modal('toggle');
        sessionStorage.setItem("catId", id)
      }
    });
  })

  $(document).on('click', '#submitEdit', function() {
    let idCat = sessionStorage.getItem("catId")
    let category = {
      id: idCat,
      categoryName: $("#categoryName").val(),
      categoryDesc: $("#categorydesc").val()
    }
    $.ajax({
      method: 'POST',
      url: '<?php echo URLROOT; ?>/Dashborad/Categories/update',
      data: category,
      dataType: 'json',
      success: function(response) {
        let res = response
        if (res.status != "error") {
          tab = $('#catTable').dataTable(),
            index = tab.fnGetData().findIndex(w => w[0] == idCat);
          if (index >= 0) {
            let row = tab.fnGetData(index);
            row[1] = res.data.category
            row[2] = res.data.description
            tab.fnUpdate(row, index, undefined, false);
            $('#editform').modal('hide');
            Swal.fire(
              'Updated!',
              'Category Successfully updated',
              'success'
            )
          }
        } else {
          swal.fire('Oops...', response.message, response.status);
          if (res.hasOwnProperty('Name_err')) {
            $("#categoryName").css("border", "red solid 1px")
            $("#categoryName").after('<span style="color:red">The category Name is required <span/>')
          }
          if (res.hasOwnProperty('Description_err'))
            $("#categorydesc").css("border", "red solid 1px")
          $("#categorydesc").after('<span style="color:red">The description is required <span/>')
        }
      }
    });
  })
</script>
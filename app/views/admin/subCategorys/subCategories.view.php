<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products SubCategories</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
            <li class="breadcrumb-item active"><a>SubCategories</a> </li>
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
                  <h3 class="card-title" style="line-height: 2;">Products Subcategories List </h3>
                </div>
                <div class="col-6">
                  <a id="createBtn" class="btn bg-success" style="float:right;">
                    <i class="fas fa-plus"></i> Add SubCategory
                  </a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php flash('category_added'); ?>
              <table id="SubCatTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>SubCategory Name</th>
                    <th>Super Category Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data['subcategories'] as $subCat) {
                  ?>
                    <tr>
                      <td><?php echo ($subCat->id); ?></td>
                      <td><?php echo ($subCat->sub_category_name); ?></td>
                      <td><?php echo ($subCat->category_name); ?></td>
                      <td>
                        <a href="#" id="showEdit" data-id="<?php echo $subCat->id; ?>"><i class="nav-icon fas fa-edit edit-bt"></i></a>
                        <a href="#" id="deleteCategory" data-id="<?php echo $subCat->id; ?>"><i class="nav-icon fas fa-trash delete-bt"></i></a>
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
<!-- Modal Create -->
<div class="modal fade" id="createform" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titeModal">Create SubCategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="SubCatForm">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">SubCategory Name</label>
            <input type="text" class="form-control" id="subCategoryName">
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="custom-select " id="category">
              <?php
              foreach ($data['categories'] as $category) {
              ?>
                <option value="<?php echo ($category->id); ?>"><?php echo ($category->category_name); ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submitCreate">Submit</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal Create -->
<!-- Modal Edit -->
<div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titeModal">Edit SubCategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">SubCategory Name</label>
            <input type="text" class="form-control" id="subCategoryName">
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="custom-select " id="category">
              <?php
              foreach ($data['categories'] as $category) {
              ?>
                <option value="<?php echo ($category->id); ?>"><?php echo ($category->category_name); ?></option>
              <?php
              }
              ?>
            </select>
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
<!-- /ModalEdit -->
<?php include("../app/views/admin/inc/footer.php"); ?>
<script>
  <?php
  $subCategories = json_encode($data['subcategories']);
  $categories = json_encode($data['categories']);
  echo "let subCategories = " . $subCategories . ";";
  echo "let categories = " . $categories . ";";
  ?>
</script>
<script>
  $(function() {
    $("#SubCatTable").DataTable({
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
    }).buttons().container().appendTo('#SubCatTable_wrapper .col-md-6:eq(0)');

  });

  $("#createBtn").click((e) => {
    $('#createform').modal('toggle');
  })

  $("#submitCreate").click(() => {
    let error1 = false,
      error2 = false;
    if (!$('#subCategoryName').val()) {
      if (!$("#n1-error").length) {
        $("#subCategoryName").addClass("is-invalid")
        $("#subCategoryName").after('<span id="n1-error" style="color:red">The Subcategory Name is required <span/>')
      }
      error1 = true
    }
    if (!$('#category').val()) {
      if (!$("#n2-error").length) {
        $("#category").addClass("is-invalid")
        $("#category").after('<span id="n2-error" style="color:red">Please select a category <span/>')
      }
      error2 = true;
    }
    if (!error1) {
      $("#n1-error").remove();
      $("#subCategoryName").removeClass("is-invalid")
    }
    if (!error2) {
      $("#n2-error").remove();
      $("#category").removeClass("is-invalid")
    }
    if (error1 || error2)
      return

    let subCategory = {
      subCategoryName: $('#subCategoryName').val(),
      category: $('#category').val()
    }
    $.ajax({
      method: 'POST',
      url: '<?php echo URLROOT; ?>/Dashborad/SubCategories/add',
      data: subCategory,
      dataType: 'json',
      success: function(response) {
        let res = response
        if (res.status != "error") {
          tab = $('#SubCatTable').dataTable()
          if (categories.length > 0) {
            cat = categories.find(x => x.id == res.data.category)
            let row = [];
            row[0] = res.data.id
            row[1] = res.data.subCategoryName
            row[2] = cat.category_name
            row[3] = '  <a href="#" id="showEdit" data-id="' + res.data.id + '"><i class="nav-icon fas fa-edit edit-bt"></i></a>' +
              '<a href="#" id="deleteCategory" data-id="' + res.data.id + '"><i class="nav-icon fas fa-trash delete-bt"></i></a>'
            tab.fnAddData(row);
          }
          $('#subCategoryName').val("")
          $('#category').val(1)
          $('#createform').modal('hide')
          Swal.fire(
            'Added!',
            'SubCategory Successfully updated',
            'success'
          )
        }
      }
    });
  })

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
              url: '<?php echo URLROOT; ?>/Dashborad/SubCategories/deleteSubCategory',
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
    if (subCategories.length < 1) {
      swal.fire('Oops...', 'Something went wrong!', 'error');
    } else {
      let subCat = subCategories.find(x => x.id == id);
      let cat = categories.find(x => x.category_name == subCat.category_name)
      $('#editform #subCategoryName').val(subCat.sub_category_name)
      if (cat) {
        $('#editform #category').val(cat.id)
      }
      $('#editform').modal('toggle');
      sessionStorage.setItem("subCatId", id)
    }
  })

  $(document).on('click', '#submitEdit', function() {
    let idSubCat = sessionStorage.getItem("subCatId")
    let subCategory = {
      id: idSubCat,
      subCategoryName: $('#editform #subCategoryName').val(),
      category: $('#editform #category').val()
    }
    $.ajax({
      method: 'POST',
      url: '<?php echo URLROOT; ?>/Dashborad/SubCategories/update',
      data: subCategory,
      dataType: 'json',
      success: function(response) {
        let res = response
        if (res.status != "error") {
          tab = $('#SubCatTable').dataTable(),
            index = tab.fnGetData().findIndex(w => w[0] == idSubCat);
          if (index >= 0) {
            let row = tab.fnGetData(index);
            row[1] = res.data.subCategoryName
            let cat = categories.find(x => x.id == res.data.category);
            row[2] = cat.category_name
            tab.fnUpdate(row, index, undefined, false);
            $('#editform').modal('hide');
            Swal.fire(
              'Updated!',
              'SubCategory Successfully updated',
              'success'
            )
          }
        } else {
          swal.fire('Oops...', response.message, response.status);
          if (res.hasOwnProperty('Name_err')) {
            $('#editform #subCategoryName').css("border", "red solid 1px")
            $('#editform #subCategoryName').after('<span style="color:red">The category Name is required <span/>')
          }
          if (res.hasOwnProperty('Description_err'))
            $('#editform #category').css("border", "red solid 1px")
          $('#editform #category').after('<span style="color:red">The description is required <span/>')
        }
      }
    });
  })
</script>
<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sub-Sub Categories</h1>
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
                  <h3 class="card-title" style="line-height: 2;">Sub-Sub Categories List </h3>
                </div>
                <div class="col-6">
                  <a id="createBtn" class="btn bg-success" style="float:right;">
                    <i class="fas fa-plus"></i> Add Sub-Sub Category
                  </a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="SubCatTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Sub-Sub Categories Name</th>
                    <th>Sub Category Name</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data['ssCategories'] as $ssubCat) {
                  ?>
                    <tr>
                      <td><?php echo ($ssubCat->id); ?></td>
                      <td><?php echo ($ssubCat->sub_sub_category_name); ?></td>
                      <td><?php echo ($ssubCat->sub_category_name); ?></td>
                      <td><?php echo ($ssubCat->category_name); ?></td>
                      <td>
                        <a href="#" id="showEdit" data-id="<?php echo $ssubCat->id; ?>"><i class="nav-icon fas fa-edit edit-bt"></i></a>
                        <a href="#" id="deleteCategory" data-id="<?php echo $ssubCat->id; ?>"><i class="nav-icon fas fa-trash delete-bt"></i></a>
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
            <label for="recipient-name" class="col-form-label">Sub-Sub Category Name</label>
            <input type="text" class="form-control" id="subSubCategoryName">
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="custom-select " id="category">
              <option disabled="disabled" selected>Plz Pick a category!</option>
              <?php
              foreach ($data['categories'] as $category) {
              ?>
                <option value="<?php echo ($category->id); ?>"><?php echo ($category->category_name); ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="category">Sub Category</label>
            <select class="custom-select " id="subcategory">
              <option disabled="disabled" selected>Plz Pick a Sub-category!</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitCreate">Submit</button>
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
            <label for="recipient-name" class="col-form-label">Sub-Sub Category Name</label>
            <input type="text" class="form-control" id="edit-subSubCategoryName">
          </div>
          <div class="form-group">
            <label for="category">Category</label>
            <select class="custom-select " id="edit-category">
              <option disabled="disabled" selected>Plz Pick a category!</option>
              <?php
              foreach ($data['categories'] as $category) {
              ?>
                <option value="<?php echo ($category->id); ?>"><?php echo ($category->category_name); ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="category">Sub Category</label>
            <select class="custom-select " id="edit-Subcategory">
              <option disabled="disabled" selected>Plz Pick a Sub-category!</option>
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
  $ssCategories = json_encode($data['ssCategories']);
  $categories = json_encode($data['categories']);
  echo "let subCategories = " . $subCategories . ";";
  echo "let ssCategories = " . $ssCategories . ";";
  echo "let categories = " . $categories . ";";

  ?>
</script>
<script>
  // DataTable
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

  //Check Create Select
  $('#SubCatForm #subcategory').click(() => {
    if (!$('#SubCatForm #category').val()) {
      if (!$("#noption").length) {
        $("#SubCatForm #subcategory").addClass("is-invalid")
        $("#SubCatForm #subcategory").after('<span id="noption" style="color:red">Select Category First <span/>')
      }
    } else {
      $('#noption').remove();
      $('#SubCatForm #subcategory').removeClass("is-invalid")
    }
  })

  // load subcategories
  $('#SubCatForm #category').change(function() {
    let self = $(this)
    let id = self.val()
    let option = $("#SubCatForm #category option:selected").text();
    if (id > 0) {
      let tab = subCategories.filter(x => x.category_name === option)
      $("#SubCatForm #subcategory").children().remove();
      $('#noption').remove();
      $('#SubCatForm #subcategory').removeClass("is-invalid")
      tab.forEach(x => {
        $("#SubCatForm #subcategory").append('<option value="' + x.id + '">' + x.sub_category_name + '</option>')
      })
    }
  })

  //show create modal
  $("#createBtn").click((e) => {
    $('#createform').modal('toggle');
  })

  // submit create
  $("#submitCreate").click(() => {
    let error1, error2, error3 = false
    if (!$('#SubCatForm #subSubCategoryName').val()) {
      if (!$("#n1-error").length) {
        $("#SubCatForm #subSubCategoryName").addClass("is-invalid")
        $("#SubCatForm #subSubCategoryName").after('<span id="n1-error" style="color:red">The Sub-Sub Category Name is required <span/>')
      }
      error1 = true
    }
    if (!$('#SubCatForm #category').val()) {
      if (!$("#n2-error").length) {
        $("#SubCatForm #category").addClass("is-invalid")
        $("#SubCatForm #category").after('<span id="n2-error" style="color:red">Please select a category <span/>')
      }
      error2 = true;
    }
    if (!$('#SubCatForm #category').val()) {
      if (!$("#n3-error").length) {
        $("#SubCatForm #subcategory").addClass("is-invalid")
        $("#SubCatForm #subcategory").after('<span id="n3-error" style="color:red">Please select a Sub-category <span/>')
      }
      error3 = true;
    }
    if (!error1) {
      $("#SubCatForm #n1-error").remove();
      $("#SubCatForm #subSubCategoryName").removeClass("is-invalid")
    }
    if (!error2) {
      $("#SubCatForm #n2-error").remove();
      $("#SubCatForm #category").removeClass("is-invalid")
    }
    if (!error2) {
      $("#SubCatForm #n3-error").remove();
      $("#SubCatForm #subcategory").removeClass("is-invalid")
    }
    if (error1 || error2 || error3)
      return

    let subsubCategory = {
      subsubName: $('#SubCatForm #subSubCategoryName').val(),
      subCatid: $('#SubCatForm #subcategory').val(),
    }
    $.ajax({
      method: 'POST',
      url: '<?php echo URLROOT; ?>/Dashborad/SubSubCategories/add',
      data: subsubCategory,
      dataType: 'json',
      success: function(response) {
        let res = response
        if (res.status != "error") {
          tab = $('#SubCatTable').dataTable()
          if (subCategories.length > 0) {
            let subCat = subCategories.find(x => x.id == subsubCategory.subCatid)
            let row = [];
            row[0] = res.data.id
            row[1] = res.data.subSubCategoryName
            row[2] = subCat.sub_category_name
            row[3] = subCat.category_name
            row[4] = '  <a href="#" id="showEdit" data-id="' + res.data.id + '"><i class="nav-icon fas fa-edit edit-bt"></i></a>' +
              '<a href="#" id="deleteCategory" data-id="' + res.data.id + '"><i class="nav-icon fas fa-trash delete-bt"></i></a>'
            tab.fnAddData(row);
          }
          $('#SubCatForm #subSubCategoryName').val("")
          $('#SubCatForm #category').val(0)
          $('#SubCatForm #subcategory').val(0)
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

  //Check Edit Select
  $('#edit-Subcategory').click(() => {
    if (!$('#edit-category').val()) {
      if (!$("#noption-2").length) {
        $("#edit-Subcategory").addClass("is-invalid")
        $("#edit-Subcategory").after('<span id="noption-2" style="color:red">Select Category First <span/>')
      }
    } else {
      $('#noption-2').remove();
      $('#edit-Subcategory').removeClass("is-invalid")
    }
  })
  //load edit
  $('#edit-category').change(function() {
    let self = $(this)
    let id = self.val()
    let option = $("#edit-category option:selected").text();
    if (id > 0) {
      let tab = subCategories.filter(x => x.category_name === option)
      $("#edit-Subcategory").children().remove();
      $('#noption-2').remove();
      tab.forEach(x => {
        $("#edit-Subcategory").append('<option value="' + x.id + '">' + x.sub_category_name + '</option>')
      })
    }
  })

  //show Edit form
  $(document).on('click', '#showEdit', function() {
    let id = $(this).data('id');
    if (ssCategories.length < 1) {
      swal.fire('Oops...', 'Something went wrong!', 'error');
    } else {
      let sscat = ssCategories.find(x => x.id == id);
      let cat = categories.find(x => x.category_name == sscat.category_name)
      let subcat = subCategories.find(x => x.sub_category_name == sscat.sub_category_name)
      if (cat && sscat && subcat) {
        $('#edit-subSubCategoryName').val(sscat.sub_sub_category_name)
        $('#edit-category').val(cat.id)
        let option = $("#edit-category option:selected").text();
        if (id > 0) {
          let tab = subCategories.filter(x => x.category_name === option)
          $("#edit-Subcategory").children().remove();
          $('#noption-2').remove();
          tab.forEach(x => {
            $("#edit-Subcategory").append('<option value="' + x.id + '">' + x.sub_category_name + '</option>')
          })
        }
        $('#edit-Subcategory').val(subcat.id)
      }
      $('#editform').modal('toggle');
      sessionStorage.setItem("ssCatId", id)
    }
  })

  //update sub-sub-cat
  $(document).on('click', '#submitEdit', function() {
    let idSubCat = sessionStorage.getItem("ssCatId")
    let subsubCategory = {
      id: idSubCat,
      subsubName: $('#edit-subSubCategoryName').val(),
      subCatid: $('#edit-Subcategory').val()
    }
    $.ajax({
      method: 'POST',
      url: '<?php echo URLROOT; ?>/Dashborad/SubSubCategories/update',
      data: subsubCategory,
      dataType: 'json',
      success: function(response) {
        let res = response
        if (res.status != "error") {
          tab = $('#SubCatTable').dataTable(),
            index = tab.fnGetData().findIndex(w => w[0] == idSubCat);
          if (index >= 0) {
            let row = tab.fnGetData(index);
            row[1] = res.data.subSubCategoryName
            let subcat = subCategories.find(x => x.id == res.data.subcategory);
            row[2] = subcat.sub_category_name
            row[3] = subcat.category_name
            tab.fnUpdate(row, index, undefined, false);
            $('#editform').modal('hide');
            Swal.fire(
              'Updated!',
              'Sub-Sub Category Successfully updated',
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
              url: '<?php echo URLROOT; ?>/Dashborad/SubSubCategories/delete',
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
</script>
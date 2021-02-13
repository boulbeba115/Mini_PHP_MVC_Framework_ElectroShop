<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Products Managements</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/Products">Categories Managements</a> </li>
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
                  <h3 class="card-title" style="line-height: 2;">Products List </h3>
                </div>
                <div class="col-6">
                  <a href="<?php echo URLROOT; ?>/Dashborad/Products/create" class="btn bg-success" style="float:right;">
                    <i class="fas fa-plus"></i> Add Product
                  </a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?php flash('category_added'); ?>
              <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-3">
                  <select class="custom-select " id="category">
                    <option disabled="disabled" selected>Categories</option>
                    <?php
                    foreach ($data['categories'] as $category) {
                    ?>
                      <option value="<?php echo ($category->id); ?>"><?php echo ($category->category_name); ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-3">
                  <select class="custom-select " id="subcategory">
                    <option disabled="disabled" selected>Sub-category!</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <select class="custom-select " id="subSubcategory">
                    <option disabled="disabled" selected>Sub-sub category!</option>
                  </select>
                </div>
                <div class="col-sm-3">
                  <a id="Refresh" class="btn bg-success">
                    <i class="fa fa-undo"></i>
                  </a>
                </div>
              </div>
              <table id="productsTab" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Reference</th>
                    <th>Product Name</th>
                    <th>brand</th>
                    <th>Stock Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Trend</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
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
    $("#productsTab").DataTable({
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
    }).buttons().container().appendTo('#productsTab_wrapper .col-md-6:eq(0)');

  });
</script>
<script>
  <?php
  $products = json_encode($data['products']);
  $categories = json_encode($data['categories']);
  $subCategories = json_encode($data['subcategories']);
  $ssCategories = json_encode($data['ssCategories']);

  echo "let products = " . $products . ";";
  echo "let categories = " . $categories . ";";
  echo "let subCategories = " . $subCategories . ";";
  echo "let ssCategories = " . $ssCategories . ";";
  ?>
</script>
<script>
  // fill table with data
  $(document).ready(function() {
    tab = $('#productsTab').dataTable();
    let filltab = function(data) {
      for (p of data) {
        let row = [];
        row[0] = p.prod_id
        row[1] = p.prod_refer
        row[2] = p.prod_name
        row[3] = p.brand
        row[4] = p.qt_stock
        row[5] = p.prod_price
        if (p.sub_sub_cat == 0) {
          row[6] = '<a href="#">' + p.category_name + ' <i class="fa fa-caret-right" > </i> ' + p.sub_category_name +
            '</a>'
        } else
          row[6] = '<a href="#">' + p.category_name + ' <i class="fa fa-caret-right" > </i> ' + p.sub_category_name +
          ' <i class="fa fa-caret-right" > </i> ' + p.sub_sub_category_name +
          '</a>'

        if (p.is_trend > 0)
          row[7] = '<td><a  data-id="' + p.prod_refer + '" class="btn btn-block btn-success trend-t"> In Trends</a></td>'
        else
          row[7] = '<td><a  data-id="' + p.prod_refer + '" class="btn btn-block btn-danger trend-f"> Not  Trend</a></td>'

        row[8] = '<a href="#" id="showEdit" data-id="' + p.prod_id + '"><i class="nav-icon fas fa-edit edit-bt"></i></a>' +
          '<a href="#" id="deleteProduct" data-id="' + p.prod_id + '"><i class="nav-icon fas fa-trash delete-bt"></i></a>'
        tab.fnAddData(row);
      }
    }
    filltab(products);
    // load subcategories
    $('#category').change(function() {
      let self = $(this)
      let id = self.val()
      let option = $("#category option:selected").text();
      if (id > 0) {
        let cat = subCategories.filter(x => x.category_name === option)
        $("#subcategory").children().remove();
        $("#subcategory").append('<option disabled="disabled" selected>Sub-Categories</option>');
        cat.forEach(x => {
          $("#subcategory").append('<option  value="' + x.id + '">' + x.sub_category_name + '</option>')
        })
        tab.fnClearTable()
        let filtred = products.filter(p => p.cat_id == id)
        filltab(filtred);
      }
    })
    $('#subcategory').change(function() {
      let self = $(this)
      let id = self.val()
      let option = $("#subcategory option:selected").text();
      if (id > 0) {
        let cat = ssCategories.filter(x => x.sub_category_name === option)
        $("#subSubcategory").children().remove();
        $("#subSubcategory").append('<option disabled="disabled" selected>Sub-Sub Categories</option>');
        cat.forEach(x => {
          $("#subSubcategory").append('<option  value="' + x.id + '">' + x.sub_sub_category_name + '</option>')
        })
        tab.fnClearTable()
        let filtred = products.filter(p => p.sub_cat == id)
        filltab(filtred);
      }
    })
    $('#subSubcategory').change(function() {
      let self = $(this)
      let id = self.val()
      if (id > 0) {
        tab.fnClearTable()
        let filtred = products.filter(p => p.sub_sub_cat == id)
        filltab(filtred);
      }
    })
    $('#Refresh').click(function() {
      $("#category").val(0);
      $("#subcategory").val(0);
      $("#subSubcategory").val(0);
      tab.fnClearTable()
      filltab(products);
    })

  });
</script>
<script>
  $(document).on('click', '.trend-t', function() {
    let prod_ref = $(this).data('id')
    let current = $(this).parent()
    swal.fire({
      title: 'Are you sure?',
      text: "Do you want To Remove This Product From Trends",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes!',
    }).then((result) => {
      if (result.value) {
        $.ajax({
            url: '<?php echo URLROOT; ?>/Dashborad/HomePage/remove',
            type: 'POST',
            data: 'id=' + prod_ref,
            dataType: 'json'
          })
          .done(function(response) {
            current.replaceWith('<td><a  data-id="' + prod_ref + '" class="btn btn-block btn-danger trend-f"> Not  Trend</a></td>')
            swal.fire('Changed!', response.message, response.status);
          })
          .fail(function() {
            swal.fire('Oops...', 'Something went wrong!', 'error');
          });
      }
    })
  })
  $(document).on('click', '.trend-f', function() {
    let prod_ref = $(this).data('id')
    let current = $(this).parent()
    swal.fire({
      title: 'Are you sure?',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
    }).then((result) => {
      if (result.value) {
        $.ajax({
            url: '<?php echo URLROOT; ?>/Dashborad/HomePage/addToTrend',
            type: 'POST',
            data: 'id=' + prod_ref,
            dataType: 'json'
          })
          .done(function(response) {
            current.replaceWith('<td><a  data-id="' + prod_ref + '" class="btn btn-block btn-success trend-t"> In Trends</a></td>')

            swal.fire('Changed!', response.message, response.status);
          })
          .fail(function() {
            swal.fire('Oops...', 'Something went wrong!', 'error');
          });
      }
    })
  })
</script>
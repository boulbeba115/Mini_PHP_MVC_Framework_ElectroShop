<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a  href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/Categories/">Categories Managements</a> </li>
            <li class="breadcrumb-item active"> Add new category</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add new Products Category </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="newCategory" action="<?php echo URLROOT; ?>/Dashborad/Categories/add" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="categoryName">Category Name</label>
                  <input type="text" name="categoryName" class="form-control" id="categoryName" placeholder="Enter Category Name">
                </div>
                <div class="form-group">
                  <label for="categoryDesc">Category Description</label>
                  <textarea class="form-control" name="categoryDesc" id="categoryDesc"></textarea>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-sm-right">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?php include("../app/views/admin/inc/footer.php"); ?>
<script src="<?php echo URLROOT; ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo URLROOT; ?>/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
  $(function() {
    $('#newCategory').validate({
      rules: {
        categoryName: {
          required: true,
        },
        categoryDesc: {
          required: true,
          minlength: 10
        }
      },
      messages: {
        categoryName: {
          required: "Please enter category name",
        },
        categoryDesc: {
          required: "Please enter category description",
          minlength: "Description must be at least 100 characters long"
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
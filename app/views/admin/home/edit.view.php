<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/HomePage/covers"></a>HomePage</li>
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/HomePage/covers"></a>Cover</li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Edit Carrousel Cover </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="newCategory" action="<?php echo URLROOT; ?>/Dashborad/HomePage/updateCover/<?php echo $data->cover_id; ?>" enctype="multipart/form-data" method="post">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="coverTitle">Cover Title</label>
                                            <input type="text" name="coverTitle" class="form-control" id="coverTitle" placeholder="Cover Title" value="<?php echo $data->cover_title; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="coverLink">Cover Link</label>
                                            <input type="text" name="coverLink" class="form-control" id="coverLink" placeholder="Link" value="<?php echo $data->cover_href; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="CoverSubTitle">Cover Sub-Title</label>
                                            <input type="text" name="CoverSubTitle" class="form-control" id="CoverSubTitle" placeholder="Enter Cover Sub-Title" value="<?php echo $data->cover_sub_title; ?>">
                                        </div>
                                        <?php if ($data->status) { ?>
                                            <div class="form-group" style="position: relative;top: 38px;left: 27px;" <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="coversatus" id="coversatus" checked>
                                                <label for="coversatus" class="custom-control-label">Add this cover to home Page after creation</label>
                                            </div>
                                        <?php } else { ?>
                                            <div class="form-group" style="position: relative;top: 38px;left: 27px;" <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="coversatus" id="coversatus">
                                                <label for="coversatus" class="custom-control-label">Add this cover to home Page after creation</label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <figure class="preview">
                                    <img class="prevImg" src="<?php echo URLROOT; ?>/assets/covers/<?php echo $data->cover_img; ?>" alt="">
                                </figure>
                                <div class="row">
                                    <div id="coverImg" style="position: relative;left: 44px;margin-bottom: 30px;" class="el-upload el-upload--picture-card XXsnipcss_extracted_selector_selectionXX">
                                        <i class="fa fa-upload" style="color: gray;"></i>
                                    </div>
                                    <input type="file" id="uploader" name="imgCov" required="true" name="file" class="el-upload__input">

                                </div>
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
                coverTitle: {
                    required: true,
                },
                CoverSubTitle: {
                    required: true,
                },
                coverLink: {
                    required: true,
                    //url: true
                }
            },
            messages: {

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
    $('#coverImg').click(function() {
        $("#uploader").click();
    });

    $('#uploader').change(function() {
        let files = $(this).prop('files')
        let file = files[0];
        if (file) {
            if ($.inArray(file.type, ["image/gif", "image/jpeg", "image/png"]) >= 0) {
                var reader = new FileReader();
                reader.onload = function() {
                    if (!$(".preview").length) {
                        $("#coverImg").before('<figure class="preview">' +
                            '<img class="prevImg"  src="' + reader.result + '" alt="">' +
                            '</figure>');
                    } else {
                        $(".preview").replaceWith('<figure class="preview">' +
                            '<img class="prevImg"  src="' + reader.result + '" alt="">' +
                            '</figure>');
                    }
                }
                reader.readAsDataURL(file);
            }
        }
    });
</script>
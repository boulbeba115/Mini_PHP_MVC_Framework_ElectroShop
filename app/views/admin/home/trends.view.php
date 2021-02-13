<?php require_once("../app/views/admin/inc/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trends Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/HomePage/">HomePage</a> </li>
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/HomePage/trends">Trends</a> </li>
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
                    <div class="card card-primary" style="min-height: 700px;">
                        <div class="card-header">
                            <h4 class="card-title">Showing Products in the front Home Page</h4>
                        </div>
                        <div class="card-body" id="trends">
                            <div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <a id="showAll" class="btn btn-info active"> All items </a>
                                            </div>
                                            <div class="col-sm-5">
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
                                            <div class="col-sm-5">
                                                <select class="custom-select " id="subcategory">
                                                    <option disabled="disabled" selected>Sub-category!</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div id="ProdGallery" class="row" style="margin-top: 23px;">
                                    <?php
                                    foreach ($data['trends'] as $trend) { ?>
                                        <div class="prodContainer col-sm-2">
                                            <a href="<?php echo URLROOT . '/assets/ImgProduct/' . $trend->src ?>" data-toggle="lightbox" style="text-align: center;" data-title="<?php echo $trend->prod_name ?>">
                                                <img src="<?php echo URLROOT . '/assets/ImgProduct/' . $trend->src ?>" class="img-fluid p-image mb-2" alt="<?php echo $trend->alt ?>">
                                            </a>
                                            <p style="text-align: center;"><?php echo $trend->prod_name ?></p>
                                            <div class="p-middle">
                                                <a class="p-text" data-id="<?php echo $trend->prod_refer ?>"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>
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
<!-- Ekko Lightbox -->
<script src="<?php echo URLROOT; ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script>
    <?php
    $subCategories = json_encode($data['subCats']);
    $categories = json_encode($data['categories']);
    $products = json_encode($data['trends']);

    echo "let subCategories = " . $subCategories . ";";
    echo "let categories = " . $categories . ";";
    echo "let products = " . $products . ";";
    ?>
</script>
<script>
    // load subcategories
    $('#category').change(function() {
        let self = $(this)
        let id = self.val()
        let option = $("#category option:selected").text();
        if (id > 0) {
            let tab = subCategories.filter(x => x.category_name === option)
            $("#subcategory").children().remove();
            $("#subcategory").append('<option disabled="disabled" selected>Sub-Categories</option>');
            tab.forEach(x => {
                $("#subcategory").append('<option  value="' + x.id + '">' + x.sub_category_name + '</option>')
            })
        }
    })
</script>
<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

    })
    $("#subcategory").change(function() {
        let id = $(this).val();
        if (id) {
            let prods = products.filter(p => p.sub_cat === id);
            $("#ProdGallery").empty();
            if (prods.length > 0)
                prods.forEach(p => {
                    $("#ProdGallery").append('<div class=" prodContainer col-sm-2">' +
                        '<a href="<?php echo URLROOT . "/assets/ImgProduct/" ?>' + p.src + '" data-toggle="lightbox" style="text-align: center;" data-title="' + p.prod_name + '">' +
                        '<img src = "<?php echo URLROOT . "/assets/ImgProduct/" ?>' + p.src + '" class = "img-fluid mb-2" alt = "' + p.alt + '" >' +
                        '</a>' +
                        '<p style="text-align: center;">' + p.prod_name + '</p>' +
                        '<div class="p-middle">' +
                        '<a class="p-text"  data-prodRef="' + p.prod_refer + '" ><i class="fa fa-trash"></i></a>' +
                        '</div>' +
                        '</div >').hide().fadeIn('fast');

                })
        }
    });
    $('#showAll').click(function() {
        if (products.length > 0)
            products.forEach(p => {
                $("#ProdGallery").append('<div class=" prodContainer col-sm-2">' +
                    '<a href="<?php echo URLROOT . "/assets/ImgProduct/" ?>' + p.src + '" data-toggle="lightbox" style="text-align: center;" data-title="' + p.prod_name + '">' +
                    '<img src = "<?php echo URLROOT . "/assets/ImgProduct/" ?>' + p.src + '" class = "img-fluid mb-2" alt = "' + p.alt + '" >' +
                    '</a>' +
                    '<p style="text-align: center;">' + p.prod_name + '</p>' +
                    '<div class="p-middle">' +
                    '<a class="p-text" data-prodRef="' + p.prod_refer + '"><i class="fa fa-trash"></i></a>' +
                    '</div>' +
                    '</div >').hide().fadeIn('fast');

            })
    })
    $(document).on('click', '.p-text', function() {
        let prod_ref = $(this).data('id')
        let element = $(this).parent().parent()
        swal.fire({
            title: 'Are you sure?',
            text: "Do you want To Remove This Product From Trends",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url: '<?php echo URLROOT; ?>/Dashborad/HomePage/remove',
                        type: 'POST',
                        data: 'id=' + prod_ref,
                        dataType: 'json'
                    })
                    .done(function(response) {
                        element.remove();
                        swal.fire('Removed!', response.message, response.status);
                    })
                    .fail(function() {
                        swal.fire('Oops...', 'Something went wrong!', 'error');
                    });
            }
        })
    })
</script>
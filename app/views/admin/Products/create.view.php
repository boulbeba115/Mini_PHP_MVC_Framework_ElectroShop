<?php require_once("../app/views/admin/inc/header.php"); ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/dist/css/wizard.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/plugins/summernote/summernote-bs4.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/Dashborad/Products/">Products</a> </li>
                        <li class="breadcrumb-item active"> Add new Product</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" id="addProd">
        <div class="card wizard-card XXsnipcss_extracted_selector_selectionXX" data-color="bblue" id="wizard">
            <form action="" method="" id="addprodForm" enctype='multipart/form-data'>
                <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->
                <div class="wizard-header">
                    <h3 class="wizard-title">
                        Add Product
                    </h3>
                </div>
                <div class="wizard-navigation">
                    <ul class="nav nav-pills">
                        <li class="active" style="width: 33.3333%;">
                            <a href="#details" data-toggle="tab" aria-expanded="true">
                                Product Information
                            </a>
                        </li>
                        <li style="width: 33.3333%;">
                            <a href="#shortDesc" data-toggle="tab">
                                Short Description
                            </a>
                        </li>
                        <li style="width: 33.3333%;">
                            <a href="#longdesc" data-toggle="tab">
                                Full Product Description
                            </a>
                        </li>
                        <li style="width: 33.3333%;">
                            <a href="#prodImgs" data-toggle="tab">
                                Product Images
                            </a>
                        </li>
                        <li style="width: 33.3333%;">
                            <a href="#prodSpecs" data-toggle="tab">
                                Product Specifications
                            </a>
                        </li>
                    </ul>
                    <div class="moving-tab" style="width: 250px; transform: translate3d(-8px, 0px, 0px); transition: transform 0s ease 0s;">
                        Account
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="details">
                        <div class="row" id="prodInfo">
                            <div class="col-sm-12">
                                <h4 class="info-text">
                                    Add the Product information
                                </h4>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="prod-labels"> Product Reference</label>
                                    <input type="text" name="ProdReference" class="form-control" id="ProdReference" placeholder="Enter Product Reference">
                                </div>
                                <div class="form-group">
                                    <label class="prod-labels"> Product Name</label>
                                    <input type="text" name="ProdName" class="form-control" id="ProdName" placeholder="Enter Product Name">
                                </div>
                                <div class="form-group">
                                    <label class="prod-labels"> Brand</label>
                                    <input type="text" name="ProdBrand" class="form-control" id="ProdBrand" placeholder="Enter Product Brand">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group label-floating is-empty">
                                    <label class="prod-labels"> Product category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option disabled="" selected=true>Select Product Category</option>
                                        <?php print_r($data['categories']) ?>
                                        <?php
                                        foreach ($data['categories'] as $category) {
                                        ?>
                                            <option value="<?php echo ($category->id); ?>"><?php echo ($category->category_name); ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                                <div class="form-group label-floating is-empty">
                                    <label class="prod-labels"> Product SubCategory</label>
                                    <select class="form-control" id="subcategory" name="subcategory">
                                        <option disabled="" selected=true>Select Product Sub Category</option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                                <div class="form-group label-floating is-empty">
                                    <label class="prod-labels"> Product Sub-Sub Category</label>
                                    <select class="form-control" id="subsubcategory" name="subsubcategory">
                                        <option disabled="" selected=true>Select Product Sub-Sub Category</option>
                                    </select>
                                    <span class="material-input"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="prod-labels"> Product Stock Quantity</label>
                                    <input type="number" min="0" name="qtStock" class="form-control" id="qtStock" placeholder="Stock Quantity">
                                </div>
                                <div class="form-group">
                                    <label class="prod-labels"> Product Price </label>
                                    <input type="number" min="0" name="prix" class="form-control" id="prix" placeholder="Product Price">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="shortDesc">
                        <h4 class="info-text">
                            Product Short Description
                        </h4>
                        <div class="row">
                            <div class="form-group" style="width:100%;text-align:center">
                                <textarea required style="width: 80%; margin: 0 auto !important;outline: none;" class="shortDesc" id="prodShortDesc" name="shortDesc"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" id="longdesc">
                        <h4 class="info-text">
                            Product Full Details And Specifications
                        </h4>
                        <div class="row">
                            <textarea id="summernote" name="longDesc">
                            </textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="prodImgs">
                        <h4 class="info-text">
                            Product Images
                        </h4>
                        <div class="row">
                            <div id="prodImages" class="el-upload el-upload--picture-card XXsnipcss_extracted_selector_selectionXX">
                                <i class="fa fa-plus" style="color: gray;"></i>
                            </div>
                            <input type="file" id="uploader" name="file" class="el-upload__input" multiple>

                        </div>
                    </div>
                    <div class="tab-pane" id="prodSpecs">
                        <h4 class="info-text">
                            Product Full Details And Specifications (technical sheet)
                        </h4>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div style="display: -webkit-box;margin: 0 auto;">
                                        <input style="width: 332px;margin-right: 22px;" type="number" min="1" max="15" class="form-control" id="nbSpecs" placeholder="Number of Specs">
                                        <a class="mybtn" id="createSpecs"> Create </a>
                                        <!-- <a class="myloadbtn" id="loadSpecs"> Load </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" id="specsForm" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 style="text-align: center;">Spec Text</h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5 style="text-align: center;">Spec Value</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wizard-footer">
                    <div class="pull-right">
                        <input type="button" class="btn btn-next btn-fill btn-danger btn-wd" name="next" value="Next">
                        <input type="button" class="btn btn-finish btn-fill btn-danger btn-wd" name="finish" value="Finish" style="display: none;">
                    </div>
                    <div class="pull-left">
                        <input type="button" class="btn btn-previous btn-fill btn-default btn-wd disabled" name="previous" value="Previous">

                    </div>
                    <div class="clearfix">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php include("../app/views/admin/inc/footer.php"); ?>
<script src="<?php echo URLROOT; ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo URLROOT; ?>/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo URLROOT; ?>/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    //Initialize Data
    <?php
    $subCategories = json_encode($data['subcategories']);
    $ssCategories = json_encode($data['ssCategories']);
    $categories = json_encode($data['categories']);
    echo "let subCategories = " . $subCategories . ";";
    echo "let ssCategories = " . $ssCategories . ";";
    echo "let categories = " . $categories . ";";
    echo "let nbimg = 0;";
    echo 'let fieldCount = 0;';
    echo "let imgList = [];";
    ?>
</script>
<script>
    //Manage The wizard and Validation
    $(function() {
        $('.wizard-card form').validate({
            rules: {
                ProdReference: {
                    required: true,
                },
                ProdName: {
                    required: true,
                },
                ProdBrand: {
                    required: true,
                },
                category: {
                    required: true,
                },
                subcategory: {
                    required: true,
                },
                qtStock: {
                    required: true,
                },
                prix: {
                    required: true,
                },
                shortDesc: {
                    required: true,
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
    $(function() {
        $('#summernote').summernote()
        $(".btn-light").addClass("btn-danger")
        $(".btn-light").removeClass("btn-light")

    })
    $('#prodImages').click(function() {
        $("#uploader").click();
    });
    $('#uploader').change(function() {
        let files = $(this).prop('files')
        for (let file of files) {
            setTimeout(() => {
                if (file) {
                    if ($.inArray(file.type, ["image/gif", "image/jpeg", "image/png"]) >= 0) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            nbimg++
                            $("#prodImages").before('<figure class="snip">' +
                                '<img  id="imgp' + nbimg + '" style="width:140px;height:140px" src="' + reader.result + '" alt="">' +
                                '<i onclick="deleteimg(\'imgp' + nbimg + '\')" class="fa fa-trash delImg"></i>' +
                                '</figure>');
                            let img = reader.result;
                            imgList.push({
                                'id': 'imgp' + nbimg,
                                "image": img
                            });
                        }
                        reader.readAsDataURL(file);
                    }
                }
            }, 300)

        }

    });
    $(".hover").mouseleave(
        function() {
            $(this).removeClass("hover");
        }
    );
    $("#createSpecs").click(function() {
        if (!$("#nbSpecs").val()) {
            if (!$("#errorSpecs").length) {
                $('#nbSpecs').addClass("errorInForm")
                $('#createSpecs').parent().parent().after('<span id="errorSpecs" style="color:red;font-size: 12px;position: relative;top: -31px;">The field is empty <span/>')
            }
        } else {
            $('#errorSpecs').remove();
            $('#nbSpecs').removeClass("errorInForm")
            let nbFields = $('#nbSpecs').val();
            let container = $('#specsForm');
            container.css("display", "block");
            for (let i = 1; i <= nbFields; i++) {
                if (fieldCount < 15) {
                    container.append(
                        '<div class="row">' +
                        '<div class="col-sm-6">' +
                        '<input type="text" style="width: 50%; margin:0 auto;margin-bottom: 20px;" class="form-control specss " id="car' + i + '" name="car' + i + '" placeholder="name">' +
                        '</div>' +
                        '<div class="col-sm-6">' +
                        '<input type="text" style="width: 50%; margin:0 auto;margin-bottom: 20px;" class="form-control valss" id="val' + i + '" name="val' + i + '" placeholder="value">' +
                        '</div>' +
                        '</div>'
                    );
                    fieldCount++;
                }
            }

        }
    });

    function deleteimg(id) {
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
                let index = imgList.findIndex(x => x.id = id)
                if (index >= 0) {
                    imgList.splice(index, 1)
                    $("#" + id).parent().remove();
                }
            }
        })
    }
</script>
<script>
    $('#subcategory').click(() => {
        if (!$('#category').val()) {
            if (!$("#noption").length) {
                $("#subcategory").addClass("errorInForm")
                $("#subcategory").after('<span id="noption" style="color:red;font-size: 12px;">Select Category First <span/>')
            }
        } else {
            $('#noption').remove();
            $('#subcategory').removeClass("errorInForm")
        }
    })
    //load subCategory
    $('#category').change(function() {
        let self = $(this)
        let id = self.val()
        let option = $("#category option:selected").text();
        if (id > 0) {
            let tab = subCategories.filter(x => x.category_name === option)
            $("#subcategory").children().remove();
            $('#noption').remove();
            $('#subcategory').removeClass("errorInForm")
            tab.forEach(x => {
                $("#subcategory").append('<option value="' + x.id + '">' + x.sub_category_name + '</option>')
            })
        }
    })
    //check subsubcat
    $('#subsubcategory').click(() => {
        if (!$('#category').val()) {
            if (!$("#noption").length) {
                $("#subcategory").addClass("errorInForm")
                $("#subcategory").before('<span id="noption" style="color:red;font-size: 12px;">Select Category First <span/>')
            }
        } else if (!$('#subcategory').val()) {
            if (!$("#noption2").length) {
                $("#subsubcategory").addClass("errorInForm")
                $("#subsubcategory").before('<span id="noption2" style="color:red;font-size: 12px;">Select Category First <span/>')
            }
        } else {
            $('#noption').remove();
            $('#subcategory').removeClass("errorInForm")
        }
    })
    //load subsubCategory
    $('#subcategory').change(function() {
        let self = $(this)
        let id = self.val()
        let option = $("#subcategory option:selected").text();
        if (id > 0) {
            let tab = ssCategories.filter(x => x.sub_category_name === option)
            $("#subsubcategory").children().remove();
            $('#noption2').remove();
            $('#noption').remove();
            $('#subcategory').removeClass("errorInForm")
            $('#subsubcategory').removeClass("errorInForm")
            tab.forEach(x => {
                $("#subsubcategory").append('<option value="' + x.id + '">' + x.sub_sub_category_name + '</option>')
            })
        }
    })
    $('input[name ="next"]').click(function() {
        if (!$("#ProdReference").val()) {
            $("#ProdReference").addClass("errorInForm")
        }
        return
    })
    $("input[type=text]").click(function() {
        $(this).addClass("selectedIn")
    })
    $("input[type=number]").click(function() {
        $(this).addClass("selectedIn")
    })
</script>
<script>
    $(".btn-finish").click(function() {
        let loc = location
        let specs = [],
            keys = $(".specss").map((i, e) => e.value),
            valeus = $(".valss").map((i, e) => e.value);
        if (keys.length && valeus.length) {
            for (let i = 0; i < keys.length; i++) {
                if (!keys[i] || !valeus[i])
                    continue;
                else {
                    let k = keys[i],
                        v = valeus[i],
                        object = {};
                    object[k] = v;
                    specs.push(object)
                }
            }
        }
        let Product = {
            ProdReference: $("#ProdReference").val(),
            ProdName: $("#ProdName").val(),
            ProdBrand: $("#ProdBrand").val(),
            subcategory: $("#subcategory").val(),
            subsubcategory: $("#subsubcategory").val(),
            qtStock: $("#qtStock").val(),
            prix: $("#prix").val(),
            shortDesc: $("#prodShortDesc").val(),
            longDesc: $("#summernote").val(),
            productImages: imgList,
            technicalFile: specs
        }
        $.ajax({
                url: '<?php echo URLROOT; ?>/Dashborad/Products/add',
                type: 'POST',
                data: Product,
                dataType: 'json',
                success: function(response) {
                    location.href = "<?php echo URLROOT ?> " + '/Dashborad/Products';
                }
            })
            .fail(function() {
                swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
            });
    });
</script>
<script src="<?php echo URLROOT; ?>/dist/js/wizard.js"></script>
<?php include("inc/header.php"); ?>
<div class="banner-wrapper has_background">
    <img src="<?php echo URLROOT ?>/assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
    <div class="banner-wrapper-inner">
        <h1 class="page-title container">My Account</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs container">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="<?php echo URLROOT ?>"><span>Home</span></a></li>
                <li class="trail-item trail-end active"><span>My Account</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<main class="site-main  main-container no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="page-main-content">
                    <div class="kobolg">
                        <div class="kobolg-notices-wrapper"></div>
                        <div class="row" id="customer_login">
                            <div class="col-sm-12" style="background:#f6f6f6;">
                                <div class="col-sm-12" style="margin-top: 2%;"><?php flash('update_success') ?></div>
                                <h2 style="padding-top: 27px;">Account Details</h2>
                                <form method="post" class="kobolg-form kobolg-form-register register" action="<?php echo URLROOT ?>/Auth/UpdateCustomer">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                                <label for="firstName">FirstName &nbsp;<span class="required">*</span></label>
                                                <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['first_name_err'])) ? 'is-invalid' : ''; ?>" name="firstName" id="firstName" value="<?php echo (isset($data['user']->first_name)) ? $data['user']->first_name : ''; ?>">
                                                <span style="color:#e46145"><?php echo (isset($data['first_name_err'])) ? $data['first_name_err'] : ''; ?></span>
                                            </p>
                                            <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                                <label for="email">Email &nbsp;<span class="required">*</span></label>
                                                <input type="email" class="kobolg-Input kobolg-Input--text input-text " name="email" id="email" value="<?php echo (isset($data['user']->email)) ? $data['user']->email : ''; ?>" readonly>
                                            </p>
                                            <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                                <label for="cin">Cin &nbsp;<span class="required">*</span></label>
                                                <input type="text" class="kobolg-Input kobolg-Input--text input-text" name="cin" id="cin" value="<?php echo (isset($data['user']->cin)) ? $data['user']->cin : ''; ?>" readonly>
                                            </p>
                                            <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                                <label for="reg_email">Current Password&nbsp;<span class="required">*</span></label>
                                                <input type="password" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['old_pass_err'])) ? 'is-invalid' : ''; ?>" name="oldpass" id="oldpass">
                                                <span><i class="fa fa-eye ico-pass-eye" id="oldeye"></i></span>
                                                <span style="color:#e46145"><?php echo (isset($data['old_pass_err'])) ? $data['old_pass_err'] : ''; ?></span>
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                                <label for="lastName">LastName&nbsp;<span class="required">*</span></label>
                                                <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['last_name_err'])) ? 'is-invalid' : ''; ?>" name="lastName" id="lastName" value="<?php echo (isset($data['user']->last_name)) ? $data['user']->last_name : ''; ?>">
                                                <span style="color:#e46145"><?php echo (isset($data['last_name_err'])) ? $data['last_name_err'] : ''; ?></span>
                                            </p>
                                            <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                                <label for="text">Phone Number&nbsp;<span class="required">*</span></label>
                                                <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['phone_err'])) ? 'is-invalid' : ''; ?>" name="phone" id="phone" value="<?php echo (isset($data['user']->phone_number)) ? $data['user']->phone_number : ''; ?>">
                                                <span style="color:#e46145"><?php echo (isset($data['phone_err'])) ? $data['phone_err'] : ''; ?></span>
                                            </p>
                                            <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                                <label for="reg_email">Address&nbsp;<span class="required">*</span></label>
                                                <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['adress_err'])) ? 'is-invalid' : ''; ?>" name="adress" id="adress" value="<?php echo (isset($data['user']->adress)) ? $data['user']->adress : ''; ?>">
                                                <span style="color:#e46145"><?php echo (isset($data['adress_err'])) ? $data['adress_err'] : ''; ?></span>
                                            </p>
                                            <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                                <label for="reg_email">New Password&nbsp;</label>
                                                <input type="password" class="kobolg-Input kobolg-Input--text input-text pass?>" name="newpass" id="newpass">
                                                <span><i class="fa fa-eye ico-pass-eye" id="neweye"></i></span>
                                                <span style="color:#e46145"><?php echo (isset($data['new_pass_err'])) ? $data['new_pass_err'] : ''; ?></span>
                                            </p>
                                            <p class="kobolg-FormRow form-row" style="text-align: right;">
                                                <button type="submit" class="kobolg-Button button" name="register" value="Register">Edit My Account
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include("inc/footer.php"); ?>
<script>
    $(document).ready(function() {
        $("#neweye").click(function() {
            let e = $(this)
            let field = $("#newpass")
            if (field.prop("type") == "password") {
                field.prop("type", "text");
                e.removeClass("fa-eye");
                e.addClass("fa-eye-slash")
            } else {
                field.prop("type", "password");
                e.removeClass("fa-eye-slash");
                e.addClass("fa-eye")
            }
        })
        $("#oldeye").click(function() {
            let e = $(this)
            let field1 = $("#oldpass")
            if (field1.prop("type") == "password") {
                field1.prop("type", "text");
                e.removeClass("fa-eye");
                e.addClass("fa-eye-slash")
            } else {
                field1.prop("type", "password");
                e.removeClass("fa-eye-slash");
                e.addClass("fa-eye")
            }
        })
    })
</script>
<script>
    $(document).ready(function() {
        <?php
        if (isset($data['user'])) {
            echo 'let userInfo = ' . json_encode($data['user']) . ';';
        }
        ?>
        $('#firstName').val(userInfo.first_name)
        $('#lastName').val(userInfo.last_name)
        $('#email').val(userInfo.email)
        $('#phone').val(userInfo.phone_number)
        $('#adress').val(userInfo.adress)
        $('#cin').val(userInfo.cin)
    });
</script>
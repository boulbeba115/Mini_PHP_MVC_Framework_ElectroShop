<?php include("inc/header.php"); ?>
<div class="container">
    <div class="row">
        <div class="main-content col-md-12">
            <div class="page-main-content">
                <div class="kobolg">
                    <div class="kobolg-notices-wrapper"></div>
                    <div class="row" id="customer_login">
                        <div class="col-sm-12" style="background:#f6f6f6;">
                            <h2 style="padding-top: 27px;">Register</h2>
                            <form method="post" class="kobolg-form kobolg-form-register register" action="<?php echo URLROOT ?>/auth/registerCustomer">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                            <label for="firstName">FirstName &nbsp;<span class="required">*</span></label>
                                            <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['first_name_err'])) ? 'is-invalid' : ''; ?>" name="firstName" id="firstName" value="<?php echo (isset($data['first_name'])) ? $data['first_name'] : ''; ?>">
                                            <span style="color:#e46145"><?php echo (isset($data['first_name_err'])) ? $data['first_name_err'] : ''; ?></span>
                                        </p>
                                        <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                            <label for="email">Email &nbsp;<span class="required">*</span></label>
                                            <input type="email" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['email_err'])) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?php echo (isset($data['email'])) ? $data['email'] : ''; ?>">
                                            <span style="color:#e46145"><?php echo (isset($data['email_err'])) ? $data['email_err'] : ''; ?></span>
                                        </p>
                                        <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                            <label for="cin">Cin &nbsp;<span class="required">*</span></label>
                                            <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['cin_err'])) ? 'is-invalid' : ''; ?>" name="cin" id="cin" value="<?php echo (isset($data['cin'])) ? $data['cin'] : ''; ?>">
                                            <span style="color:#e46145"><?php echo (isset($data['cin_err'])) ? $data['cin_err'] : ''; ?></span>
                                        </p>
                                        <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                            <label for="reg_email">Password&nbsp;<span class="required">*</span></label>
                                            <input type="password" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['password_err'])) ? 'is-invalid' : ''; ?>" name="pass" id="pass">
                                            <span style="color:#e46145"><?php echo (isset($data['password_err'])) ? $data['password_err'] : ''; ?></span>
                                            <span><i class="fa fa-eye ico-pass-eye"></i></span>
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                            <label for="lastName">LastName&nbsp;<span class="required">*</span></label>
                                            <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['last_name_err'])) ? 'is-invalid' : ''; ?>" name="lastName" id="lastName" value="<?php echo (isset($data['last_name'])) ? $data['last_name'] : ''; ?>">
                                            <span style="color:#e46145"><?php echo (isset($data['last_name_err'])) ? $data['last_name_err'] : ''; ?></span>
                                        </p>
                                        <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                            <label for="text">Phone Number&nbsp;<span class="required">*</span></label>
                                            <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['phone_err'])) ? 'is-invalid' : ''; ?>" name="phone" id="phone" value="<?php echo (isset($data['phone_number'])) ? $data['phone_number'] : ''; ?>">
                                            <span style="color:#e46145"><?php echo (isset($data['phone_err'])) ? $data['phone_err'] : ''; ?></span>
                                        </p>
                                        <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                            <label for="reg_email">Address&nbsp;<span class="required">*</span></label>
                                            <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['adress_err'])) ? 'is-invalid' : ''; ?>" name="adress" id="adress" value="<?php echo (isset($data['adress'])) ? $data['adress'] : ''; ?>">
                                            <span style="color:#e46145"><?php echo (isset($data['adress_err'])) ? $data['adress_err'] : ''; ?></span>
                                        </p>
                                        <p class="kobolg-FormRow form-row">
                                            <button type="submit" class="kobolg-Button button" name="register" value="Register">Register
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
<?php include("inc/footer.php"); ?>
<script>
    $(document).ready(function() {
        $(".ico-pass-eye").click(function() {
            let e = $(this)
            let field = $("#pass")
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
    })
</script>
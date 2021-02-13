<?php include("inc/header.php"); ?>

<div class="container">
    <div class="row">
        <div class="main-content col-md-12">
            <div class="page-main-content">
                <div class="kobolg">
                    <div class="kobolg-notices-wrapper">
                        <?php flash('register_success'); ?>
                    </div>
                    <div class="u-columns col2-set" id="customer_login">
                        <div class="u-column1 col-1">
                            <h2>Login</h2>
                            <form class="kobolg-form kobolg-form-login login" method="post" action="<?php echo URLROOT ?>/auth/signIn">
                                <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                    <label for="username">Email address &nbsp;<span class="required">*</span></label>
                                    <input type="text" class="kobolg-Input kobolg-Input--text input-text <?php echo (isset($data['email_err'])) ? 'is-invalid' : ''; ?>" name="email" id="email" autocomplete="username" value="<?php echo (isset($data['email'])) ? $data['email'] : ''; ?>">
                                    <span style="color:#e46145"><?php echo (isset($data['email_err'])) ? $data['email_err'] : ''; ?></span>
                                </p>
                                <p class="kobolg-form-row kobolg-form-row--wide form-row form-row-wide">
                                    <label for="password">Password&nbsp;<span class="required">*</span></label>
                                    <input class="kobolg-Input kobolg-Input--text input-text  <?php echo (isset($data['password_err'])) ? 'is-invalid' : ''; ?>" type="password" name="password" id="password" autocomplete="current-password">
                                    <span style="color:#e46145"><?php echo (isset($data['password_err'])) ? $data['password_err'] : ''; ?></span>
                                </p>
                                <p class="form-row">
                                    <button type="submit" class="kobolg-Button button" name="login" value="Log in">Log in
                                    </button>
                                    <label class="kobolg-form__label kobolg-form__label-for-checkbox inline">
                                        <input class="kobolg-form__input kobolg-form__input-checkbox" checked name="rememberme" type="checkbox" id="rememberme" value="forever">
                                        <span>Remember me</span>
                                    </label>
                                </p>
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
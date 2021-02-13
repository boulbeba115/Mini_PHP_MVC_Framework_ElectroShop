<?php include("inc/header.php"); ?>
<div class="banner-wrapper has_background">
    <img src="assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
    <div class="banner-wrapper-inner">
        <h1 class="page-title container">Checkout</h1>
        <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs container">
            <ul class="trail-items breadcrumb">
                <li class="trail-item trail-begin"><a href="<?php echo URLROOT ?>"><span>Home</span></a></li>
                <li class="trail-item trail-end active"><span>Checkout</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<main class="site-main  main-container no-sidebar">
    <div>
        <div class="row">
            <div class="main-content col-md-12">
                <div class="page-main-content">
                    <div class="kobolg">
                        <div class="kobolg-notices-wrapper"></div>
                        <form name="checkout" method="post" class="checkout kobolg-checkout" action="#" enctype="multipart/form-data" novalidate="novalidate">
                            <div>
                                <div class="row" style="width:95%;margin:0 auto;">
                                    <div class="col-sm-6">
                                        <div class="kobolg-billing-fields" style="background-color: #f6f6f6;">
                                            <h3>Billing details</h3>
                                            <div class="kobolg-billing-fields__field-wrapper">
                                                <p class="form-row form-row-first validate-required" id="billing_first_name_field">
                                                    <label for="billing_first_name" class="">First name&nbsp; <abbr class="required" title="required">*</abbr></label>
                                                    <span class="kobolg-input-wrapper">
                                                        <input type="text" class="input-text " name="billing_first_name" id="billing_first_name" value="<?php echo (isset($data["user"])) ? $data['user']->first_name : ''; ?>">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-last validate-required" id="billing_last_name_field">
                                                    <label for="billing_last_name" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                    <span class="kobolg-input-wrapper">
                                                        <input type="text" class="input-text " name="billing_last_name" id="billing_last_name" value="<?php echo (isset($data["user"])) ? $data['user']->last_name : ''; ?>">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide addresses-field validate-required" id="billing_addresses_1_field">
                                                    <label for="billing_addresses_1" class="">Street address&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                    <span class="kobolg-input-wrapper"><input type="text" class="input-text " name="billing_addresses_1" id="billing_addresses_1" value="<?php echo (isset($data["user"])) ? $data['user']->adress : ''; ?>">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field">
                                                    <label for="billing_phone">Phone&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                    <span class="kobolg-input-wrapper"><input type="tel" class="input-text " name="billing_phone" id="billing_phone" value="<?php echo (isset($data["user"])) ? $data['user']->phone_number : ''; ?>">
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field">
                                                    <label for="billing_email" class="">Email
                                                        address&nbsp;<abbr class="required" title="required">*</abbr></label>
                                                    <span class="kobolg-input-wrapper">
                                                        <input type="email" id="billing_email" name="billing_email" class="input-text " disabled value=" <?php echo (isset($data["user"])) ? $data['user']->email : ''; ?>">
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h3 id="order_review_heading">Your order</h3>
                                        <div id="order_review" class="kobolg-checkout-review-order">
                                            <table class="shop_table kobolg-checkout-review-order-table">
                                                <thead>
                                                    <tr>
                                                        <th style="width:65%;text-align:center" class="product-name">Product</th>
                                                        <th style="width:5%;text-align:center" class="product-name">Qt</th>
                                                        <th style="width:30%;text-align:center" class="product-total">Total</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="card-details">

                                                </tbody>
                                                <tfoot>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td></td>
                                                        <td style="width: 100%;"><strong><span class="kobolg-Price-amount amount" id="totalSum">0</span></strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <input type="hidden" name="lang" value="en">
                                            <div id="payment" class="kobolg-checkout-payment">
                                                <ul class="wc_payment_methods payment_methods methods">
                                                    <li class="wc_payment_method payment_method_bacs">
                                                        <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="0" checked="checked" data-order_button_text="">
                                                        <label for="payment_method_bacs">
                                                            Direct bank transfer </label>
                                                        <div class="payment_box payment_method_bacs">
                                                            <p>Make your payment directly into our bank account. Please use your
                                                                Order ID as the payment reference. Your order will not be shipped
                                                                until the funds have cleared in our account.</p>
                                                        </div>
                                                    </li>
                                                    <li class="wc_payment_method payment_method_cheque">
                                                        <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="1" data-order_button_text="">
                                                        <label for="payment_method_cheque">
                                                            Check payments </label>
                                                        <div class="payment_box payment_method_cheque" style="display:none;">
                                                            <p>Please send a check to Store Name, Store Street, Store Town, Store
                                                                State / County, Store Postcode.</p>
                                                        </div>
                                                    </li>
                                                    <li class="wc_payment_method payment_method_cod">
                                                        <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="2" data-order_button_text="">
                                                        <label for="payment_method_cod">
                                                            Cash on delivery </label>
                                                        <div class="payment_box payment_method_cod" style="display:none;">
                                                            <p>Pay with cash upon delivery.</p>
                                                        </div>
                                                    </li>

                                                </ul>
                                                <div class="form-row place-order">
                                                    <noscript>
                                                        Since your browser does not support JavaScript, or it is disabled, please
                                                        ensure you click the <em>Update Totals</em> button before placing your
                                                        order. You may be charged more than the amount stated above if you fail to
                                                        do so. <br />
                                                        <button type="submit" class="button alt" name="kobolg_checkout_update_totals" value="Update totals">
                                                            Update totals
                                                        </button>
                                                    </noscript>
                                                    <div class="kobolg-terms-and-conditions-wrapper">
                                                        <div class="kobolg-privacy-policy-text">
                                                            <p>Your personal data will be
                                                                used to process your order, support your experience throughout this
                                                                website, and for other purposes described in our <a href="#" class="kobolg-privacy-policy-link" target="_blank">privacy
                                                                    policy</a>.</p>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="button alt" name="kobolg_checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place
                                                        order
                                                    </button>
                                                    <input type="hidden" id="kobolg-process-checkout-nonce" name="kobolg-process-checkout-nonce" value="634590c981"><input type="hidden" name="_wp_http_referer" value="/kobolg/?kobolg-ajax=update_order_review">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include("inc/footer.php"); ?>
<script>
    $(document).ready(function() {
        let card = $('#card-details')
        let total = 0
        if (JSON.parse(localStorage.getItem("shoppingCard")) == null || JSON.parse(localStorage.getItem("shoppingCard")).length == 0) {
            card.empty();
            $('.shop_table').before('<li class="kobolg-mini-cart-item mini_cart_item listItemStyle" Style="text-align:center">No Items Found</li>');
            $('.shop_table').css("display", "none")
        } else {
            let shoCard = JSON.parse(localStorage.getItem("shoppingCard"))
            $('#countshCard').text(shoCard.length)
            $('.minicart-number-items').text(shoCard.length)
            card.empty();
            shoCard.forEach(prod => {
                card.append(
                    '<tr class="cart_item">' +
                    '<td class="product-name">' + prod.name + '<strong class="product-quantity"></td>' +
                    '<td style="text-align:center" >' + prod.quantity + '</td>' +
                    '<td style="text-align:center" class="product-total">' +
                    '<span class="kobolg-Price-amount amount">' + prod.price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + ' TND</span> </td>' +
                    '<td><span id ="rmftab" data-id="' + prod.reference + '" class="fa fa-times"></span></td>' +
                    '</tr>');
                total += prod.price * prod.quantity
            });
            $('#totalSum').text(total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + ' TND')
        }

    });
    $(document).on("click", "#rmftab", function() {
        let current = $(this)
        let ref = $(this).data('id');
        let shoppingCard = []
        if (JSON.parse(localStorage.getItem("shoppingCard")) != null) {
            shoppingCard = JSON.parse(localStorage.getItem('shoppingCard'))
        }
        if (shoppingCard.length > 0) {
            let i = shoppingCard.findIndex(p => p.reference === ref)
            if (i > -1) {
                let total = 0;
                shoppingCard.splice(i, 1)
                shoppingCard.forEach(prod => {
                    total += prod.price * prod.quantity
                })
                localStorage.setItem("shoppingCard", JSON.stringify(shoppingCard))
                $('#totalSum').text(total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + ' TND')
                current.parent().parent().remove()
                let crd = $(".mini_cart_item a[data-id='" + ref + "']")
                $('#countshCard').text(shoppingCard.length)
                $('.minicart-number-items').text(shoppingCard.length)
                $('#totalInCard').text(total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + ' TND')
                crd.parent().remove()
                if (shoppingCard.length < 1) {
                    $('.shop_table').before('<li class="kobolg-mini-cart-item mini_cart_item listItemStyle" Style="text-align:center">No Items Found</li>');
                    $('.shop_table').css("display", "none")
                }
                swal.fire('Success!', 'Item removed from shopping card', 'success');
            }
        }
    });
    $(document).on("click", "#place_order", function(e) {
        if (JSON.parse(localStorage.getItem("shoppingCard")) != null) {
            orderline = JSON.parse(localStorage.getItem('shoppingCard'))
            if (orderline.length > 0) {
                let user = {
                    first_name: $('#billing_first_name').val(),
                    last_name: $('#billing_last_name').val(),
                    email: $('#billing_email').val(),
                    adress: $('#billing_addresses_1').val(),
                    phone_number: $('#billing_phone').val()
                }
                let order = {
                    user: user,
                    orderline: orderline,
                    payment_method: $(".wc_payment_methods  input[type='radio']:checked").val()
                }
                console.log(order);
                $.ajax({
                    method: 'POST',
                    url: '<?php echo URLROOT; ?>/CheckOut/placeOrder',
                    data: order,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == "error") {
                            swal.fire('Error!', response.message, 'error');
                        } else {
                            swal.fire('Success!', response.message, 'success');
                            localStorage.removeItem("shoppingCard")
                            setTimeout(() => {
                                location.href ='<?php echo URLROOT ?>'
                            }, 1000)
                        }
                    }
                });
            } else {
                swal.fire('Error!', 'No item found in the shopping card', 'error');
                return;
            }
        } else {
            swal.fire('Error!', 'No item found in the shopping card', 'error');
            return;
        }

    });
</script>
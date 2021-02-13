<footer id="footer" class="footer style-03">
    <div class="section-001 section-020">
        <div class="container">
            <div class="kobolg-newsletter style-03">
                <div class="newsletter-inner">
                    <div class="newsletter-info">
                        <div class="newsletter-wrap">
                            <h3 class="title">Newsletter</h3>
                            <h4 class="subtitle">Get Discount 30% Off</h4>
                        </div>
                    </div>
                    <div class="newsletter-form-wrap">
                        <div class="newsletter-form-inner">
                            <input class="email email-newsletter" name="email" placeholder="Enter your email ..." type="email">
                            <a href="#" class="button btn-submit submit-newsletter">
                                <span class="text">Subscribe</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kobolg-socials style-02">
                <div class="content-socials">
                    <ul class="socials-list">
                        <li>
                            <a href="https://facebook.com/" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/" target="_blank">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.pinterest.com/" target="_blank">
                                <i class="fa fa-pinterest-p"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section-021">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>© Copyright <?php echo date('Y') ?> <a href="#">Electro-Shop</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6">
                    <div class="kobolg-listitem style-03">
                        <div class="listitem-inner">
                            <ul class="listitem-list">
                                <li>
                                    <a href="#" target="_self">
                                        Contact </a>
                                </li>
                                <li>
                                    <a href="#" target="_self">
                                        Term &amp; Conditions </a>
                                </li>
                                <li>
                                    <a href="#" target="_self">
                                        Shipping </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer-device-mobile">
    <div class="wapper">
        <div class="footer-device-mobile-item device-home">
            <a href="index.html">
                <span class="icon">
                    <i class="fa fa-home" aria-hidden="true"></i>
                </span>
                Home
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-wishlist">
            <a href="wishlist.html">
                <span class="icon">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                </span>
                Wishlist
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-cart">
            <a href="cart.html">
                <span class="icon">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    <span class="count-icon">
                        0
                    </span>
                </span>
                <span class="text">Cart</span>
            </a>
        </div>
        <div class="footer-device-mobile-item device-home device-user">
            <a href="my-account.html">
                <span class="icon">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </span>
                Account
            </a>
        </div>
    </div>
</div>
<a href="#" class="backtotop active">
    <i class="fa fa-angle-up"></i>
</a>
<script src="<?php echo URLROOT; ?>/assets/js/jquery-1.12.4.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/chosen.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/countdown.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/jquery.scrollbar.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/lightbox.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/magnific-popup.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/slick.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/jquery.zoom.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/threesixty.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/jquery-ui.min.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/mobilemenu.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/functions.js"></script>
<script src="<?php echo URLROOT; ?>/assets/js/jquery.simplePagination.js"></script>
<script src="<?php echo URLROOT; ?>/dist/js/sweetalert2.min.js"></script>
<script>
    $(document).ready(function() {
        let card = $('#shop-card-desk')
        let total = 0
        if (JSON.parse(localStorage.getItem("shoppingCard")) == null) {
            card.empty();
            card.append('<li class="kobolg-mini-cart-item mini_cart_item" Style="text-align:center">No Items Found</li>');
        } else {
            let shoCard = JSON.parse(localStorage.getItem("shoppingCard"))
            $('#countshCard').text(shoCard.length)
            $('.minicart-number-items').text(shoCard.length)
            card.empty();
            shoCard.forEach(prod => {
                card.append(
                    '<li class="kobolg-mini-cart-item mini_cart_item">' +
                    '<a data-id="' + prod.reference + '" id="rmCard" class="remove remove_from_cart_button">×</a>' +
                    '<a href="<?php echo URLROOT ?>/index/product/' + prod.reference + '" style="width: 90%;">' +
                    '<img src="<?php echo URLROOT ?>/assets/ImgProduct/' + prod.src + '"  class="attachment-kobolg_thumbnail size-kobolg_thumbnail" alt="img" width="600" height="778">' + prod.name +
                    '</a>' +
                    '<span class="quantity">' + prod.quantity + ' × <span class="kobolg-Price-amount amount">' +
                    prod.price.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") +
                    ' TND </span></span>' +
                    '</li> '
                )
                total += prod.price * prod.quantity
            });
            $('#totalInCard').text(total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + ' TND')
        }

    })
    $(document).on("click", "#rmCard", function() {
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
                $('#countshCard').text(shoppingCard.length)
                $('.minicart-number-items').text(shoppingCard.length)
                localStorage.setItem("shoppingCard", JSON.stringify(shoppingCard))
                $('#totalInCard').text(total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + ' TND')
                current.parent().remove()
                if ($('#totalSum').length > 0) {
                    let crd = $("td span[data-id='" + ref + "']")
                    $('#totalSum').text(total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + ' TND')
                    crd.parent().parent().remove();
                    if (shoppingCard.length < 1) {
                        $('.shop_table').before('<li class="kobolg-mini-cart-item mini_cart_item listItemStyle" Style="text-align:center">No Items Found</li>');
                        $('.shop_table').css("display", "none")
                    }
                }
                swal.fire('Success!', 'Item removed from shopping card', 'success');
            }
        }
    });
</script>
</body>

</html>
<?php include("inc/header.php"); ?>
<?php if (isset($data["products"])) { ?>
    <?php if (count($data["products"]) > 0) { ?>
        <div class="banner-wrapper no_background">
            <div class="banner-wrapper-inner">
                <nav class="kobolg-breadcrumb container" style="text-align: left;">
                    <a href="<?php echo URLROOT ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="<?php echo URLROOT ?>/index/catagory/<?php echo $data["products"][0]->category_name ?>"> <?php echo $data["products"][0]->category_name ?></a>
                    <i class="fa fa-angle-right"></i>
                    <a href="<?php echo URLROOT ?>/index/subcatagory/<?php echo $data["products"][0]->sub_category_name ?>"> <?php echo $data["products"][0]->sub_category_name ?></a>
                    <?php if (isset($data["products"][0]->sub_sub_category_name)) { ?>
                        <i class="fa fa-angle-right"></i>
                        <a href="<?php echo URLROOT ?>/index/sSCategory/<?php echo $data["products"][0]->sub_sub_category_name ?>"> <?php echo $data["products"][0]->sub_sub_category_name ?></a>
                    <?php } ?>
                    <i class="fa fa-angle-right"></i>
                    <?php echo $data["products"][0]->prod_name ?>
                </nav>
            </div>
        </div>
        <div class="single-thumb-vertical main-container shop-page no-sidebar">
            <div class="container">
                <div class="row">
                    <div class="main-content col-md-12">
                        <div class="kobolg-notices-wrapper"></div>
                        <div id="product-27" class="post-27 product type-product status-publish has-post-thumbnail product_cat-table product_cat-new-arrivals product_cat-lamp product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-variable has-default-attributes">
                            <div class="main-contain-summary">
                                <div class="contain-left has-gallery">
                                    <div class="single-left">
                                        <div class="kobolg-product-gallery kobolg-product-gallery--with-images kobolg-product-gallery--columns-4 images">
                                            <a class="kobolg-product-gallery__trigger" href="<?php echo URLROOT . '/assets/ImgProduct/' . $data["products"][0]->src ?>" data-toggle="lightbox" style="text-align: center;" data-title="<?php echo $data["products"][0]->prod_name ?>">
                                                <img draggable="false" class="emoji" alt="🔍" src="https://s.w.org/images/core/emoji/11/svg/1f50d.svg"></a>
                                            <div class="flex-viewport">
                                                <figure class="kobolg-product-gallery__wrapper">
                                                    <?php foreach ($data["products"] as $prod) { ?>
                                                        <div class="kobolg-product-gallery__image">
                                                            <img src="<?php echo URLROOT . '/assets/ImgProduct/' . $prod->src ?>" alt="<?php echo $prod->alt ?>">
                                                        </div>
                                                    <?php } ?>
                                                </figure>
                                            </div>
                                            <ol class="flex-control-nav flex-control-thumbs">
                                                <?php foreach ($data["products"] as $prod) { ?>
                                                    <li><img src="<?php echo URLROOT . '/assets/ImgProduct/' . $prod->src ?>" alt="<?php echo $prod->alt ?>">
                                                    <?php } ?>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="summary entry-summary">
                                        <div class="flash">
                                            <span class="onnew"><span class="text">New</span></span>
                                        </div>
                                        <h1 class="product_title entry-title"><?php echo $data["products"][0]->prod_name ?></h1>
                                        <p class="price"><span class="kobolg-Price-amount amount">
                                            </span> <?php echo number_format($data["products"][0]->prod_price) . ' TND' ?></span>
                                        </p>
                                        <p>
                                            <span class="sku_wrapper">Reference: <span class="sku"><?php echo $prod->prod_refer ?></span></span>
                                        </p>
                                        <p class="stock in-stock">
                                            <?php if ($data["products"][0]->qt_stock > 0) { ?>
                                                Availability: <span style="color:green"> In stock</span>
                                            <?php } else { ?>
                                                Availability: <span> Out of stock</span>
                                            <?php } ?>
                                        </p>
                                        <div class="kobolg-product-details__short-description">
                                            <p><?php echo $data["products"][0]->prod_short_desc ?></p>
                                        </div>
                                        <form class="variations_form cart">
                                            <div class="single_variation_wrap">
                                                <div class="kobolg-variation single_variation"></div>
                                                <div class="kobolg-variation-add-to-cart variations_button">
                                                    <div class="quantity">
                                                        <span class="qty-label">Quantiy:</span>
                                                        <div class="control">
                                                            <a class="btn-number qtyminus quantity-minus" href="#">-</a>
                                                            <input id="cmd-qt" type="text" data-step="1" min="0" max="<?php echo $prod->qt_stock ?>" name="quantity[25]" value="0" title="Qty" class="input-qty input-text qty text" size="4" pattern="[0-9]*" inputmode="numeric">
                                                            <a class="btn-number qtyplus quantity-plus" href="#">+</a>
                                                        </div>
                                                    </div>
                                                    <button type="submit" id="add-to-cart" class="single_add_to_cart_button button alt kobolg-variation-selection-needed">
                                                        Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="clear"></div>
                                        <span>left In Stock: <?php echo $prod->qt_stock ?></span>
                                        </br>
                                        <div class="product_meta">
                                            <div class="wcml-dropdown product wcml_currency_switcher">
                                                <ul>
                                                    <li class="wcml-cs-active-currency">
                                                        <a class="wcml-cs-item-toggle">USD</a>
                                                        <ul class="wcml-cs-submenu">
                                                            <li>
                                                                <a>EUR</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="kobolg-share-socials">
                                            <h5 class="social-heading">Share: </h5>
                                            <a target="_blank" class="facebook" href="#">
                                                <i class="fa fa-facebook-f"></i>
                                            </a>
                                            <a target="_blank" class="twitter" href="#"><i class="fa fa-twitter"></i>
                                            </a>
                                            <a target="_blank" class="pinterest" href="#"> <i class="fa fa-pinterest"></i>
                                            </a>
                                            <a target="_blank" class="googleplus" href="#"><i class="fa fa-google-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="kobolg-tabs kobolg-tabs-wrapper">
                                <ul class="tabs dreaming-tabs" role="tablist">
                                    <li class="description_tab active" id="tab-title-description" role="tab" aria-controls="tab-description">
                                        <a href="#tab-description">Description</a>
                                    </li>
                                    <li class="additional_information_tab" id="tab-title-additional_information" role="tab" aria-controls="tab-additional_information">
                                        <a href="#tab-additional_information">Additional information</a>
                                    </li>
                                    <li class="reviews_tab" id="tab-title-reviews" role="tab" aria-controls="tab-reviews">
                                        <a href="#tab-reviews">Reviews (0)</a>
                                    </li>
                                </ul>
                                <div class="kobolg-Tabs-panel kobolg-Tabs-panel--description panel entry-content kobolg-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                                    <h2>Description</h2>
                                    <div class="container-table">
                                        <?php echo html_entity_decode($data["products"][0]->prod_long_desc); ?>
                                    </div>
                                </div>
                                <div class="kobolg-Tabs-panel kobolg-Tabs-panel--additional_information panel entry-content kobolg-tab" id="tab-additional_information" role="tabpanel" aria-labelledby="tab-title-additional_information">
                                    <h2>Additional information</h2>
                                    <table class="shop_attributes">
                                        <tbody>
                                            <?php if (isset($data['specs'])) {
                                                foreach ($data['specs'] as  $value) {
                                                    foreach ($value as  $key => $spec) { ?>
                                                        <tr>
                                                            <th><?php print_r($key); ?></th>
                                                            <td>
                                                                <p><?php print_r($spec); ?></p>
                                                            </td>
                                                        </tr>
                                            <?php }
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="kobolg-Tabs-panel kobolg-Tabs-panel--reviews panel entry-content kobolg-tab" id="tab-reviews" role="tabpanel" aria-labelledby="tab-title-reviews">
                                    <div id="reviews" class="kobolg-Reviews">
                                        <div id="comments">
                                            <h2 class="kobolg-Reviews-title">Reviews</h2>
                                            <p class="kobolg-noreviews">There are no reviews yet.</p>
                                        </div>
                                        <div id="review_form_wrapper">
                                            <div id="review_form">
                                                <div id="respond" class="comment-respond">
                                                    <span id="reply-title" class="comment-reply-title">Be the first to review “T-shirt with skirt”</span>
                                                    <form id="commentform" class="comment-form">
                                                        <p class="comment-notes"><span id="email-notes">Your email addresses will not be published.</span>
                                                            Required fields are marked <span class="required">*</span></p>
                                                        <p class="comment-form-author">
                                                            <label for="author">Name&nbsp;<span class="required">*</span></label>
                                                            <input id="author" name="author" value="" size="30" required="" type="text">
                                                        </p>
                                                        <p class="comment-form-email"><label for="email">Email&nbsp;
                                                                <span class="required">*</span></label>
                                                            <input id="email" name="email" value="" size="30" required="" type="email">
                                                        </p>
                                                        <div class="comment-form-rating"><label for="rating">Your rating</label>
                                                            <p class="stars">
                                                                <span>
                                                                    <a class="star-1" href="#">1</a>
                                                                    <a class="star-2" href="#">2</a>
                                                                    <a class="star-3" href="#">3</a>
                                                                    <a class="star-4" href="#">4</a>
                                                                    <a class="star-5" href="#">5</a>
                                                                </span>
                                                            </p>
                                                            <select title="product_cat" name="rating" id="rating" required="" style="display: none;">
                                                                <option value="">Rate…</option>
                                                                <option value="5">Perfect</option>
                                                                <option value="4">Good</option>
                                                                <option value="3">Average</option>
                                                                <option value="2">Not that bad</option>
                                                                <option value="1">Very poor</option>
                                                            </select>
                                                        </div>
                                                        <p class="comment-form-comment"><label for="comment">Your
                                                                review&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" required=""></textarea></p><input name="wpml_language_code" value="en" type="hidden">
                                                        <p class="form-submit"><input name="submit" id="submit" class="submit" value="Submit" type="submit"> <input name="comment_post_ID" value="27" id="comment_post_ID" type="hidden">
                                                            <input name="comment_parent" id="comment_parent" value="0" type="hidden">
                                                        </p>
                                                    </form>
                                                </div><!-- #respond -->
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?php include("inc/footer.php"); ?>
<!-- Ekko Lightbox -->
<script src="<?php echo URLROOT; ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<script>
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

    })
    $(document).ready(function() {
        $("#add-to-cart").click(function(e) {
            e.preventDefault();
            let element = $(this)
            <?php
            if (isset($data["products"])) {
                if (count($data["products"]) > 0) {
                    $prod = json_encode($data["products"][0]);
                    echo "let prod = " . $prod . ";";
                } else {
                    echo 'return;';
                }
            } else {
                echo 'return;';
            }

            ?>
            if (prod.qt_stock < 1) {
                element.prop("disabled", true)
                element.after('</br> <span id="outofstock" style="color:red">this product is out of stock</span>')
                return
            }
            let product = {
                reference: prod.prod_refer,
                name: prod.prod_name,
                price: prod.prod_price,
                quantity: $("#cmd-qt").val(),
                src: prod.src
            }
            if (product.quantity == 0) {
                return
            }
            let shoppingCard = []
            if (JSON.parse(localStorage.getItem("shoppingCard")) != null) {
                shoppingCard = JSON.parse(localStorage.getItem('shoppingCard'))
            }
            if (shoppingCard.length > 0) {
                let i = shoppingCard.findIndex(p => p.reference === product.reference)
                if (i >= 0) {
                    let p = shoppingCard[i]
                    p.quantity = (parseInt(p.quantity) + parseInt(product.quantity)).toString()
                    shoppingCard.splice(i, 1)
                    shoppingCard.push(p)
                } else shoppingCard.push(product)
            } else shoppingCard.push(product)

            localStorage.setItem("shoppingCard", JSON.stringify(shoppingCard))
            swal.fire('Success!', 'Item Added to shopping card', 'success');
            //update Card
            let card = $('#shop-card-desk')
            let total = 0
            if (JSON.parse(localStorage.getItem("shoppingCard")) == null) {
                card.empty();
                card.append('<li id =class="kobolg-mini-cart-item mini_cart_item" Style="text-align:center">No Items Found</li>');
            } else {
                let shoCard = JSON.parse(localStorage.getItem("shoppingCard"))
                $('#countshCard').text(shoCard.length)
                $('.minicart-number-items').text(shoCard.length)
                card.empty();
                shoCard.forEach(prod => {
                    card.append(
                        '<li class="kobolg-mini-cart-item mini_cart_item">' +
                        '<a href="#"  data-id="' + prod.reference + '" id="rmCard" class="remove remove_from_cart_button">×</a>' +
                        '<a href="#" style="width: 90%;">' +
                        '<img src="<?php echo URLROOT ?>/assets/ImgProduct/' + prod.src + '"  class="attachment-kobolg_thumbnail size-kobolg_thumbnail" alt="img" width="600" height="778">' + prod.name +
                        '</a>' +
                        '<span class="quantity">' + prod.quantity + ' × <span class="kobolg-Price-amount amount">' + prod.price + ' TND </span></span>' +
                        '</li> '
                    )
                    total += prod.price * prod.quantity
                });
                $('#totalInCard').text(total.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",") + ' TND')
            }

        });
    })
</script>
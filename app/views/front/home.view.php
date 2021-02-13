<?php include("inc/header.php"); ?>
<div class="fullwidth-template">
    <div class="slide-home-03">
        <div class="response-product product-list-owl owl-slick equal-container better-height" data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:0,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:1,&quot;rows&quot;:1}" data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}}]">
            <?php
            foreach ($data['covers'] as $cover) { ?>
                <div class="slide-wrap">
                    <img src="<?php echo URLROOT ?>/assets/covers/<?php echo $cover->cover_img ?>" style="width:100%;max-height: 650px;" alt="<?php echo $cover->cover_title ?>">
                    <div class="slide-info">
                        <div class="container">
                            <div class="slide-inner">
                                <h1><?php echo $cover->cover_title ?></h1>
                                <h5><?php echo $cover->cover_sub_title ?> </h5>
                                <h2><span>Electro </span>Shop</h2>
                                <a href="<?php echo $cover->cover_href ?>">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="section-001">
        <div class="container">
            <div class="kobolg-heading style-01">
                <div class="heading-inner">
                    <h3 class="title">
                        Top Trend </h3>
                    <div class="subtitle">
                        Browse our website for the hottest items in the marketplace now.
                    </div>
                </div>
            </div>
            <div class="kobolg-products style-04">
                <div class="response-product product-list-grid row auto-clear equal-container better-height ">
                    <?php foreach ($data['trends'] as $trend) { ?>
                        <div class="product-item best-selling style-04 rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-ts-6 post-25 product type-product status-publish has-post-thumbnail product_cat-light product_cat-chair product_cat-specials product_tag-light product_tag-sock first instock sale featured shipping-taxable purchasable product-type-simple">
                            <div class="product-inner tooltip-top tooltip-all-top">
                                <div class="product-thumb">
                                    <a class="thumb-link" href="<?php echo URLROOT ?>/index/product/<?php echo $trend->prod_refer ?>">
                                        <img class="img-responsive" src="<?php echo URLROOT . '/assets/ImgProduct/' . $trend->src ?>" alt="<?php echo $trend->prod_name ?>" width="270" height="350">
                                    </a>
                                    <div class="group-button">
                                        <div class="add-to-cart">
                                            <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-id="<?php echo $trend->prod_refer ?>">Add to cart</a>
                                        </div>
                                        <a href="#" class="button yith-wcqv-button">Quick View</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-name product_title">
                                        <a href="#"><?php echo $trend->prod_name ?></a>
                                    </h3>
                                    <span class="price"> <ins><span class="kobolg-Price-amount amount"><?php echo number_format($trend->prod_price) ?></span><span class="kobolg-Price-currencySymbol"> TND</span></ins></span>
                                    <div class="rating-wapper nostar">
                                        <div class="star-rating"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5</span></div> <span class="review">(0)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- OWL Products -->
                <div class="shop-all">
                    <a target=" _blank" href="#">Discovery All</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("inc/footer.php"); ?>
<script>
    $(document).on("click", ".ajax_add_to_cart", function() {
        let id = $(this).data('id');
        <?php
        $prod = json_encode($data["trends"]);
        echo "let products = " . $prod . ";";
        ?>
        let index = products.findIndex(p => p.prod_refer == id),
            prod = [];
        if (index >= 0) {
            prod = products[index]
        } else {
            return
        }
        let product = {
            reference: prod.prod_refer,
            name: prod.prod_name,
            price: prod.prod_price,
            quantity: 1,
            src: prod.src
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
</script>
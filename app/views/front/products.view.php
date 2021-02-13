<?php include("inc/header.php"); ?>
<?php if (isset($data["products"])) { ?>
    <?php if (count($data["products"]) > 0) { ?>
        <div class="banner-wrapper has_background">
            <img src="<?php echo URLROOT ?>/assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img">
            <div class="banner-wrapper-inner">

                <h1 class="page-title container"><?php echo $data["products"][0]->category_name ?></h1>
                <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs container">
                    <ul class="trail-items breadcrumb">
                        <li class="trail-item trail-begin"><a href="<?php echo URLROOT ?>"><span>Home</span></a></li>
                        <li class="trail-item trail-end active"><span><?php echo $data["products"][0]->category_name ?></span>
                        <li class="trail-item trail-end active"><span><?php echo $data["products"][0]->sub_category_name ?></span>
                            <?php if (isset($data["products"][0]->sub_sub_category_name)) { ?>
                        <li class="trail-item trail-end active"><span><?php echo $data["products"][0]->sub_sub_category_name  ?></span>
                        <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-container shop-page left-sidebar">
            <div class="container">
                <div class="row">
                    <div class="main-content col-xl-9 col-lg-8 col-md-8 col-sm-12 has-sidebar">
                        <div class="shop-control shop-before-control">
                            <div class="grid-view-mode">
                                <form>
                                    <a href="shop.html" data-toggle="tooltip" data-placement="top" class="modes-mode mode-grid display-mode active" value="grid">
                                        <span class="button-inner">
                                            Shop Grid
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </span>
                                    </a>
                                    <a href="shop-list.html" data-toggle="tooltip" data-placement="top" class="modes-mode mode-list display-mode " value="list">
                                        <span class="button-inner">
                                            Shop List
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </span>
                                    </a>
                                </form>
                            </div>
                            <form class="kobolg-ordering" method="get">
                                <select title="product_cat" name="orderby" class="orderby">
                                    <option value="menu_order" selected="selected">Default sorting</option>
                                    <option value="date">Sort by latest</option>
                                    <option value="price">Sort by price: low to high</option>
                                    <option value="price-desc">Sort by price: high to low</option>
                                </select>
                            </form>
                        </div>
                        <div class=" auto-clear equal-container better-height kobolg-products">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="pagination-container"></div>
                                </div>
                            </div>
                            <ul class="row products columns-3 electroShopProds">
                                <?php foreach ($data["products"] as $prod) { ?>
                                    <li class="product-item wow fadeInUp product-item rows-space-30 col-bg-4 col-xl-4 col-lg-6 col-md-6 col-sm-6 col-ts-6 style-01 post-24 product type-product status-publish has-post-thumbnail product_cat-chair product_cat-table product_cat-new-arrivals product_tag-light product_tag-hat product_tag-sock first instock featured shipping-taxable purchasable product-type-variable has-default-attributes" data-wow-duration="1s" data-wow-delay="0ms" data-wow="fadeInUp">
                                        <div class="product-inner tooltip-left">
                                            <div class="product-thumb">
                                                <a class="thumb-link" href="<?php echo URLROOT ?>/index/product/<?php echo $prod->prod_refer ?>">
                                                    <img class="img-responsive" src="<?php echo URLROOT . '/assets/ImgProduct/' . $prod->src ?>" alt="<?php echo $prod->prod_name ?>" width="600" height="778">
                                                </a>
                                                <div class="group-button">
                                                    <a class="button yith-wcqv-button" href="<?php echo URLROOT . '/assets/ImgProduct/' . $prod->src ?>" data-toggle="lightbox" style="text-align: center;" data-title="<?php echo $prod->prod_name ?>"></a>
                                                    <div class="add-to-cart">
                                                        <a class="button product_type_variable add_to_cart_button" id="addscard" data-id="<?php echo $prod->prod_refer ?>">Select options</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info equal-elem">
                                                <h3 class="product-name product_title">
                                                    <a href="#"><?php echo $prod->prod_name ?></a>
                                                </h3>
                                                <div class="rating-wapper nostar">
                                                    <div class="star-rating"><span style="width:0%">Rated <strong class="rating">0</strong> out of 5</span></div>
                                                    <span class="review">(0)</span>
                                                </div>
                                                <span class="price"><span class="kobolg-Price-amount amount"><?php echo number_format($prod->prod_price) . ' TND' ?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="shop-control shop-after-control">
                            <p class="kobolg-result-count">Showing 1–12 of <?php echo count($data["products"]) ?> results</p>
                        </div>
                    </div>
                    <div class="sidebar col-xl-3 col-lg-4 col-md-4 col-sm-12">
                        <div id="widget-area" class="widget-area shop-sidebar">
                            <div id="kobolg_product_search-2" class="widget kobolg widget_product_search">
                                <form class="kobolg-product-search">
                                    <input id="kobolg-product-search-field-0" class="search-field" placeholder="Search products…" value="" name="s" type="search">
                                    <button type="submit" value="Search">Search</button>
                                </form>
                            </div>
                            <div id="kobolg_price_filter-2" class="widget kobolg widget_price_filter">
                                <h2 class="widgettitle">Filter By Price<span class="arrow"></span></h2>
                                <form method="get" action="#">
                                    <div class="price_slider_wrapper">
                                        <div data-label-reasult="Range:" data-min="0" data-max="1000" data-unit="$" class="price_slider" data-value-min="100" data-value-max="800">
                                        </div>
                                        <div class="price_slider_amount">
                                            <button type="submit" class="button">Filter</button>
                                            <div class="price_label">
                                                Price: <span class="from">$100</span> — <span class="to">$800</span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="kobolg_layered_nav-6" class="widget kobolg widget_layered_nav kobolg-widget-layered-nav">
                                <h2 class="widgettitle">Filter By Size<span class="arrow"></span></h2>
                                <ul class="kobolg-widget-layered-nav-list">
                                    <li class="kobolg-widget-layered-nav-list__item kobolg-layered-nav-term ">
                                        <a rel="nofollow" href="#">XS</a>
                                        <span class="count">(1)</span>
                                    </li>
                                    <li class="kobolg-widget-layered-nav-list__item kobolg-layered-nav-term ">
                                        <a rel="nofollow" href="#">S</a>
                                        <span class="count">(4)</span>
                                    </li>
                                    <li class="kobolg-widget-layered-nav-list__item kobolg-layered-nav-term ">
                                        <a rel="nofollow" href="#">M</a>
                                        <span class="count">(2)</span>
                                    </li>
                                    <li class="kobolg-widget-layered-nav-list__item kobolg-layered-nav-term ">
                                        <a rel="nofollow" href="#">L</a>
                                        <span class="count">(3)</span>
                                    </li>
                                    <li class="kobolg-widget-layered-nav-list__item kobolg-layered-nav-term ">
                                        <a rel="nofollow" href="#">XL</a>
                                        <span class="count">(1)</span>
                                    </li>
                                    <li class="kobolg-widget-layered-nav-list__item kobolg-layered-nav-term ">
                                        <a rel="nofollow" href="#">XXL</a>
                                        <span class="count">(4)</span>
                                    </li>
                                    <li class="kobolg-widget-layered-nav-list__item kobolg-layered-nav-term ">
                                        <a rel="nofollow" href="#">3XL</a>
                                        <span class="count">(4)</span>
                                    </li>
                                    <li class="kobolg-widget-layered-nav-list__item kobolg-layered-nav-term ">
                                        <a rel="nofollow" href="#">4XL</a>
                                        <span class="count">(3)</span>
                                    </li>
                                </ul>
                            </div>
                            <div id="kobolg_product_categories-3" class="widget kobolg widget_product_categories">
                                <h2 class="widgettitle">Product categories<span class="arrow"></span></h2>
                                <ul class="product-categories">
                                    <li class="cat-item cat-item-22"><a href="#">Camera</a>
                                        <span class="count">(11)</span>
                                    </li>
                                    <li class="cat-item cat-item-16"><a href="#">Accessories</a>
                                        <span class="count">(9)</span>
                                    </li>
                                    <li class="cat-item cat-item-24"><a href="#">Game & Consoles</a>
                                        <span class="count">(6)</span>
                                    </li>
                                    <li class="cat-item cat-item-27"><a href="#">Life style</a> <span class="count">(6)</span></li>
                                    <li class="cat-item cat-item-19"><a href="#">New arrivals</a>
                                        <span class="count">(7)</span>
                                    </li>
                                    <li class="cat-item cat-item-17"><a href="#">Summer Sale</a>
                                        <span class="count">(6)</span>
                                    </li>
                                    <li class="cat-item cat-item-26"><a href="#">Specials</a> <span class="count">(4)</span></li>
                                    <li class="cat-item cat-item-18"><a href="#">Featured</a> <span class="count">(6)</span></li>
                                </ul>
                            </div>
                        </div><!-- .widget-area -->
                    </div>
                </div>
            </div>
        </div>


    <?php } else { ?>
        <div class="main-container text-center error-404 not-found">
            <div class="container">
                <h1 class="title">No Product Found !!!</h1>
                <a href="<?php echo URLROOT; ?>" class="button">Back to hompage</a>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<?php include("inc/footer.php"); ?>

<!-- Ekko Lightbox -->
<script src="<?php echo URLROOT; ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<script>
    //Paginate Products
    $(document).ready(function() {
        let items = $(".electroShopProds .product-item");
        let numItems = items.length;
        let perPage = 12;

        items.slice(perPage).hide();
        $('#pagination-container').pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function(pageNumber) {
                let showFrom = perPage * (pageNumber - 1);
                let showTo = showFrom + perPage;
                $(".kobolg-result-count").text('Showing ' + showFrom + '-' + showTo + ' of ' + items.length + ' results')
                items.hide().slice(showFrom, showTo).show();
            }
        });
    });
    $(function() {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

    })
    $(document).on("click", "#addscard", function() {
        let id = $(this).data('id');
        <?php
        $prod = json_encode($data["products"]);
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
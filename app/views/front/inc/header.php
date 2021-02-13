<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo URLROOT; ?>/assets/images/favicon.png" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/chosen.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/jquery.scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/lightbox.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/magnific-popup.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/fonts/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/megamenu.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/dreaming-attribute.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/dist/css/sweetalert2.min.css">
    <title><?php echo SITENAME; ?></title>
</head>

<body>
    <header id="header" class="header style-04 header-dark">
        <div class="header-top">
            <div class="container">
                <div class="header-top-inner">
                    <ul id="menu-top-left-menu" class="kobolg-nav top-bar-menu">
                        <li id="menu-item-864" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-864"><a class="kobolg-menu-item-title" title="Store Direction" href="#"><span class="icon flaticon-placeholder"></span>Store
                                Direction</a></li>
                        <li id="menu-item-865" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-865"><a class="kobolg-menu-item-title" title="Order Tracking" href="#"><span class="icon flaticon-box"></span>Order
                                Tracking</a></li>
                    </ul>
                    <div class="kobolg-nav top-bar-menu right">
                        <ul class="wpml-menu">
                            <li class="menu-item kobolg-dropdown block-language">
                                <a href="#" data-kobolg="kobolg-dropdown">
                                    <img src="<?php echo URLROOT; ?>/assets/images/en.png" alt="en" width="18" height="12">
                                    English
                                </a>
                                <span class="toggle-submenu"></span>
                                <ul class="sub-menu">
                                    <li class="menu-item">
                                        <a href="#">
                                            <img src="<?php echo URLROOT; ?>/assets/images/fr.png" alt="it" width="18" height="12">
                                            Frensh
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php if (isset($data['isLogged']) && $data['isLogged']) { ?>
                                <li class="menu-item kobolg-dropdown block-language">
                                    <a href="<?php echo URLROOT ?>/index/account" data-kobolg="kobolg-dropdown">
                                        <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>
                                    </a>
                                    <span class="toggle-submenu"></span>
                                    <ul class="sub-menu">
                                        <li class="menu-item">
                                            <?php if (isset($data['isLogged'])) {
                                                if ($data['isLogged']) { ?>
                                                    <a href="<?php echo URLROOT ?>/index/account">My Account</a>
                                                    <a href="<?php echo URLROOT ?>/orders">Orders</a>
                                                    <a href="<?php echo URLROOT ?>/checkOut">CheckOut</a>
                                                    <a href="<?php echo URLROOT ?>/auth/logout">Logout</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo URLROOT ?>/auth/login">Login</a>
                                                    <a href="<?php echo URLROOT ?>/auth/register">Register</a>
                                                <?php }
                                            } else { ?>
                                                <a href="<?php echo URLROOT ?>/auth/login">Login</a>
                                                <a href="<?php echo URLROOT ?>/auth/register">Register</a>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle">
            <div class="container">
                <div class="header-middle-inner">
                    <div class="header-logo-menu">
                        <div class="block-menu-bar">
                            <a class="menu-bar menu-toggle" href="#">
                                <span></span>
                                <span></span>
                                <span></span>
                            </a>
                        </div>
                        <div class="header-logo">
                            <a href="<?php echo URLROOT ?>"><img alt="Kobolg" src="<?php echo URLROOT ?>/assets/images/logo.png" class="logo"></a>
                        </div>
                    </div>
                    <div class="header-search-mid">
                        <div class="header-search">
                            <div class="block-search">
                                <form role="search" method="get" class="form-search block-search-form kobolg-live-search-form">
                                    <div class="form-content search-box results-search">
                                        <div class="inner">
                                            <input autocomplete="off" class="searchfield txt-livesearch input" name="s" value="" placeholder="Search here..." type="text">
                                        </div>
                                    </div>
                                    <input name="post_type" value="product" type="hidden">
                                    <input name="taxonomy" value="product_cat" type="hidden">
                                    <div class="category">
                                        <select title="product_cat" name="product_cat" id="1771262470" class="category-search-option" tabindex="-1" style="display: none;">
                                            <option value="0">All Categories</option>
                                            <?php if (isset($data['categories'])) { ?>
                                                <?php foreach ($data['categories'] as $cat) { ?>
                                                    <option class="level-0" value="<?php echo $cat->id ?>"><?php echo $cat->category_name ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn-submit">
                                        <span class="flaticon-search"></span>
                                    </button>
                                </form><!-- block search -->
                            </div>
                        </div>
                    </div>
                    <div class="header-control">
                        <div class="header-control-inner">
                            <div class="meta-dreaming">
                                <div class="menu-item block-user block-dreaming kobolg-dropdown">
                                    <a class="block-link" href="<?php echo URLROOT ?>/index/account">
                                        <span class="flaticon-profile"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="menu-item kobolg-MyAccount-navigation-link kobolg-MyAccount-navigation-link--dashboard is-active">
                                            <?php if (isset($data['isLogged'])) {
                                                if ($data['isLogged']) { ?>
                                                    <a href="<?php echo URLROOT ?>/index/account">My Account</a>
                                                    <a href="<?php echo URLROOT ?>/orders">Orders</a>
                                                    <a href="<?php echo URLROOT ?>/checkOut">CheckOut</a>
                                                    <a href="<?php echo URLROOT ?>/auth/logout">Logout</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo URLROOT ?>/auth/login">Login</a>
                                                    <a href="<?php echo URLROOT ?>/auth/register">Register</a>
                                                <?php }
                                            } else { ?>
                                                <a href="<?php echo URLROOT ?>/auth/login">Login</a>
                                                <a href="<?php echo URLROOT ?>/auth/register">Register</a>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="block-minicart block-dreaming kobolg-mini-cart kobolg-dropdown">
                                    <div class="shopcart-dropdown block-cart-link" data-kobolg="kobolg-dropdown">
                                        <a class="block-link link-dropdown" href="cart.html">
                                            <span class="flaticon-online-shopping-cart"></span>
                                            <span id="countshCard" class="count">0</span>
                                        </a>
                                    </div>
                                    <div class="widget kobolg widget_shopping_cart">
                                        <div class="widget_shopping_cart_content">
                                            <h3 class="minicart-title">Shopping Card<span class="minicart-number-items">0</span>
                                            </h3>
                                            <ul class="kobolg-mini-cart cart_list product_list_widget" id="shop-card-desk">
                                            </ul>
                                            <p class="kobolg-mini-cart__total total"><strong>Subtotal:</strong>
                                                <span class="kobolg-Price-amount amount" id="totalInCard">0</span>
                                            </p>
                                            <p class="kobolg-mini-cart__buttons buttons">
                                                <a href="<?php echo URLROOT ?>/checkOut" style="width: 100%;" class="button checkout kobolg-forward">Checkout</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-wrap-stick">
            <div class="header-position">
                <div class="header-nav">
                    <div class="container">
                        <div class="kobolg-menu-wapper"></div>
                        <div class="header-nav-inner">
                            <div data-items="8" class="vertical-wrapper block-nav-category has-vertical-menu show-button-all">
                                <div class="block-title">
                                    <span class="before">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                    <span class="text-title">SHOP BY CATEGORIES</span>
                                </div>
                                <div class="block-content verticalmenu-content">
                                    <ul id="menu-vertical-menu" class="azeroth-nav vertical-menu default">
                                        <?php if (isset($data['categories'])) { ?>
                                            <?php foreach ($data['categories'] as $cat) { ?>
                                                <li id="<?php echo $cat->id ?></a>" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-886"><a class="azeroth-menu-item-title" title="<?php echo $cat->category_name ?></a>" href="<?php echo URLROOT ?>/index/catagory/<?php echo $cat->category_name ?>"><span></span><?php echo $cat->category_name ?></a></li>
                                        <?php }
                                        } ?>
                                    </ul>
                                    <div class="view-all-category">
                                        <a href="#" data-closetext="Close" data-alltext="All Categories" class="btn-view-all open-cate">All Categories</a>
                                    </div>
                                </div>
                            </div><!-- block category -->
                            <?php if (isset($data["categories"])) { ?>
                                <div class="box-header-nav menu-nocenter">
                                    <ul id="menu-primary-menu" class="clone-main-menu kobolg-clone-mobile-menu kobolg-nav main-menu">
                                        <?php foreach ($data['categories'] as $cat) { ?>
                                            <li id="menu-item-<?php echo $cat->id ?>" class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-228 parent parent-megamenu item-megamenu menu-item-has-children">
                                                <a class="kobolg-menu-item-title" title="Shop" href="<?php echo URLROOT ?>/index/catagory/<?php echo $cat->category_name ?>"><?php echo $cat->category_name ?></a>
                                                <span class="toggle-submenu"></span>
                                                <div class="submenu megamenu megamenu-shop">
                                                    <div class="row">
                                                        <?php foreach ($cat->subcategories as $sc) { ?>
                                                            <div class="col-md-4">
                                                                <div class="kobolg-listitem style-01">
                                                                    <div class="listitem-inner">
                                                                        <a href="<?php echo URLROOT ?>/index/subcatagory/<?php echo $sc->sub_category_name ?>" target="_self">
                                                                            <h4 class="title"><?php echo $sc->sub_category_name ?></h4>
                                                                        </a>
                                                                        <ul class="listitem-list">
                                                                            <?php foreach ($sc->ssCategories as $ssc) { ?>
                                                                                <li>
                                                                                    <a href="<?php echo URLROOT ?>/index/sSCategory/<?php echo $ssc->sub_sub_category_name ?>" target="_self"><?php echo $ssc->sub_sub_category_name ?> </a>
                                                                                </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-mobile">
            <div class="header-mobile-left">
                <div class="block-menu-bar">
                    <a class="menu-bar menu-toggle" href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <div class="header-search kobolg-dropdown">
                    <div class="header-search-inner" data-kobolg="kobolg-dropdown">
                        <a href="#" class="link-dropdown block-link">
                            <span class="flaticon-search"></span>
                        </a>
                    </div>
                    <div class="block-search">
                        <form role="search" method="get" class="form-search block-search-form kobolg-live-search-form">
                            <div class="form-content search-box results-search">
                                <div class="inner">
                                    <input autocomplete="off" class="searchfield txt-livesearch input" name="s" value="" placeholder="Search here..." type="text">
                                </div>
                            </div>
                            <input name="post_type" value="product" type="hidden">
                            <input name="taxonomy" value="product_cat" type="hidden">
                            <div class="category">
                                <select title="product_cat" name="product_cat" id="1770352541" class="category-search-option" tabindex="-1" style="display: none;">
                                    <option value="0">All Categories</option>
                                    <option class="level-0" value="light">Camera</option>
                                    <option class="level-0" value="chair">Accessories</option>
                                    <option class="level-0" value="table">Game & Consoles</option>
                                    <option class="level-0" value="bed">Life style</option>
                                    <option class="level-0" value="new-arrivals">New arrivals</option>
                                    <option class="level-0" value="lamp">Summer Sale</option>
                                    <option class="level-0" value="specials">Specials</option>
                                    <option class="level-0" value="sofas">Featured</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-submit">
                                <span class="flaticon-search"></span>
                            </button>
                        </form><!-- block search -->
                    </div>
                </div>
                <ul class="wpml-menu">
                    <li class="menu-item kobolg-dropdown block-language">
                        <a href="#" data-kobolg="kobolg-dropdown">
                            <img src="assets/images/en.png" alt="en" width="18" height="12">
                            English
                        </a>
                        <span class="toggle-submenu"></span>
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="#">
                                    <img src="assets/images/it.png" alt="it" width="18" height="12">
                                    Italiano
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
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
                    </li>
                </ul>
            </div>
            <div class="header-mobile-mid">
                <div class="header-logo">
                    <a href="index.html"><img alt="Kobolg" src="assets/images/logo.png" class="logo"></a>
                </div>
            </div>
            <div class="header-mobile-right">
                <div class="header-control-inner">
                    <div class="meta-dreaming">
                        <div class="menu-item block-user block-dreaming kobolg-dropdown">
                            <a class="block-link" href="my-account.html">
                                <span class="flaticon-profile"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="menu-item kobolg-MyAccount-navigation-link kobolg-MyAccount-navigation-link--dashboard is-active">
                                    <a href="#">Dashboard</a>
                                </li>
                                <li class="menu-item kobolg-MyAccount-navigation-link kobolg-MyAccount-navigation-link--orders">
                                    <a href="#">Orders</a>
                                </li>
                                <li class="menu-item kobolg-MyAccount-navigation-link kobolg-MyAccount-navigation-link--downloads">
                                    <a href="#">Downloads</a>
                                </li>
                                <li class="menu-item kobolg-MyAccount-navigation-link kobolg-MyAccount-navigation-link--edit-addresses">
                                    <a href="#">Addresses</a>
                                </li>
                                <li class="menu-item kobolg-MyAccount-navigation-link kobolg-MyAccount-navigation-link--edit-account">
                                    <a href="#">Account details</a>
                                </li>
                                <li class="menu-item kobolg-MyAccount-navigation-link kobolg-MyAccount-navigation-link--customer-logout">
                                    <a href="#">Logout</a>
                                </li>
                            </ul>
                        </div>
                        <div class="block-minicart block-dreaming kobolg-mini-cart kobolg-dropdown">
                            <div class="shopcart-dropdown block-cart-link" data-kobolg="kobolg-dropdown">
                                <a class="block-link link-dropdown" href="cart.html">
                                    <span class="flaticon-online-shopping-cart"></span>
                                    <span class="count">3</span>
                                </a>
                            </div>
                            <div class="widget kobolg widget_shopping_cart">
                                <div class="widget_shopping_cart_content">
                                    <h3 class="minicart-title">Shopping Card<span class="minicart-number-items">3</span></h3>
                                    <ul class="kobolg-mini-cart cart_list product_list_widget" id="countshCard">

                                    </ul>
                                    <p class="kobolg-mini-cart__total total"><strong>Subtotal:</strong>
                                        <span class="kobolg-Price-amount amount"><span class="kobolg-Price-currencySymbol">$</span>418.00</span>
                                    </p>
                                    <p class="kobolg-mini-cart__buttons buttons">
                                        <a href="cart.html" class="button kobolg-forward">Viewcart</a>
                                        <a href="<?php echo URLROOT ?>/checkOut" class="button checkout kobolg-forward">Checkout</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Shohibul Qur'an</title>

    <!-- ubah logo atas -->
    <link rel="SHORTCUT ICON" href="<?= base_url() ?>/img/logo2.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/line-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/owl.carousel.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/owl.theme.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/nivo-lightbox.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/animate.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/color-switcher.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/menu_sideslide.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/main.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/responsive.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>

<body>
    <!-- Header Section Start -->
    <header id="slider-area">
        <nav class="navbar navbar-expand-md fixed-top scrolling-navbar bg-white">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url() ?>/">Yayasan Ash-Habul Qur'an</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url() ?>/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url() ?>/#Tentang">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url() ?>/#Galeri">Galeri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url() ?>/#Pendaftaran">Pendaftaran</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url() ?>/#Donasi">Donasi</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url() ?>/#subscribe">Subscribe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url() ?>/#blog">Blog</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="<?= base_url() ?>/#contact">Hubungi kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll " href="<?= base_url() ?>/auth/login" target="_blank">
                                Login
                            </a>
                            <!-- <button type="button" class="nav-link page-scroll btn btn-common btn-effect">
                                <a href="<?= base_url() ?>/auth/login" target="_blank" style="color: white;text-decoration: none;">Login</a>
                            </button> -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Carousel Section -->
        <div id="carousel-area">
            <div>
                <!-- <ol class="carousel-indicators">
                    <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-slider" data-slide-to="1"></li>
                    <li data-target="#carousel-slider" data-slide-to="2"></li>
                </ol> -->
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="img/bg/1.jpg" alt="" style="width:100%">
                        <div class="carousel-caption text-left">
                            <h3 class="wow fadeInRight">Rumah Tahfidz</h1>
                                <h2 class="wow fadeInRight">Shohibul Qur'an</h2>
                                <h2 class="wow fadeInRight">Pandai Sikek</h2>
                                <div><a href="<?= base_url() ?>/#Pendaftaran" class="btn btn-lg btn-common btn-effect wow fadeInRight">Daftar Sekarang</a></diV>
                                <!-- <a href="<?= base_url() ?>/#" class="btn btn-lg btn-border wow fadeInRight" data-wow-delay="1.2s">Get Started!</a> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/slider/bg-3.jpg" alt="">
                        <div class="carousel-caption text-center">
                            <h3 class="wow fadeInDown" data-wow-delay="0.3s">Bundled With Tons of</h3>
                            <h2 class="wow bounceIn" data-wow-delay="0.6s">Cutting-edge Features</h2>
                            <h4 class="wow fadeInUp" data-wow-delay="0.9s">Parallax, Video, Product, Premium Addons and More...</h4>
                            <a href="<?= base_url() ?>/#" class="btn btn-lg btn-common btn-effect wow fadeInUp" data-wow-delay="1.2s">View Works</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/slider/bg-2.jpg" alt="">
                        <div class="carousel-caption text-center">
                            <h3 class="wow fadeInDown" data-wow-delay="0.3s">Ready For</h3>
                            <h2 class="wow fadeInRight" data-wow-delay="0.6s">Multi-purpose Websites</h2>
                            <h4 class="wow fadeInUp" data-wow-delay="0.6s">App, Business, SaaS and Landing Pages</h4>
                            <a href="<?= base_url() ?>/#" class="btn btn-lg btn-border wow fadeInUp" data-wow-delay="0.9s">Purchase</a>
                        </div>
                    </div>
                </div>
                <!-- <a class="carousel-control-prev" href="<?= base_url() ?>/#carousel-slider" role="button" data-slide="prev">
                    <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-left"></i></span>
                    <span class="sr-only">Previous</span>
                </a> -->
                <!-- <a class="carousel-control-next" href="<?= base_url() ?>/#carousel-slider" role="button" data-slide="next">
                    <span class="carousel-control" aria-hidden="true"><i class="lni-chevron-right"></i></span>
                    <span class="sr-only">Next</span>
                </a> -->
            </div>
        </div>

    </header>
    <!-- Header Section End -->

    <!-- Services Section Start -->
    <?= $this->renderSection('content'); ?>

    <!-- Map Section End -->

    <!-- Footer Section Start -->
    <footer>
        <!-- Footer Area Start -->
        <!-- <section class="footer-Content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <h3>Essence</h3>
                        <div class="textwidget">
                            <p>If you think you have the passion,
                                attitude and capability to join us
                                the next big software company
                                s so that we can get the convers.</p>
                        </div>
                        <ul class="footer-social">
                            <li><a class="facebook" href="<?= base_url() ?>/#"><i class="lni-facebook-filled"></i></a></li>
                            <li><a class="twitter" href="<?= base_url() ?>/#"><i class="lni-twitter-filled"></i></a></li>
                            <li><a class="linkedin" href="<?= base_url() ?>/#"><i class="lni-linkedin-fill"></i></a></li>
                            <li><a class="google-plus" href="<?= base_url() ?>/#"><i class="lni-google-plus"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title">Short Link</h3>
                            <ul class="menu">
                                <li><a href="<?= base_url() ?>/#">Service</a></li>
                                <li><a href="<?= base_url() ?>/#">Wishlist</a></li>
                                <li><a href="<?= base_url() ?>/#">FAQ</a></li>
                                <li><a href="<?= base_url() ?>/#">Advance Sarch</a></li>
                                <li><a href="<?= base_url() ?>/#">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title">Contact Us</h3>
                            <ul class="contact-footer">
                                <li>
                                    <strong>Address :</strong> <span>1900 Pico Blvd, New York br Centernial, colorado</span>
                                </li>
                                <li>
                                    <strong>Phone :</strong> <span>+48 123 456 789</span>
                                </li>
                                <li>
                                    <strong>E-mail :</strong> <span><a href="<?= base_url() ?>/#">info@example.com</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title">Instagram</h3>
                            <ul class="instagram-footer">
                                <li><a href="<?= base_url() ?>/#"><img src="<?= base_url() ?>/img/instagram/insta1.jpg" alt=""></a></li>
                                <li><a href="<?= base_url() ?>/#"><img src="<?= base_url() ?>/img/instagram/insta2.jpg" alt=""></a></li>
                                <li><a href="<?= base_url() ?>/#"><img src="<?= base_url() ?>/img/instagram/insta3.jpg" alt=""></a></li>
                                <li><a href="<?= base_url() ?>/#"><img src="<?= base_url() ?>/img/instagram/insta4.jpg" alt=""></a></li>
                                <li><a href="<?= base_url() ?>/#"><img src="<?= base_url() ?>/img/instagram/insta5.jpg" alt=""></a></li>
                                <li><a href="<?= base_url() ?>/#"><img src="<?= base_url() ?>/img/instagram/insta6.jpg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- Footer area End -->

        <!-- Copyright Start  -->
        <div id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="site-info float-left">
                            <p>Crafted by <a href="<?= base_url() ?>/" rel="nofollow">Rumah tahfidz Shohibul Qur'an</a></p>
                        </div>
                        <!-- <div class="float-right">
                            <ul class="nav nav-inline">
                                <li class="nav-item">
                                    <a class="nav-link active" href="<?= base_url() ?>/#">About Prime</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>/#">TOS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>/#">Return Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>/#">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url() ?>/#">Contact</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

    </footer>
    <!-- Footer Section End -->

    <!-- Go To Top Link -->
    <a href="<?= base_url() ?>/#" class="back-to-top">
        <i class="lni-arrow-up"></i>
    </a>

    <div id="loader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="<?= base_url() ?>/js/jquery-min.js"></script>
    <script src="<?= base_url() ?>/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/js/classie.js"></script>
    <script src="<?= base_url() ?>/js/color-switcher.js"></script>
    <script src="<?= base_url() ?>/js/jquery.mixitup.js"></script>
    <script src="<?= base_url() ?>/js/nivo-lightbox.js"></script>
    <script src="<?= base_url() ?>/js/owl.carousel.js"></script>
    <script src="<?= base_url() ?>/js/jquery.stellar.min.js"></script>
    <script src="<?= base_url() ?>/js/jquery.nav.js"></script>
    <script src="<?= base_url() ?>/js/scrolling-nav.js"></script>
    <script src="<?= base_url() ?>/js/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>/js/wow.js"></script>
    <script src="<?= base_url() ?>/js/jquery.vide.js"></script>
    <script src="<?= base_url() ?>/js/jquery.counterup.min.js"></script>
    <script src="<?= base_url() ?>/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>/js/waypoints.min.js"></script>
    <script src="<?= base_url() ?>/js/form-validator.min.js"></script>
    <script src="<?= base_url() ?>/js/contact-form-script.js"></script>
    <script src="<?= base_url() ?>/js/main.js"></script>

</body>

</html>
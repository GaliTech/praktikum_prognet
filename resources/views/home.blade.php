<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Toko Elektronik</title>
    <link rel="icon" href={{asset('template_user/icon/logo_toko.png')}}>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href={{asset('template_user/css/bootstrap.min.css')}}>
    <!-- style css -->
    <link rel="stylesheet" href={{asset('template_user/css/style.css')}}>
    <!-- Responsive-->
    <link rel="stylesheet" href={{asset('template_user/css/responsive.css')}}>
    <!-- fevicon -->
    {{-- <link rel="icon" href="images/fevicon.png" type="image/gif" /> --}}
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href={{asset('template_user/css/jquery.mCustomScrollbar.min.css')}}>
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href={{asset('template_user/css/owl.carousel.min.css')}}>
    <link rel="stylesheet" href={{asset('template_user/css/owl.theme.default.min.css')}}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout ">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src={{asset('template_user/image/loading.gif')}} alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">

            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="/"><img src={{asset('template_user/image/toko_elektronik_logo.png')}} alt="#" width=100px height=70px></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <div class="menu-area">
                            <div class="limit-box">
                                <nav class="main-menu">
                                    <ul class="menu-area-main">
                                        <li class="active"> <a href="/">Home</a> </li>
                                        {{-- <li> <a href="/about">About</a> </li>
                                        <li><a href="/contact_us">Contact Us</a></li> --}}
                                        @php $user = Auth::user() @endphp
                                        @if (isset($user))
                                            <li><a href="{{route('cart')}}">Cart</a></li>
                                            <li>
                                                <div class="dropdown">
                                                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{ Auth::user()->name }}
                                                    </button>
                                                    <div class="dropdown-menu bg-danger" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item p-3" href="{{ route('myorder') }}}}">My Order</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="{{route('user.logout')}}">Logout</a></li>
                                        @else
                                            <li><a href="{{ route('register') }}">Sign Up</a></li>
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        @endif
                                        <li class="last">
                                            <a href="#"><img src={{asset('template_user/image/search_icon.png')}} alt="icon" /></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-6">
                        <div class="location_icon_bottum">
                            <ul>
                                <li><img src={{asset('template_user/icon/call.png')}} />(0361) 123456</li>
                                <li><img src={{asset('template_user/icon/email.png')}} />tokoelektronik@gmail.com</li>
                                <li><img src={{asset('template_user/icon/loc.png')}} />Denpasar</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header inner -->
    </header>
    <!-- end header -->
    <section class="slider_section">
        <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="first-slide" src={{asset('template_user/image/banner.jpg')}} alt="First slide">
                    <div class="container">
                        <div class="carousel-caption relative">
                            <span>All New Phones </span>
                            <h1>up to 25% Flat Sale</h1>
                            <p>It is a long established fact that a reader will be distracted by the readable content
                                <br> of a page when looking at its layout. The point of using Lorem Ipsum is that</p>
                            <a class="buynow" href="#">Buy Now</a>
                            <ul class="social_icon">
                                <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="second-slide" src={{asset('template_user/image/banner1.png')}} alt="Second slide">
                    <div class="container">
                        <div class="carousel-caption relative">
                            <span>All New Phones </span>
                            <h1>up to 50% Flat Sale</h1>
                            <p>It is a long established fact that a reader will be distracted by the readable content
                                <br> of a page when looking at its layout. The point of using Lorem Ipsum is that</p>
                            <a class="buynow" href="#">Buy Now</a>
                            <ul class="social_icon">
                                <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- <div class="carousel-item">
                    <img class="third-slide" src={{asset('template_user/image/banner.jpg')}} alt="Third slide">
                    <div class="container">
                        <div class="carousel-caption relative">
                            <span>All New Phones </span>
                            <h1>up to 25% Flat Sale</h1>
                            <p>It is a long established fact that a reader will be distracted by the readable content
                                <br> of a page when looking at its layout. The point of using Lorem Ipsum is that</p>
                            <a class="buynow" href="#">Buy Now</a>
                            <ul class="social_icon">
                                <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <i class='fa fa-angle-left'></i>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <i class='fa fa-angle-right'></i>
            </a>
        </div>
    </section>

    <!-- about -->
    <div class="about">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 co-sm-l2">
                    <div class="about_img">
                        <figure><img src={{asset('template_user/image/about.png')}} alt="img" /></figure>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 co-sm-l2">
                    <div class="about_box">
                        <h3>About Us</h3>
                        <span>Our Electronic Shop</span>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of It is a long established fact that a reader will be distracted by the </p>

                    </div>
               
            </div>
        </div>
    </div>
    </div>
    <!-- end about -->

    <!-- brand -->
    <div class="brand">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Products</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="brand-bg">
            <div class="container">
                <div class="row">
                    @foreach ($products_data as $item)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 margin">
                        <div class="brand_box">
                            @php
                                $images = DB::table('product_images')->where('product_id','=',$item->id)->get();
                            @endphp
                                <img src="{{asset('image/'.$images[0]->image_name)}}" alt="">
                            <h3><strong class="red">Rp{{number_format($item->price)}}</strong></h3>
                            <h1><a href="/detail_produk/{{$item->id}}">{{$item->product_name}}</a></h1>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 margin">
                        <div class="brand_box">
                            <img src={{asset('template_user/image/1.png')}} alt="img" />
                            <h3>$<strong class="red">100</strong></h3>
                            <span>Mobile Phone</span>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 margin">
                        <div class="brand_box">
                            <img src={{asset('template_user/image/2.png')}} alt="img" />
                            <h3>$<strong class="red">100</strong></h3>
                            <span>Mobile Phone</span>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 margin">
                        <div class="brand_box">
                            <img src={{asset('template_user/image/3.png')}} alt="img" />
                            <h3>$<strong class="red">100</strong></h3>
                            <span>Mobile Phone</span>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                        <div class="brand_box">
                            <img src={{asset('template_user/image/4.png')}} alt="img" />
                            <h3>$<strong class="red">100</strong></h3>
                            <span>Mobile Phone</span>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mrgn">
                        <div class="brand_box">
                            <img src={{asset('template_user/image/5.png')}} alt="img" />
                            <h3>$<strong class="red">100</strong></h3>
                            <span>Mobile Phone</span>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 mrgn">
                        <div class="brand_box">
                            <img src={{asset('template_user/image/6.png')}} alt="img" />
                            <h3>$<strong class="red">100</strong></h3>
                            <span>Mobile Phone</span>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                            <i><img src={{asset('template_user/image/star.png')}}/></i>
                        </div>
                    </div> --}}
                    <div class="col-md-12">
                        <a class="read-more" href="#">See More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end brand -->
    <!-- clients -->
    <div class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Customer's Review</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clients_red">
        <div class="container">
            <div id="testimonial_slider" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#testimonial_slider" data-slide-to="0" class=""></li>
                    <li data-target="#testimonial_slider" data-slide-to="1" class="active"></li>
                    <li data-target="#testimonial_slider" data-slide-to="2" class=""></li>
                </ul>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <div class="testomonial_section">
                            <div class="full center">
                            </div>
                            <div class="full testimonial_cont text_align_center cross_layout">
                                <div class="cross_inner">
                                    <h3>Due markes<br><strong class="ornage_color">Rental</strong></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit ess</i>
                                    </p>
                                    <div class="full text_align_center margin_top_30">
                                        <img src={{asset('template_user/icon/testimonial_qoute.png')}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item active">

                        <div class="testomonial_section">
                            <div class="full center">
                            </div>
                            <div class="full testimonial_cont text_align_center cross_layout">
                                <div class="cross_inner">
                                    <h3>Due markes<br><strong class="ornage_color">Rental</strong></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit ess</i>
                                    </p>
                                    <div class="full text_align_center margin_top_30">
                                        <img src={{asset('template_user/icon/testimonial_qoute.png')}}>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="carousel-item">

                        <div class="testomonial_section">
                            <div class="full center">
                            </div>
                            <div class="full testimonial_cont text_align_center cross_layout">
                                <div class="cross_inner">
                                    <h3>Due markes<br><strong class="ornage_color">Rental</strong></h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit ess</i>
                                    </p>
                                    <div class="full text_align_center margin_top_30">
                                        <img src={{asset('template_user/icon/testimonial_qoute.png')}}>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!-- end clients -->
    <!-- contact -->
    {{-- <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Contact Us</h2>
                    </div>
                    <form class="main_form">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <input class="form-control" placeholder="Your name" type="text" name="Your Name">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <input class="form-control" placeholder="Email" type="text" name="Email">
                            </div>
                            <div class=" col-md-12">
                                <input class="form-control" placeholder="Phone" type="text" name="Phone">
                            </div>
                            <div class="col-md-12">
                                <textarea class="textarea" placeholder="Message"></textarea>
                            </div>
                            <div class=" col-md-12">
                                <button class="send">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- end contact -->

    <!-- footer -->
    <footer>
        <div id="contact" class="footer">
            <div class="container">
                <div class="row pdn-top-30">
                    <div class="col-md-12 ">
                        <div class="footer-box">
                            <div class="headinga">
                                <h3>Address</h3>
                                <span>Denpasar, Bali, Indonesia</span>
                                <p>(0361) 123456
                                    <br>tokoelektronik@gmail.com</p>
                            </div>
                            <ul class="location_icon">
                                <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li> <a href="#"><i class="fa fa-instagram"></i></a></li>

                            </ul>
                            {{-- <div class="menu-bottom">
                                <ul class="link">
                                    <li> <a href="#">Home</a></li>
                                    <li> <a href="#">About</a></li>
                                    
                                    <li> <a href="#">Brand </a></li>
                                    <li> <a href="#">Specials  </a></li>
                                    <li> <a href="#"> Contact us</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <p>© 2021 - Toko Elektronik. Design By<a href="https://html.design/"> Free Html Templates</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src={{asset('template_user/js/jquery.min.js')}}></script>
    <script src={{asset('template_user/js/popper.min.js')}}></script>
    <script src={{asset('template_user/js/bootstrap.bundle.min.js')}}></script>
    <script src={{asset('template_user/js/jquery-3.0.0.min.js')}}></script>
    <script src={{asset('template_user/js/plugin.js')}}></script>
    <!-- sidebar -->
    <script src={{asset('template_user/js/jquery.mCustomScrollbar.concat.min.js')}}></script>
    <script src={{asset('template_user/js/custom.js')}}></script>
    <!-- javascript -->
    <script src={{asset('template_user/js/owl.carousel.js')}}></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });
        });
    </script>
</body>

</html>
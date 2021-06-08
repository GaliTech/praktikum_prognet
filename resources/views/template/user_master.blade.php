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
    <link href={{asset('template/vendor/fontawesome-free/css/all.min.css')}} rel="stylesheet" type="text/css">
    @yield('css')
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
                                        <li class="active"> <a href="/user">Home</a> </li>
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
                                                        <a class="dropdown-item p-3" href="{{ route('myorder') }}">My Order</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="{{route('user.logout')}}">Logout</a></li>
                                        @else
                                            <li><a href="{{ route('register') }}">Sign Up</a></li>
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        @endif
                                        <!-- Nav Item - Messages -->
                                        <li class="nav-item dropdown no-arrow mx-1">
                                            @php $unread = \App\Models\UserNotifications::where('notifiable_id', Auth::user()->id)->where('read_at', NULL)->orderBy('created_at','desc')->count(); @endphp
                                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-envelope fa-fw"></i>
                                                <!-- Counter - Messages -->
                                                <span class="badge badge-danger badge-counter">@php echo $unread @endphp+</span>
                                            </a>
                                            <!-- Dropdown - Messages -->
                                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                                aria-labelledby="messagesDropdown">
                                                <h6 class="dropdown-header">
                                                    Notification Center
                                                </h6>
                                                @php $user_notifikasi = \App\Models\UserNotifications::where('notifiable_id', Auth::user()->id)->where('read_at', NULL)->orderBy('created_at','desc')->get(); @endphp
                                                @forelse ($user_notifikasi as $notifikasi)
                                                    @php $notif = json_decode($notifikasi->data); @endphp
                                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('user.notification', $notifikasi->id) }}">
                                                        <div class="dropdown-list-image mr-3">
                                                            <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="">
                                                            <div class="status-indicator bg-success"></div>
                                                        </div>
                                                        <div class="font-weight-bold">
                                                            <div class="text-truncate text-dark">{{ $notif->message }}</div>
                                                            <div class="small text-secondary">{{ $notif->nama }}</div>
                                                        </div>
                                                    </a>
                                                @empty
                                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                                        <div class="font-weight-bold">
                                                            <div class="small text-secondary">Tidak Ada Notifikasi</div>
                                                        </div>
                                                    </a>
                                                @endforelse
                                            </div>
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
    @yield('content')
    <!-- end header -->


    <!-- about -->

    <!-- end about -->

    <!-- brand -->

    <!-- end brand -->

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
    @yield('javascript')
</body>

</html>
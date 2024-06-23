<div class="header">
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-xl-3 col-lg-3 d-xl-flex d-lg-flex d-block align-items-center">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-6 d-xl-block d-lg-block d-flex align-items-center">
                        <div class="logo">
                            <a href='{{ url('/') }}'>
                                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-6 d-xl-none d-lg-none d-flex justify-content-end">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa-solid fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="main-menu">
                    <nav class="navbar navbar-expand-lg">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a class='nav-link active' href='{{ url('/') }}'>Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class='nav-link' href='{{ route('landing.about-us') }}'>About us</a>
                                </li>
                                 <li class="nav-item">
                                    <a class='nav-link' href='{{ route('landing.lottery') }}'>Lotteries</a>
                                </li> 
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pages
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class='dropdown-item' href='sign-in.html'>Sign In</a></li>
                                        <li><a class='dropdown-item' href='register.html'>Register / Sign up</a></li>
                                        <li><a class='dropdown-item' href='faq.html'>Ques. & Ans.</a></li>
                                        <li><a class='dropdown-item' href='blog-posts.html'>Blog Posts</a></li>
                                        <li><a class='dropdown-item' href='blog-details.html'>Blog Details</a></li>
                                        <li><a class='dropdown-item' href='error.html'>Error 404</a></li>
                                    </ul>
                                </li> --}}
                                 <li class="nav-item">
                                    <a class='nav-link' href='#'>How to play</a>
                                </li>
                                <li class="nav-item">
                                    <a class='nav-link' href='{{ route('landing.contact-us') }}'>Contact</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class='nav-link' id="open-cart-btn" type="button">Cart</a>
                                </li> --}}
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            @if(Auth::check()) 
            <div class="col-xl-3 col-lg-3 d-xl-flex d-lg-flex d-none align-items-center justify-content-end">
            <a class="btn-pok mid" href="{{ route('user.dashboard') }}">
                {{-- Welcome, {{ Auth::user()->name }} --}}My Account
            </a>
            <a class="btn-pok mid ms-3" id="open-cart-btn">
                    <i class="fa fa-cart-shopping"></i>
                </a>
            
            </div>
            
            @else

            <div class="col-xl-3 col-lg-3 d-xl-flex d-lg-flex d-none align-items-center justify-content-end">
                <a class='btn-pok mid' href='{{ route('auth.login') }}'>Login <i class="fa-solid fa-angle-right"></i>
                </a>
                <a class="btn-pok mid ms-3" id="open-cart-btn">
                    <i class="fa fa-cart-shopping"></i>
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
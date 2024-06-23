<div class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 col-sm-9">
                    <div class="part-about">
                        <div class="footer-logo">
                            <a href='{{ url('/') }}'>
                                <img src="{{ asset('assets/img/logo.png') }}" alt="" class="logo">
                            </a>
                        </div>
                        <p>Lottery players can play Virginia Lottery games online from anywhere in Virginia on a phone, tablet or computer. </p>
                        <ul class="importants-links">
                            <li class="single-link">
                                <a href="#0">policy</a>
                            </li>
                            <li class="single-link">
                                <a href="#0">Terms</a>
                            </li>
                            <li class="single-link">
                                <a href="#0">license</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p class="copyright-text">copyright © 2022. all right reserved by PokLotto</p>
                <ul class="social-link">
                    <li class="single-social">
                        <a href="#0">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="single-social">
                        <a href="#0">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                    <li class="single-social">
                        <a href="#0">
                            <i class="fa-brands fa-pinterest-p"></i>
                        </a>
                    </li>
                </ul>
                <div class="footer-menu">
                    <ul>
                        <li>
                            <a class='single-menu' href='index.html'>homepage</a>
                        </li>
                        <li>
                            <a class='single-menu' href='about.html'>About Us</a>
                        </li>
                        <li>
                            <a class='single-menu' href='lotteries.html'>Lotteries</a>
                        </li>
                        <li>
                            <a class='single-menu' href='blog-posts.html'>Blog</a>
                        </li>
                        <li>
                            <a class='single-menu' href='contact.html'>contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="back-to-top-btn">
    <a href="#">
        <i class="fa-solid fa-arrow-turn-up"></i>
    </a>
</div>

<!-- jQuery js -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- owl carousel js -->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<!-- main js -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- lottery js initialize -->
<script src="{{ asset('assets/js/lotteries-initialization.js') }}"></script>

 <!-- Scripts -->
 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

 <!-- Laravel Javascript Validation -->
 <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
            const openCartBtn = document.getElementById('open-cart-btn');
            const closeCartBtn = document.getElementById('close-cart-btn');
            const cartOverlay = document.querySelector('.cart-overlay');
            const addToCart  = document.getElementById('continueToCart');

            openCartBtn.addEventListener('click', function() {
                cartOverlay.classList.add('active');
            });

            closeCartBtn.addEventListener('click', function() {
                cartOverlay.classList.remove('active');
            });
        });

</script>
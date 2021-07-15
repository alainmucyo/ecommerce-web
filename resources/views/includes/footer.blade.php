@include("includes.cart_modal")
<!-- section start -->

<div class="footer-area">
    <div class="footer-container">
        <div class="footer-top">
            <div class="mx-5">
                <div class="row">
                    <div class="col-md-6 col-lg-4 mb-md-30px mb-lm-30px">
                        <div class="single-wedge">
                            <h4 class="footer-herading">ABOUT US</h4>
                            <p class="text-infor">We are a team of designers and developers that create high quality
                                HTML template</p>
                            <div class="need-help">
                                <p class="phone-info">
                                    NEED HELP?
                                    <span>
                                        0123456789 <br/>
                                        0123456789
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 mb-md-30px mb-lm-30px">
                        <div class="single-wedge">
                            <h4 class="footer-herading">Information</h4>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Secure Payment</a></li>
                                    <li><a href="/contact-us">Contact Us</a></li>
                                    <li><a href="#">Sitemap</a></li>
                                    <li><a href="#">Stores</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-2 mb-sm-30px mb-lm-30px">
                        <div class="single-wedge">
                            <h4 class="footer-herading">CUSTOM LINKS</h4>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="#">Legal Notice</a></li>
                                    <li><a href="#">Prices Drop</a></li>
                                    <li><a href="#">New Products</a></li>
                                    <li><a href="#">Best Sales</a></li>
                                    <li><a href="#">Login</a></li>
                                    <li><a href="#">My Account</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 ">
                        <div class="single-wedge">
                            <h4 class="footer-herading">NEWSLETTER</h4>
                            <div class="subscrib-text">
                                <p>You may unsubscribe at any moment. For that purpose, please find our contact info
                                    in the legal notice.</p>
                            </div>
                            <div id="mc_embed_signup" class="subscribe-form">
                                <form
                                    id="mc-embedded-subscribe-form"
                                    class="validate"
                                    novalidate=""
                                    target="_blank"
                                    name="mc-embedded-subscribe-form"
                                    method="post"
                                    action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
                                >
                                    <div id="mc_embed_signup_scroll" class="mc-form">
                                        <input class="email" type="email" required=""
                                               placeholder="Enter your email here.." name="EMAIL" value=""/>
                                        <div class="mc-news" aria-hidden="true"
                                             style="position: absolute; left: -5000px;">
                                            <input type="text" value="" tabindex="-1"
                                                   name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef"/>
                                        </div>
                                        <div class="clear">
                                            <input id="mc-embedded-subscribe" class="button" type="submit"
                                                   name="subscribe" value="Sign Up"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="social-info">
                                <ul>
                                    <li>
                                        <a href="#"><i class="icon-social-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-social-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-social-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-social-google"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-social-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                        <p class="copy-text"> © 2021 <strong>David's High Deals</strong></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <img class="payment-img" src="assets/images/icons/payment.png" alt=""/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myAccount" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeAccount()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my account</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeAccount()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        @guest
            <form class="theme-form" method="post" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                           id="email"
                           placeholder="Email" value="{{ old('email') }}" required="">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="review">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           id="review"
                           placeholder="Enter your password" required="">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-solid btn-solid-sm btn-block ">Login</button>
                @if (Route::has('password.request'))
                    <h5 class="forget-class"><a href="{{ route('password.request') }}" class="d-block">forget
                            password?</a>
                    </h5>
                @endif
                <h5 class="forget-class"><a href="/register" class="d-block">new to store? Signup now</a></h5>
            </form>
        @else

            <button class="btn btn-solid btn-solid-sm btn-block " onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout
            </button>
            <a href="/customer/profile" class="btn btn-solid btn-solid-sm btn-block ">Change Profile</a>
        @endguest
    </div>
</div>

<!-- tap to top -->
<div class="tap-top">
    <div>
        <i class="fa fa-angle-double-up"></i>
    </div>
</div>
<!-- tap to top End -->

<!-- latest jquery-->
<script src="/commerce/assets/js/jquery-3.3.1.min.js"></script>

<!-- menu js-->
<script src="/commerce/assets/js/menu.js"></script>

<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>
<!-- popper js-->
<script src="/commerce/assets/js/popper.min.js"></script>

<!-- slick js-->
<script src="/commerce/assets/js/slick.js"></script>
<!-- Bootstrap js-->
<script src="/commerce/assets/js/bootstrap.js"></script>
<!-- Bootstrap Notification js-->
<script src="/commerce/assets/js/bootstrap-notify.min.js"></script>
@stack("scripts")
<!-- Theme js-->
<script src="assets/js/main.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="/commerce/assets/js/script.js"></script>
@if(strtolower(Route::currentRouteName())=='welcome')
<script type="text/javascript" src="/js/new_app.js"></script>
@endif
@include("components.toast")
@error("email")
@if(strtolower(Route::currentRouteName())!='register' && strtolower(Route::currentRouteName()) !='login')
    <script>
        openAccount()
    </script>
@endif
@enderror

<!-- modal js-->
<script src="/commerce/assets/js/modal.js"></script>

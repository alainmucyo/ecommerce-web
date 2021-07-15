@extends("layouts.master")
@section("title","Contact-Us")
@section("content")
    <div class="section">
        <div class="offcanvas-overlay"></div>
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-content">
                            <ul class="nav">
                                <li><a href="/">Home</a></li>
                                <li>Contact Us</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-area mtb-60px">
            <div class="mx-5" id="viewMap">
                <div class="contact-map mb-10">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.4330153613714!2d30.10222521475495!3d-1.9813201985555604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca6310387fca3%3A0xc1909c781d84b271!2sKicukiro%20Market%2C%20KK%2015%20Rd%2C%20Kigali!5e0!3m2!1sen!2srw!4v1625651614506!5m2!1sen!2srw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="w-100"></iframe>
                </div>
                <div class="custom-row-2">
                    <div class="col-lg-4 col-md-5 mb-lm-30px">
                        <div class="contact-info-wrap">
                            <div class="single-contact-info">
                                <div class="contact-icon">
                                    <i class="ion-android-call"></i>
                                </div>
                                <div class="contact-info-dec">
                                    <p><a href="tel://0788xxxxxx">0788xxxxxx</a></p>
                                    <p><a href="tel://0788xxxxxx">0788xxxxxx</a></p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-icon">
                                    <i class="ion-android-globe"></i>
                                </div>
                                <div class="contact-info-dec">
                                    <p><a href="mailto://urname@email.com">highdeal@gmail.com</a></p>
                                    <p><a href="mailto://urwebsitenaem.com">highdeal@info.com</a></p>
                                </div>
                            </div>
                            <div class="single-contact-info">
                                <div class="contact-icon">
                                    <i class="ion-android-pin"></i>
                                </div>
                                <div class="contact-info-dec">
                                    <p>Kicukiro Centre,</p>
                                    <p>Kicukiro Centre,</p>
                                </div>
                            </div>
                            <div class="contact-social">
                                <h3>Follow Us</h3>
                                <div class="social-info">
                                    <ul>
                                        <li>
                                            <a href="#"><i class="ion-social-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ion-social-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ion-social-youtube"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ion-social-google"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ion-social-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="contact-form">
                            <div class="contact-title mb-30">
                                <h2>Get In Touch</h2>
                            </div>
                            <form class="contact-form-style" id="contact-form"
                                  action="https://htmldemo.hasthemes.com/rozer/rozer/assets/php/mail.php" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input name="name" placeholder="Name*" type="text"/>
                                    </div>
                                    <div class="col-lg-6">
                                        <input name="email" placeholder="Email*" type="email"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input name="subject" placeholder="Subject*" type="text"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea name="message" placeholder="Your Message*"></textarea>
                                        <button class="submit" type="submit">SEND</button>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

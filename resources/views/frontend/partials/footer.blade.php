<section class="footer-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="footer-abt">
                    <h5 class="footer-abt-h5">Real Estate Story</h5> 
                    <div class="footer-abt-p">
                        {!! $setting->description !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="footer-abt">
                    <h5 class="footer-abt-h5">Contact Us</h5>
                    <ul class="footer-contact-info">
                        <li>
                            <i class="far fa-envelope"></i><a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i><a href="tel:{{$setting->phone}}">{{$setting->phone}}</a>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>{{$setting->address}}
                        </li>
                    </ul>
                    <ul class="footer-social-list clear">
                        <li><a href="{{$setting->facebook}}" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{$setting->twitter}}" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{$setting->linkedin}}" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-sm-6">
                <div class="footer-abt">
                    <h5 class="footer-abt-h5">Quick Links</h5>
                    <ul class="footer-quick-link-ul">
                        <li><a href="{{route('fe.about')}}" target="_blank"><i class="fas fa-chevron-right"></i>About Us</a></li>
                        <li><a href="{{route('fe.contact')}}"><i class="fas fa-chevron-right"></i>Contact Us</a></li>
                        <li><a href="{{route('fe.blogs')}}"><i class="fas fa-chevron-right"></i>Blog</a></li>
                        <li><a href="{{route('fe.properties')}}"><i class="fas fa-chevron-right"></i>Properties</a></li>
                        <li><a href="{{route('fe.conditions')}}"><i class="fas fa-chevron-right"></i>Terms & Conditions</a></li>
                        <li><a href="{{route('fe.policy')}}"><i class="fas fa-chevron-right"></i>Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="footer-abt popular-posts">
                    <h5 class="footer-abt-h5">Our Location</h5>

                    {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1766.511429358472!2d85.33352855792481!3d27.685688370824085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19e21b62dc9b%3A0x90b4ce7f6bd8a20b!2sHeaven+Maker+Group%2C+kathmandu+Office!5e0!3m2!1sen!2snp!4v1562329103393!5m2!1sen!2snp" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>--}}

                    {!! $setting->map_location!!}
                </div>
            </div>

        </div>
    </div>
</section>

<section class="copyright-section">
    <div class="container">
        <div class="row copyright-row">
            <div class="col-lg-4">
                <p class="copy-right">{{$setting->copyright_text}} </p>
            </div>
            <div class="col-lg-2 mbl-download-div">
                <a href="https://play.google.com/store/apps/details?id=com.omlot.omlotestate&hl=en" class="footer-app-dowload">
                    <figure>
                        <img src="{{asset('frontend/img/android.png')}}" class="img-fluid" alt="">
                    </figure>
                </a>
            </div>
            <div class="col-lg-2 mbl-download-div"> 
                <a href="https://play.google.com/store/apps/details?id=com.omlot.omlotestate&hl=en" class="footer-app-dowload">
                    <figure>
                        <img src="{{asset('frontend/img/ios.png')}}" class="img-fluid" alt="">
                    </figure>
                </a> 
            </div>
            <div class="col-lg-4">
                <p class="design-develop">Designed & Developed by: <a href="https://omlot.com">Heaven Maker Pvt. Ltd</a></p>
            </div>
        </div>
    </div>
</section>
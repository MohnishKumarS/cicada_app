<!-- ccd footer -->
<footer class="ccd-footer">
        <div class="">
            <div class="footer-base">
                <div class="footer-block">
                    <div class="container page--width">
                        <div class="row mx-0">
                            <div class="col-lg-6 col-12 ps-4 ps-sm-0">
                                <h2 class="text-center text-white logo--head">
                                    {{-- <img src="{{asset('images/logo.avif')}}" alt="cicada-logo"> --}}
                                    CICADA
                                </h2>
                                <ul class="footer-block_content">
                                    <p>"cicada" is a streetwear-based fashion house, born from bold creativity and a
                                        passion for pushing limits. We are rewriting the rules of streetwear. Embrace
                                        the fusion of construction, artistry, and fearless attitude in every stitch.</p>
                                </ul>
                            </div>
                            <div class="col-6  col-lg-3 ps-4 ps-sm-0 mt-3 mt-sm-0 ps-lg-4">
                                <h2 class="footer-block_head">Quick links</h2>
                                <ul class="footer-block_content">
                                    <li><a href="{{ route('homePage') }}" class="link link--hover">Home</a></li>
                                    <li><a href="{{ route('collections') }}" class="link link--hover">Collections</a></li>
                                    <li><a href="{{ route('contactus') }}" class="link link--hover">Conatct Us</a></li>
                                    <li><a href="{{ route('account') }}" class="link link--hover">My Account</a></li>
                                    @guest
                                    <li><a href="{{ route('login') }}" class="link link--hover">Login</a></li>
                                    @endguest
                                </ul>
                            </div>
                            <div class="col-6  col-lg-3 ps-4 ps-sm-0 mt-3 mt-sm-0 ">
                                <h2 class="footer-block_head">More Info</h2>
                                <ul class="footer-block_content">
                                    <li><a href="mailto:cicadapeoplesneed@gmail.com" class="link link--hover text-break">cicadapeoplesneed@gmail.com</a></li>
                                    <li><a href="tel:91+6384044807" class="link link--hover">91+ 6384044807</a></li>
                                    <li><a href="{{route('policy.privacy')}}" class="link link--hover">Privacy Policy</a></li>
                                    <li><a href="{{route('policy.shipping')}}" class="link link--hover">Shipping & return Policy</a></li>
                                    <li><a href="{{route('policy.terms')}}" class="link link--hover">Terms & conditions</a></li>
                                    <li>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p class="footer-bootom_cr mb-0">© 2025, thestorecicada. All right reserved</p>
                </div>
            </div>
        </div>
    </footer>
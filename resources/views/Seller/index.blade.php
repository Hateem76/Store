@extends('Seller.layouts.app')
@section('content')
<!----Card Section-->
<div class="card-container">
    <div class="row sub-container">
        <a href="{{ route('seller.products.index') }}" id="products" style="display: none;"></a>
        <div class="card" onclick="document.getElementById('products').click();">
            <h1 class="text-center">25</h1>
            <h4 class="text-center">Products</h4>
            <i class="fas fa-truck-loading mt-2 text-center"></i>
        </div>
        <a href="{{ route('seller.users.index') }}" id="users" style="display: none;"></a>
        <div class="card" onclick="document.getElementById('users').click();">
            <h1 class="text-center">15</h1>
            <h4 class="text-center">Users</h4>
            <i class="fa fa-users mt-2 text-center"></i>
        </div>
        <a href="{{ route('profile.myContacts') }}" id="contacts" style="display: none;"></a>
        <div class="card" onclick="document.getElementById('contacts').click();">
            <h1 class="text-center">4</h1>
            <h4 class="text-center">My Contacts</h4>
            <i class="fas fa-tasks mt-2 text-center"></i>
        </div>
    </div>
</div>
<div class="card-container" style="margin-top: -10px;">
    <div class="row sub-container">
        <a href="{{ route('seller.tenders') }}" id="tenders" style="display: none;"></a>
        <div class="card" onclick="document.getElementById('tenders').click();">
            <h1 class="text-center">10</h1>
            <h4 class="text-center">Tenders</h4>
            <i class="fa fa-comments-dollar mt-2 text-center"></i>
        </div>
        <div class="card">
            <h1 class="text-center">15</h1>
            <h4 class="text-center">Deals</h4>
            <i class="fa fa-dollar mt-2 text-center"></i>
        </div>
        <div class="card">
            <h1 class="text-center">4</h1>
            <h4 class="text-center">Your projects</h4>
            <i class="fa fa-user mt-2 text-center"></i>
        </div>
    </div>
</div>
<!------End of Card Section-->


 <!-- Footer Section Start -->
 <footer>
    <!-- Footer Area Start -->
    <section class="footer-Content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <h3 class="text-white">ABOUT US</h3>
                    <div class="textwidget">
                        <p style="color:#eaeaea;">If you think you have the passion,
                            attitude and capability to join us
                            the next big software company
                            s so that we can get the convers.</p>
                    </div>
                    <ul class="footer-social">
                        <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                        <li><a class="instagram" href="#"><i class="lni-instagram-filled"></i></a></li>
                        <li><a style="background-color: #DF2926;" href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="block-title text-bold text-white">Short Link</h3>
                        <ul class="menu">
                            <li><a id="#services" style="color:#eaeaea;">Service</a></li>
                            <li><a id="#about" style="color:#eaeaea;">About</a></li>
                            <li><a href="#" style="color:#eaeaea;">FAQ</a></li>
                            <li><a id="#contact" style="color:#eaeaea;">Contact</a></li>
                            <li><a href="#" style="color:#eaeaea;">Site Map</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="block-title text-bold text-white">Contact Us</h3>
                        <ul class="contact-footer">
                            <li style="color:#eaeaea;">
                                <strong>Address :</strong> <span>Bahria Town Lahore,Punjab,Pakistan-54000</span>
                            </li>
                            <li style="color:#eaeaea;">
                                <strong>Phone :</strong> <span>+923070517777</span>
                            </li>
                            <li>
                                <strong style="color:#eaeaea;">E-mail :</strong> <span><a href="#"
                                        style="color:#eaeaea;">altafcateringcompany@gmail.com</a></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                    <div class="widget">
                        <h3 class="block-title text-bold text-white ml-3">Facebook</h3>
                        <ul class="instagram-footer ml-3">
                          <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                            src="{{ asset('images/instagram/inst2.png') }}" alt=""></a></li>
                          <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                src="{{ asset('images/instagram/inst3.png') }}" alt=""></a></li>
                          <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                src="{{ asset('images/instagram/inst4.png') }}" alt=""></a></li>
                          <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                src="{{ asset('images/instagram/inst5.png') }}" alt=""></a></li>
                          <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                src="{{ asset('images/instagram/inst6.png') }}" alt=""></a></li>
                            <!-- <li><a href="#"><img src="img/instagram/" alt=""></a></li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer area End -->
  
    <!-- Copyright Start  -->
    <div id="copyright" style="background-color: #000;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="site-info">
                        <p class="text-center text-white">&copy; Copyright Dubai Waro
                            <span class="text-white" id="copyright-year"> </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->
  
    <script>
        const year = new Date().getFullYear();
        console.log(year);
        var copyrightYear = document.getElementById('copyright-year');
        copyrightYear.innerHTML = " " + year;
    </script>
  
  </footer>
  <!-- Footer Section End -->
         

@endsection
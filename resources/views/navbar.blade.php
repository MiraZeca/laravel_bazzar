

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Vegefoods</a>
        <button class="navbar-toggler btnhover" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button> 

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('index') }}" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Shop</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Shop</a>
                        <a class="dropdown-item" href="#">Wishlist</a>
                        <a class="dropdown-item" href="#">Single Product</a>
                        <a class="dropdown-item" href="#">Cart</a>
                        <a class="dropdown-item" href="#">Checkout</a>
                    </div>
                </li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{ route('exchange') }}" class="nav-link">Exchange</a></li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                <li class="nav-item cta cta-colored"><a href="#" class="nav-link"><span
                            class="icon-shopping_cart ">[0]</span></a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                <li class="nav-item"><a href="https://mirazeca.com" class="nav-link">Back to CV</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->
<section class="ftco-section ftco-counter ftco" id="section-counter">
    <div class="container-fluid bg-primary">
        <div class="row justify-content-center py-5">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="10000">0</strong>
                                <i class="fa-solid fa-child-reaching fa-xl"></i>
                                <span>Happy Customers</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center ">
                            <div class="text">
                                <strong class="number" data-number="100">0</strong>
                                <i class="fa-solid fa-timeline fa-xl"></i>
                                <span>Branches</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="1000">0</strong>
                                <i class="fa-solid fa-people-group fa-xl"></i>
                                <span>Partners</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="100">0</strong>
                                <i class="fa-solid fa-award fa-xl"></i>
                                <span>Awards</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


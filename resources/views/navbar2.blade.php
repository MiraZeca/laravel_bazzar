<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Vegefoods</a>
        <div class="navbar-user ml-auto">
            <p class="mt-3">
                @if (Auth::user()->is_admin)
                    <img src="{{ asset('images/default_user1.png') }}" alt="Admin Profile" class="rounded-circle"
                        style="width: 40px; height: 40px; object-fit: cover;">
                @else
                    <img src="{{ asset('storage/' . Auth::user()->profile_image ?? 'images/default_user1.png') }}"
                        alt="User Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                @endif
            </p>

        </div>
        <button class="navbar-toggler btnhover" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('index') }}" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Community</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a href="{{ route('index') }}"  class="dropdown-item">Blog</a>
                        <a href="{{ route('about') }}" class="dropdown-item">About</a>
                        <a class="dropdown-item" href="#">Single Product</a>
                        <a href="{{ route('exchange') }}" class="dropdown-item">Exchange</a>
                    </div>
                </li>
                <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="{{ route('index') }}" class="nav-link">Logout</a></li>
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

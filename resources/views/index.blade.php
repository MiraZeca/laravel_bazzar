@section('title')
    Home
@endsection

@extends('home')

@section('main')
    <section class="ftco-section">
        <div class="container">
            <div class="row no-gutters ftco-services">
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-shipped"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Free Shipping</h3>
                            <span>On order over $100</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-diet"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Always Fresh</h3>
                            <span>Product well package</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-award"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Superior Quality</h3>
                            <span>Quality Products</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services mb-md-0 mb-4">
                        <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                            <span class="flaticon-customer-service"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Support</h3>
                            <span>24/7 Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-category ftco-no-pt">
        <div class="container">
            <div class="row justify-content-evenly">
                <div class="col-md-4">
                    <div class="scratch-container">
                        <canvas id="scratchCanvas1"></canvas>
                        <img src="images/category-2.jpg" alt="Hidden Image" class="hidden-image">
                        <a href="{{ route('about', 'Fruits') }}" class="hidden-link1">
                            <h2 class="hidden-text">Fruits</h2>
                        </a>
                    </div>
                    <div class="scratch-container">
                        <canvas id="scratchCanvas2"></canvas>
                        <img src="images/category-1.jpg" alt="Hidden Image" class="hidden-image">
                        <a href="{{ route('about', 'Vegetables') }}" class="hidden-link2">
                            <h2 class="hidden-text">Vegetables</h2>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="scratch-container">
                        <canvas id="scratchCanvas3"></canvas>
                        <img src="images/category-3.jpg" alt="Hidden Image" class="hidden-image">
                        <a href="{{ route('about', 'Juices') }}" class="hidden-link3">
                            <h2 class="hidden-text">Juices</h2>
                        </a>
                    </div>
                    <div class="scratch-container">
                        <canvas id="scratchCanvas4"></canvas>
                        <img src="images/category-4.jpg" alt="Hidden Image" class="hidden-image">
                        <a href="{{ route('about', 'Dried') }}" class="hidden-link4">
                            <h2 class="hidden-text">Dried</h2>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="price-filter-container">
            <div id="slider" class="am-slider"></div>
            <div id="price-display" class="amshopby-slider-display">
                <span id="min-price"></span> - <span id="max-price"></span> RSD
            </div>
        </div>
    </section>

    <section class="ftco-section">

        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Our Products</h2>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach ($allProducts as $product)
                    <div class="col-md-6 col-lg-3 ftco-animate mb-4">
                        <div class="product card h-100">
                            <a href="#" class="img-prod">
                                <img class="img-fluid imgcard card-img-top" src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                                <div class="overlay"></div>
                            </a>
                            <div class="card-body text-center">
                                <h3 class="card-title"><a href="#">{{ $product->name }}</a></h3>
                                <div class="d-flex justify-content-center mb-3">
                                    <div class="pricing">
                                        <p class="price">
                                            @if ($product->discount_price)
                                                <span class="text-muted text-decoration-line-through">
                                                    {{ $product->price }} RSD</i>
                                                </span><br>
                                                <span class="price-sale">
                                                    {{ $product->discount_price }} RSD</i>
                                                </span>
                                            @else
                                                <span class="price">
                                                    {{ $product->price }} RSD</i>
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <h4 class="card-title">
                                    <a href="{{ route('about', ['category' => $product->category->name]) }}">
                                        {{ $product->category->name ?? 'Bez kategorije' }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <section class="ftco-section img" style="background-image: url(images/bg_3.jpg);">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
                    <span class="subheading">Best Price For You</span>
                    <h2 class="mb-4">Deal of the day</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                    <h3><a href="#">Spinach</a></h3>
                    <span class="price">$10 <a href="#">now $5 only</a></span>
                    <div id="timer" class="d-flex mt-5">
                        <div class="time p-3" id="days"></div>
                        <div class="time p-3" id="hours"></div>
                        <div class="time p-3" id="minutes"></div>
                        <div class="time p-3" id="seconds"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog" class="ftco-section testimony-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <h2 class="mb-4">User comments</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        @foreach ($comments as $comment)
                            <div class="item">
                                <div class="testimony-wrap p-4 pb-5">
                                    <div class="user-img mb-5">
                                        @if ($comment->user->profile_image)
                                            <!-- Check if user has a profile image -->
                                            <img src="{{ asset('storage/' . $comment->user->profile_image) }}"
                                                alt="User image">
                                        @else
                                            <img src="{{ asset('images/default_user.png') }}" alt="Default image">
                                        @endif
                                        <span class="quote d-flex align-items-center justify-content-center">
                                            <i class="icon-quote-left"></i>
                                        </span>
                                    </div>

                                    <div class="text text-center">
                                        <p class="mb-5 pl-4 line">{{ $comment->comment }}</p>
                                        <p class="name">{{ $comment->user->name }}</p>
                                        <span class="position">{{ $comment->created_at->format('F j, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


    <hr>

    <section class="ftco-section ftco-partner">
        <div class="container">
            <div class="row">
                <div class="col-sm text-center ftco-animate">
                    <a href="#" class="partner"><img src="images/partner-1.png" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
                <div class="col-sm text-center ftco-an imate">
                    <a href="#" class="partner"><img src="images/partner-2.png" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
                <div class="col-sm text-center ftco-animate">
                    <a href="#" class="partner"><img src="images/partner-3.png" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
                <div class="col-sm text-center ftco-animate">
                    <a href="#" class="partner"><img src="images/partner-4.png" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
                <div class="col-sm text-center ftco-animate">
                    <a href="#" class="partner"><img src="images/partner-5.png" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
        <div class="container py-4">
            <div class="row d-flex justify-content-center py-5">
                <div class="col-md-6">
                    <h2 style="font-size: 22px;" class="mb-0">Subscribe to our Newsletter</h2>
                    <span>Get e-mail updates about our latest shops and special offers</span>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    
                    <form action="{{ route('subscribe') }}" method="POST" class="subscribe-form">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success w-100">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="form-group d-flex">
                            <input type="email" name="email" class="form-control" placeholder="Enter email address"
                                required>
                            <input type="submit" value="Subscribe" class="submit px-3">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.location.hash) {
            const element = document.querySelector(window.location.hash);
            if (element) {
                element.scrollIntoView({
                    behavior: "smooth"
                });
            }
        }
    });



</script>

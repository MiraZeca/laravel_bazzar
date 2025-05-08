@extends('home')

@section('title', 'User')

@section('main')

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    @if (session('success'))
                        <div id="successAlert" class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div id="errorAlert" class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->has('profile_image'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('profile_image') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row heading-section text-center">
                <span class="subheading text-center">My profile</span>
                <div class="col-md-6 offset-md-3 mb-4">
                    <button id="uploadProfileImageBtn" class="btn-primary btn m-3">Upload a profile picture</button>
                    <a href="{{ route('likes.my') }}" class="btn-primary btn m-2">My Likes</a>
                    <a href="{{ route('comment.form') }}" class="btn-primary btn m-2">Leave a Comment</a>
                    
                    <form id="profileImageForm" action="{{ route('profile.image.upload') }}" method="POST"
                        enctype="multipart/form-data" style="display: none;">
                        @csrf
                        <br>
                        <label for="profile_image">Select an image:</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control">
                        <button type="submit" class="btn-primary btn m-3">Save image</button>
                    </form>
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
                                <h4 class="card-title mb-3">
                                    <a href="#" class="text-decoration-none text-dark fw-bold">{{ $product->name }}</a>
                                </h4>

                                <div class="d-flex justify-content-center align-items-center mb-3">
                                    <div class="pricing">
                                        <p class="mb-0">
                                            @if ($product->discount_price)
                                                <span class="text-muted text-decoration-line-through fs-6">
                                                    {{ $product->price }} RSD
                                                </span><br>
                                                <span class="text-danger fs-5 fw-semibold">
                                                    {{ $product->discount_price }} RSD
                                                </span>
                                            @else
                                                <span class="text-primary fs-5 fw-semibold">
                                                    {{ $product->price }} RSD
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="bottom-area d-flex flex-column align-items-center">
                                    <div class="d-flex justify-content-center mb-3">
                                        <a class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="collapse"
                                            href="#details-{{ $product->id }}" role="button" aria-expanded="false"
                                            aria-controls="details-{{ $product->id }}">
                                            <i class="fas fa-bars"></i> Declaration
                                        </a>

                                        <form action="{{ route('product.like', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ $product->isLikedBy(auth()->user()) ? 'Remove like' : 'Like this product' }}">
                                                @if ($product->isLikedBy(auth()->user()))
                                                    <i class="fas fa-heart"></i>
                                                @else
                                                    <i class="far fa-heart"></i>
                                                @endif
                                            </button>
                                        </form>
                                    </div>

                                    <form action="{{ route('order', $product->id) }}" method="POST" class="w-100" style="max-width: 300px;">
                                        @csrf
                                        <div class="mb-2">
                                            <input type="number" name="quantity" min="1" max="{{ $product->warehouse->quantity ?? 0 }}" required class="form-control form-control-sm" placeholder="Količina">
                                        </div>
                                        <div class="mb-2">
                                            <select name="unit" class="form-select form-select-sm" required>
                                                <option value="g">Gram</option>
                                                <option value="kg">Kilogram</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-outline-success w-100">
                                            <i class="fas fa-shopping-cart"></i> Buy
                                        </button>
                                    </form>
                                </div>

                                <div class="collapse mt-3" id="details-{{ $product->id }}">
                                    <div class="card card-body text-start bg-light">
                                        <strong>Deklaracija:</strong><br>
                                        {{ $product->warehouse->description ?? 'No declaration available.' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>

    <script>
        document.getElementById('uploadProfileImageBtn').addEventListener('click', function() {
            var form = document.getElementById('profileImageForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
@endsection

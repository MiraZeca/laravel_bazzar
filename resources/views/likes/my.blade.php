@extends('home')

@section('title', 'Moji lajkovani proizvodi')

@section('main')
    <div class="container mt-5">
        <div class="row heading-section text-center">
            <div class="align-items-center w-100 d-flex justify-content-center">
                <span class="text-success mr-3"
                    style="font-family: 'Lora', Georgia, serif; font-style: italic; font-size: 18px;">Proizvodi koje ste
                    lajkovali</span>
                <a href="{{ route('user') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        @if ($likedProducts->isEmpty())
            <p class="text-center text-muted">Niste lajkovali nijedan proizvod.</p>
        @else
            <div class="row mt-4 justify-content-center">
                @foreach ($likedProducts as $product)
                    <div class="col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                        <div class="card h-100" style="width: 18rem; display: flex; flex-direction: column;">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->name }}">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <h5 class="card-title text-center">{{ $product->name }}</h5>
                                <p class="card-text text-center">{{ $product->price }} RSD</p>
                                <form action="{{ route('product.like', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="fas fa-heart"></i> Ukloni lajk
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div> <br> <br>
@endsection

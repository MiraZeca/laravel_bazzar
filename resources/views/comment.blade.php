@extends('home')

@section('title', 'Leave a Comment')

@section('main')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Leave a Comment</h2>
                <p>Share your thoughts about the product.</p>
            </div>
        </div>

        <!-- Prikazivanje grešaka ako ih ima -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="row">
            <div class="col-6 offset-3">
                <form action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Your Comment:</label>
                        <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit Comment</button>
                    <a href="{{ route('user') }}" class="btn btn-primary mt-3">Back</a>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

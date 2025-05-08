@extends('home')

@section('title', 'Subscribers - Info')

@section('main')
    <div class="container">
        <h1 class="my-4">Subscribers List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($subscriptions->isEmpty())
            <p class="text-center">No subscribers found.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Subscribed At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->id }}</td>
                                <td>{{ $subscription->email }}</td>
                                <td>{{ $subscription->created_at->format('d.m.Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <br>
        <a href="{{ route('admin') }}" class="btn btn-primary">Back to All Products</a>
    </div> <br> <br>
@endsection

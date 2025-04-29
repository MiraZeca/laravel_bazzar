@extends('home')

@section('title', 'Admin - Porudžbine')

@section('main')
    <section>
        <div class="container mt-3">
            <h2 class="mb-4">Admin - Porudžbine za odobrenje</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover text-center p-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Korisnik</th>
                            <th>Proizvod</th>
                            <th>Količina</th>
                            <th>Cena</th>
                            <th>Status</th>
                            <th>Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}g</td>
                                <td>{{ number_format($order->total_price, 2) }} RSD</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>
                                    <a href="{{ route('admin.approve', $order->id) }}"
                                        class="btn btn-success btn-sm">Odobri</a>
                                    <a href="{{ route('admin.reject', $order->id) }}" class="btn btn-danger btn-sm">Odbij</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin') }}" class="btn btn-primary m-2 p-2">Back to All Products</a>
        </div><br><br>
    </section>
@endsection

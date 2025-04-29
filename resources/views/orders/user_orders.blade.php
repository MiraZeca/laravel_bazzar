@extends('home')

@section('title', 'Moje porudžbine')

@section('main')
    <section>
        <div class="container mt-3">
            <h2 class="mb-4">Moje porudžbine</h2>
            <div class="table-responsive">

                <table class="table table-striped table-hover text-center p-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Proizvod</th>
                            <th>Količina</th>
                            <th>Cena</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}g</td>
                                <td>{{ number_format($order->total_price, 2) }} RSD</td>
                                <td>{{ ucfirst($order->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('user') }}" class="btn btn-primary mt-3">Back</a>
        </div><br><br>
    </section>
@endsection

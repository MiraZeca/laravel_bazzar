@extends('home')

@section('title', 'Admin - Warehouse')

@section('main')
    <section class="m-3">
        <div class="container mt-3">
            <div class="row">
                <div class="col-6 offset-3">
                    @if (session('create'))
                        <div id="createAlert" class="alert alert-success" role="alert">
                            {{ session('create') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <a href="{{ route('warehouse.create') }}" class="btn btn-primary m-2 p-2">Add product quantity</a>

        <div class="table-responsive">
            <table class="table table-striped table-hover text-center p-3">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity in Stock (g)</th>
                        <th>Reserved Quantity (g)</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->id }}</td>
                            <td>{{ $warehouse->product->name }}</td>
                            <td>{{ $warehouse->quantity }}</td>
                            <td>{{ $warehouse->reserved_quantity }}</td>
                            <td>{{ $warehouse->description }}</td>
                            <td>
                                <!-- Edit actions -->
                                <a href="{{ route('warehouse.edit', $warehouse->product_id) }}" class="btn btn-warning">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('warehouse.destroy', $warehouse->product_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <br>
            <a href="{{ route('admin') }}" class="btn btn-primary m-2 p-2">Back to All Products</a><br>
         <br> <br>
    </section>
@endsection

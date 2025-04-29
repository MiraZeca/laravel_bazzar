@extends('home')

@section('title', 'Admin - Add Warehouse')

@section('main')
    <section class="m-3">
        <div class="container mt-3">
            <h3>Add Product to Warehouse</h3>

            <form action="{{ route('warehouse.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="product_id" class="form-label">Product</label>
                    <select class="form-control" name="product_id" id="product_id" required>
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" required>
                </div>

                <div class="mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <select class="form-control" name="unit" id="unit" required>
                        <option value="g">Grams (g)</option>
                        <option value="kg">Kilograms (kg)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Add to Warehouse</button>
                <a href="{{ route('warehouse.index') }}" class="btn btn-primary">Back to Magacin</a><br>
            </form>
          
        </div><br><br>
    </section>
@endsection

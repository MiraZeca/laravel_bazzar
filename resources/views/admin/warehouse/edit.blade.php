@extends('home')

@section('title', 'Edit Warehouse')

@section('main')
    <section>
        <div class="container mt-3">
            <h3>Edit Warehouse for Product: {{ $product->name }}</h3>

            <form action="{{ route('warehouse.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{ old('quantity', $warehouse->quantity) }}" required>
                </div>

                <div class="mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <select class="form-control" name="unit" id="unit" required>
                        <option value="g" {{ $warehouse->unit == 'g' ? 'selected' : '' }}>Grams</option>
                        <option value="kg" {{ $warehouse->unit == 'kg' ? 'selected' : '' }}>Kilograms</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description">{{ old('description', $warehouse->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Update Warehouse</button>
            </form>
        </div> <br><br>
    </section>
@endsection

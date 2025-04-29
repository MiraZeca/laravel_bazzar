<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    // Prikazuje listu svih proizvoda u magacinu
    public function index()
    {
        $warehouses = Warehouse::with('product.pendingOrders')->get();

        // Izračunavanje rezervisane količine samo za 'pending' porudžbine
        foreach ($warehouses as $warehouse) {
            $warehouse->reserved_quantity = $warehouse->product
                ? $warehouse->product->pendingOrders->sum('quantity')
                : 0;
        }

        return view('admin.warehouse.index', compact('warehouses'));
    }

    // Metoda za prikazivanje forme za dodavanje proizvoda u magacin
    public function create()
    {
        $products = Product::all();
        return view('admin.warehouse.create', compact('products'));
    }

    // Metoda za čuvanje podataka iz forme u bazu
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|in:g,kg',
            'description' => 'nullable|string',
        ]);

        $quantityInGrams = ($request->unit == 'kg') ? $request->quantity * 1000 : $request->quantity;

        Warehouse::create([
            'product_id' => $request->product_id,
            'quantity' => $quantityInGrams,
            'description' => $request->description,
        ]);

        return redirect()->route('warehouse.index')->with('success', 'The product has been successfully added to the warehouse.');
    }

    // Prikazuje formu za uređivanje magacina proizvoda
    public function edit($product_id)
    {
        $product = Product::findOrFail($product_id);
        $warehouse = $product->warehouse;

        return view('admin.warehouse.edit', compact('product', 'warehouse'));
    }

    // Ažurira podatke o magacinu za određeni proizvod
    public function update(Request $request, $product_id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        Warehouse::updateOrCreate(
            ['product_id' => $product_id],
            [
                'quantity' => $request->quantity,
                'description' => $request->description
            ]
        );

        return redirect()->route('warehouse.index')->with('success', 'Warehouse updated.');
    }

    // Metoda za brisanje proizvoda iz magacina
    public function destroy($product_id)
    {
        $warehouse = Warehouse::where('product_id', $product_id)->first();

        if ($warehouse) {
            $warehouse->delete();
            return redirect()->route('warehouse.index')->with('success', 'The product has been removed from the warehouse.');
        }

        return redirect()->route('warehouse.index')->with('error', 'Product not found.');
    }

    // Metoda za razduživanje rezervacije
    public function releaseReservation($warehouse_id)
    {
        $warehouse = Warehouse::findOrFail($warehouse_id);

        if ($warehouse->reserved_quantity > 0) {
            $warehouse->quantity += $warehouse->reserved_quantity;
            $warehouse->reserved_quantity = 0;
            $warehouse->save();

            return redirect()->route('warehouse.index')->with('success', 'The order has been discharged and the balance has been updated.');
        }

        return redirect()->route('warehouse.index')->with('error', 'There is no reserved amount for deleveraging.');
    }
}

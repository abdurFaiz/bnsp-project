<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality - search across all columns
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name_product', 'like', '%' . $searchTerm . '%')
                    ->orWhere('desc_product', 'like', '%' . $searchTerm . '%')
                    ->orWhere('harga_product', 'like', '%' . $searchTerm . '%')
                    ->orWhere('stock_product', 'like', '%' . $searchTerm . '%');
            });
        }

        // Sort functionality
        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'asc');
        $validSortColumns = ['id', 'name_product', 'desc_product', 'harga_product', 'stock_product', 'created_at'];

        if (in_array($sortBy, $validSortColumns)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('id', 'asc');
        }

        // Pagination with dynamic per page
        $perPage = $request->input('per_page', 10);
        $allowedPerPage = [10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        // Paginate with dynamic items per page and append query parameters
        $products = $query->paginate($perPage)->appends($request->query());

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'desc_product' => 'required|string|max:255',
            'harga_product' => 'required|numeric|gt:0',
            'stock_product' => 'required|integer|gt:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'desc_product' => 'required|string|max:255',
            'harga_product' => 'required|numeric|gt:0',
            'stock_product' => 'required|integer|gt:0',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Export products to Excel
     */
    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'products_' . date('Y-m-d_H-i-s') . '.xlsx');
    }

    /**
     * Export products to PDF
     */
    public function exportPdf()
    {
        $products = Product::all();

        $pdf = PDF::loadView('pdf.products', compact('products'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('products_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}

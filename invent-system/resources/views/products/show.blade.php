@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Product Details</h1>
            <div class="flex space-x-2">
                <a href="{{ route('products.edit', $product->id) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Edit
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Product Name</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $product->name_product }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Description</label>
                    <p class="mt-1 text-gray-900">{{ $product->desc_product }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Price</label>
                    <p class="mt-1 text-lg font-semibold text-green-600">Rp
                        {{ number_format($product->harga_product, 2, ',', '.') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-500">Stock Quantity</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $product->stock_product }} units</p>
                </div>
            </div>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-500">
                <div>
                    <label class="block font-medium">Created At</label>
                    <p>{{ $product->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <label class="block font-medium">Last Updated</label>
                    <p>{{ $product->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors"
                    onclick="return confirm('Are you sure you want to delete this product?')">
                    Delete Product
                </button>
            </form>
        </div>
    </div>
@endsection

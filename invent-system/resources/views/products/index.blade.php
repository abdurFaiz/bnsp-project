@extends('layouts.app')
@section('title', 'Product List')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Product List</h1>
            <div class="flex space-x-2">
                <!-- Export Buttons -->
                <div class="relative inline-block text-left">
                    <button type="button" onclick="toggleExportMenu()"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Export
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="exportMenu"
                        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border">
                        <div class="py-1">
                            <a href="{{ route('products.export.excel') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Export to Excel
                            </a>
                            <a href="{{ route('products.export.pdf') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Export to PDF
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Add Product Button -->
                <a href="{{ route('products.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Add Product
                </a>
            </div>
        </div> <!-- Search Form -->
        <div class="mb-6">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="sr-only">Search products</label>
                    <div class="relative">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="Search products by name, description, price, or stock..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2">

                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Search
                    </button>
                    <!-- Items per page selector -->

                </div>
            </form>
        </div>

        <!-- Search Results Info -->
        @if (request('search'))
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                <p class="text-blue-800">
                    <strong>Search Results:</strong> Found {{ $products->total() }} product(s) for
                    "{{ request('search') }}"
                    @if ($products->total() > 0)
                        (Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }}
                        results)
                    @endif
                </p>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500" role="table" aria-label="Products table">
                <caption class="sr-only">List of all products with their details including name, description, price, stock,
                    and actions</caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('products.index', array_merge(request()->query(), ['sort_by' => 'id', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                class="flex items-center hover:text-blue-600">
                                No
                                @if (request('sort_by') == 'id')
                                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        @if (request('sort_order') == 'asc')
                                            <path
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        @else
                                            <path
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" />
                                        @endif
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('products.index', array_merge(request()->query(), ['sort_by' => 'name_product', 'sort_order' => request('sort_by') == 'name_product' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                class="flex items-center hover:text-blue-600">
                                Product Name
                                @if (request('sort_by') == 'name_product')
                                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        @if (request('sort_order') == 'asc')
                                            <path
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        @else
                                            <path
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" />
                                        @endif
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('products.index', array_merge(request()->query(), ['sort_by' => 'harga_product', 'sort_order' => request('sort_by') == 'harga_product' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                class="flex items-center hover:text-blue-600">
                                Price
                                @if (request('sort_by') == 'harga_product')
                                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        @if (request('sort_order') == 'asc')
                                            <path
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        @else
                                            <path
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" />
                                        @endif
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <a href="{{ route('products.index', array_merge(request()->query(), ['sort_by' => 'stock_product', 'sort_order' => request('sort_by') == 'stock_product' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                class="flex items-center hover:text-blue-600">
                                Stock
                                @if (request('sort_by') == 'stock_product')
                                    <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        @if (request('sort_order') == 'asc')
                                            <path
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        @else
                                            <path
                                                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" />
                                        @endif
                                    </svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 font-semibold">{{ $product->name_product }}</td>
                            <td class="px-6 py-4">
                                <div class="max-w-xs truncate" title="{{ $product->desc_product }}">
                                    {{ $product->desc_product }}
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-green-600">
                                Rp {{ number_format($product->harga_product, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $product->stock_product > 10
                                    ? 'bg-green-100 text-green-800'
                                    : ($product->stock_product > 0
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : 'bg-red-100 text-red-800') }}">
                                    {{ $product->stock_product }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                        class="font-medium text-blue-600 hover:underline hover:text-blue-800 transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="inline" onsubmit="return confirmDelete('{{ $product->name_product }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-medium text-red-600 hover:underline hover:text-red-800 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7">
                                        </path>
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">No products found</p>
                                    @if (request('search'))
                                        <p class="text-gray-400 text-sm mt-1">Try adjusting your search terms</p>
                                    @else
                                        <p class="text-gray-400 text-sm mt-1">Get started by adding your first product</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
        </div>
        </table>
        <label for="per_page" class="sr-only">Items per page</label>
        <select id="per_page" name="per_page" onchange="this.form.submit()"
            class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page</option>
            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25 per page</option>
            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50 per page</option>
            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100 per page
            </option>
        </select>

        <!-- Enhanced Pagination -->
        @if ($products->hasPages())
            <div class="mt-6 flex flex-col sm:flex-row justify-between items-center">
                <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of
                    {{ $products->total() }} results
                </div>
                <div class="flex items-center space-x-1">
                    {{ $products->appends(request()->query())->onEachSide(2)->links() }}
                </div>
            </div>
        @else
            @if ($products->count() > 0)
                <div class="mt-4 text-sm text-gray-700 text-center">
                    Showing {{ $products->count() }} result(s)
                </div>
            @endif
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Export menu toggle
        function toggleExportMenu() {
            const menu = document.getElementById('exportMenu');
            menu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('exportMenu');
            const button = event.target.closest('button');

            if (!menu.contains(event.target) && !button) {
                menu.classList.add('hidden');
            }
        });

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const searchForm = searchInput.closest('form');
            let searchTimeout;

            // Optional: Add real-time search (uncomment if needed)
            /*
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    if (searchInput.value.length >= 3 || searchInput.value.length === 0) {
                        searchForm.submit();
                    }
                }, 500);
            });
            */

            // Clear search button
            const clearButton = document.createElement('button');
            clearButton.type = 'button';
            clearButton.className = 'absolute inset-y-0 right-0 pr-3 flex items-center';
            clearButton.innerHTML =
                '<svg class="h-4 w-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';
            clearButton.style.display = searchInput.value ? 'flex' : 'none';

            clearButton.addEventListener('click', function() {
                searchInput.value = '';
                searchForm.submit();
            });

            searchInput.addEventListener('input', function() {
                clearButton.style.display = this.value ? 'flex' : 'none';
            });

            // Insert clear button into search input container
            if (searchInput.value) {
                const container = searchInput.parentElement;
                if (container && !container.querySelector('button[type="button"]')) {
                    container.style.position = 'relative';
                    container.appendChild(clearButton);
                }
            }

            // Auto-submit form when sort options change (optional)
            const sortSelects = document.querySelectorAll('#sort_by, #sort_order');
            sortSelects.forEach(select => {
                select.addEventListener('change', function() {
                    // Optional: Auto-submit when sort changes
                    // Uncomment the line below to enable auto-submit
                    // searchForm.submit();
                });
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Focus search input when pressing '/' key
                if (e.key === '/' && !e.ctrlKey && !e.metaKey && !e.altKey) {
                    e.preventDefault();
                    searchInput.focus();
                }

                // Clear search when pressing Escape in search input
                if (e.key === 'Escape' && document.activeElement === searchInput) {
                    searchInput.blur();
                }
            });

            // Add loading state to search button
            const searchButton = document.querySelector('button[type="submit"]');
            const originalButtonText = searchButton.innerHTML;

            searchForm.addEventListener('submit', function() {
                searchButton.disabled = true;
                searchButton.innerHTML =
                    '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Searching...';

                // Reset button after 3 seconds (in case form submission fails)
                setTimeout(() => {
                    searchButton.disabled = false;
                    searchButton.innerHTML = originalButtonText;
                }, 3000);
            });
        });

        // Confirmation for delete actions
        function confirmDelete(productName) {
            return confirm(`Are you sure you want to delete "${productName}"? This action cannot be undone.`);
        }

        // Highlight search terms in results (optional enhancement)
        function highlightSearchTerm() {
            const searchTerm = '{{ request('search') }}';
            if (searchTerm) {
                const regex = new RegExp(`(${searchTerm})`, 'gi');
                const tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const cells = row.querySelectorAll(
                        'td:nth-child(2), td:nth-child(3)'); // Name and description columns
                    cells.forEach(cell => {
                        if (cell.textContent) {
                            cell.innerHTML = cell.textContent.replace(regex,
                                '<mark class="bg-yellow-200 px-1 rounded">$1</mark>');
                        }
                    });
                });
            }
        }

        // Call highlight function when page loads
        document.addEventListener('DOMContentLoaded', highlightSearchTerm);
    </script>
@endpush

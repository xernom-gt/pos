@foreach ($categories as $category)
    <h3 class="mb-2 mt-3 text-secondary">{{ $category->name }}</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-2 item-product">
        @if ($category->product && $category->product->count())
            @foreach($category->product as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body p-2 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="card-title mb-1" style="margin: 0; font-size: 0.95rem; line-height: 1.2;">
                                    {{ $product->name }}
                                </h6>
                            </div>
                            <div class="text-muted small fw-medium">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <div class="d-flex justify-content-end align-items-center mt-2">
                                <!-- HIDDEN INPUT TETAP SAMA -->
                                <input type="hidden" class="product-id" value="{{ $product->id }}">
                                <input type="hidden" class="product-price" value="{{ $product->price }}">

                                <!-- TOMBOL ADD: LOGIKA SAMA, TAMPILAN BARU -->
                                <button 
                                    class="btn btn-sm btn-outline-primary btn-add d-flex align-items-center gap-1" 
                                    title="Tambah ke keranjang"
                                    data-id="{{ $product->id }}" 
                                    data-name="{{ $product->name }}" 
                                    data-price="{{ $product->price }}">
                                    <small>Add</small>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col">
                <p class="text-muted small">Belum ada produk untuk kategori ini.</p>
            </div>
        @endif
    </div>
@endforeach
@extends('layouts.admin')

@section('page_title', 'Edit Transaksi')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Transaksi</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5>Validasi Gagal!</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="user_marketing_id" class="form-label">User Marketing <span class="text-danger">*</span></label>
                                        <select class="form-select @error('user_marketing_id') is-invalid @enderror" id="user_marketing_id" name="user_marketing_id" required>
                                            <option value="">Pilih User Marketing</option>
                                            @foreach ($userMarketings as $userMarketing)
                                                <option value="{{ $userMarketing->id }}" {{ old('user_marketing_id', $transaksi->user_marketing_id) == $userMarketing->id ? 'selected' : '' }}>{{ $userMarketing->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_marketing_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label>
                                        <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                                            <option value="">Pilih Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ old('customer_id', $transaksi->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('customer_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label">Produk <span class="text-danger">*</span></label>
                                        <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                                            <option value="" data-price="0" data-user-marketing="">Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}" data-price="{{ $produk->price }}" data-user-marketing="{{ $produk->user_marketing_id }}" {{ old('product_id', $transaksi->product_id) == $produk->id ? 'selected' : '' }}>{{ $produk->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', $transaksi->quantity) }}" step="1" min="1" required>
                                        @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="unit_price" class="form-label">Harga Satuan</label>
                                        <input type="number" readonly class="form-control-plaintext form-control" id="unit_price" name="unit_price" value="{{ old('unit_price', 0) }}" step="0.01" min="0">
                                        <div class="form-text">Ditampilkan setelah produk dipilih.</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="total_price" class="form-label">Total Harga <span class="text-danger">*</span></label>
                                        <input type="number" readonly class="form-control-plaintext form-control @error('total_price') is-invalid @enderror" id="total_price" name="total_price" value="{{ old('total_price', $transaksi->total_price) }}" step="0.01" min="0">
                                        <div class="form-text">Total otomatis dihitung dari jumlah × harga produk.</div>
                                        @error('total_price') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="payment_status" class="form-label">Status Pembayaran <span class="text-danger">*</span></label>
                                        <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="pending" {{ old('payment_status', $transaksi->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ old('payment_status', $transaksi->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="cancelled" {{ old('payment_status', $transaksi->payment_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        @error('payment_status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="transaction_date" class="form-label">Tanggal Transaksi <span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control @error('transaction_date') is-invalid @enderror" id="transaction_date" name="transaction_date" value="{{ old('transaction_date', $transaksi->transaction_date->format('Y-m-d\TH:i')) }}" required>
                                        @error('transaction_date') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Catatan</label>
                                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $transaksi->notes) }}</textarea>
                                        @error('notes') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Perbarui
                                </button>
                                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const originalProductOptions = Array.from(document.getElementById('product_id').options).map(option => ({
            value: option.value,
            text: option.text,
            price: option.dataset.price || '0',
            userMarketing: option.dataset.userMarketing || '',
        }));

        function filterProductsByMarketing() {
            const marketingSelect = document.getElementById('user_marketing_id');
            const productSelect = document.getElementById('product_id');
            const selectedMarketing = marketingSelect.value;
            const previousValue = productSelect.value;
            productSelect.innerHTML = '';

            originalProductOptions.forEach(option => {
                if (!option.value || !selectedMarketing || option.userMarketing === selectedMarketing) {
                    const el = document.createElement('option');
                    el.value = option.value;
                    el.text = option.text;
                    el.dataset.price = option.price;
                    el.dataset.userMarketing = option.userMarketing;
                    if (option.value === previousValue) {
                        el.selected = true;
                    }
                    productSelect.appendChild(el);
                }
            });

            if (!Array.from(productSelect.options).some(opt => opt.selected)) {
                productSelect.value = '';
            }
            updateTotalPrice();
        }

        function updateTotalPrice() {
            const productSelect = document.getElementById('product_id');
            const quantity = document.getElementById('quantity');
            const unitPrice = document.getElementById('unit_price');
            const totalPrice = document.getElementById('total_price');
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price || 0);
            const qty = parseInt(quantity.value || 0, 10);
            unitPrice.value = price.toFixed(2);
            totalPrice.value = (price * qty).toFixed(2);
        }

        document.getElementById('user_marketing_id').addEventListener('change', filterProductsByMarketing);
        document.getElementById('product_id').addEventListener('change', updateTotalPrice);
        document.getElementById('quantity').addEventListener('input', updateTotalPrice);
        filterProductsByMarketing();
    </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded shadow">

                <form method="POST" action="{{ route('produk.update', $item->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="user_marketing_id">User Marketing <span class="text-danger">*</span></label>
                        <select name="user_marketing_id" id="user_marketing_id" class="border p-2 w-full mb-2">
                            @foreach($userMarketings as $um)
                                <option value="{{ $um->id }}" {{ $item->user_marketing_id == $um->id ? 'selected' : '' }}>{{ $um->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input name="name" value="{{ $item->name }}" class="border p-2 w-full mb-2" required>
                    <input name="description" value="{{ $item->description }}" class="border p-2 w-full mb-2">
                    <input name="price" value="{{ $item->price }}" class="border p-2 w-full mb-2" type="number" step="0.01" min="0">
                    <input name="stock" value="{{ $item->stock }}" class="border p-2 w-full mb-2" type="number" min="0">

                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="border p-2 w-full mb-2">
                            <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>active</option>
                            <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>inactive</option>
                        </select>
                    </div>

                    <button class="bg-green-500 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
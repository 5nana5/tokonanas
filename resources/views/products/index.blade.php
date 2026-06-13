<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Produk
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 p-2 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- FORM TAMBAH --}}
            <div class="bg-white p-6 rounded shadow mb-6">
                <form method="POST" action="{{ route('produk.store') }}">
                    @csrf

                    <select name="user_marketing_id" class="border p-2 w-full mb-2" required>
                        <option value="">-- Pilih User Marketing --</option>
                        @foreach($userMarketings as $um)
                            <option value="{{ $um->id }}">{{ $um->name }}</option>
                        @endforeach
                    </select>

                    <input name="name" placeholder="Nama" class="border p-2 w-full mb-2" required>
                    <input name="description" placeholder="Deskripsi" class="border p-2 w-full mb-2">
                    <input name="price" placeholder="Harga" class="border p-2 w-full mb-2" type="number" step="0.01" min="0">
                    <input name="stock" placeholder="Stok" class="border p-2 w-full mb-2" type="number" min="0">
                    <select name="status" class="border p-2 w-full mb-2" required>
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
                    </select>

                    <button class="bg-blue-500 text-white px-4 py-2 rounded">
                        Tambah
                    </button>
                </form>
            </div>

            {{-- TABLE --}}
            <div class="bg-white p-6 rounded shadow">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($produk as $p)
                        <tr class="border-b">
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->price }}</td>
                            <td>{{ $p->stock }}</td>
                            <td>{{ $p->status }}</td>
                            <td class="flex gap-2">

                                <a href="{{ route('produk.edit', $p->id) }}"
                                   class="bg-yellow-500 text-white px-2 py-1 rounded">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('produk.destroy', $p->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>
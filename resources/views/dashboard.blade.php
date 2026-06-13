<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Toko Nana'S
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Dashboard Toko Nana'S</h1>
                    <p class="text-sm text-gray-500">Ringkasan singkat aktivitas toko</p>
                </div>
                <div class="text-right">
                    <div id="local-clock" class="text-lg font-medium"></div>
                    <div class="text-sm text-gray-500">Waktu perangkat Anda</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">Produk</h3>
                    <p class="text-3xl font-bold">
                        {{ \App\Models\Produk::count() }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">Customer</h3>
                    <p class="text-3xl font-bold">
                        {{ \App\Models\Customer::count() }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">Transaksi</h3>
                    <p class="text-3xl font-bold">
                        {{ \App\Models\Transaksi::count() }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm">User Marketing</h3>
                    <p class="text-3xl font-bold">
                        {{ \App\Models\UserMarketing::count() }}
                    </p>
                </div>

            </div>

            <div class="mt-6 bg-white p-4 rounded shadow">
                <h4 class="text-gray-600">Statistik Hari Ini</h4>
                <div class="flex gap-6 mt-3">
                    <div>
                        <div class="text-sm text-gray-500">Transaksi hari ini</div>
                        <div class="text-xl font-bold">{{ \App\Models\Transaksi::whereDate('created_at', now())->count() }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Pendapatan hari ini</div>
                        <div class="text-xl font-bold">Rp {{ number_format(\App\Models\Transaksi::whereDate('created_at', now())->sum('total') ?? 0, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    (function() {
        function updateClock() {
            var el = document.getElementById('local-clock');
            if (!el) return;
            el.innerText = new Date().toLocaleString();
        }
        updateClock();
        setInterval(updateClock, 1000);
    })();
</script>
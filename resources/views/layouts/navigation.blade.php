<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        Dashboard
    </x-nav-link>

    <x-nav-link :href="route('produk.index')" :active="request()->routeIs('produk.*')">
        Produk
    </x-nav-link>

    <x-nav-link :href="route('customer.index')" :active="request()->routeIs('customer.*')">
        Customer
    </x-nav-link>

    <x-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">
        Transaksi
    </x-nav-link>

    <x-nav-link :href="route('user_marketings.index')" :active="request()->routeIs('user_marketings.*')">
        User Marketing
    </x-nav-link>

</div>